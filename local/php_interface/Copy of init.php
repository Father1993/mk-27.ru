<?php 

// Админский принт
function pprint($mess, $vd = false):void
{
    global $USER;
    if (!$USER) $USER = new CUser();
    if ($USER->isAdmin())
    {
        echo "<pre>";
        
        if ($vd)
        {
            var_dump($mess);
        }
        else
        {
            print_r($mess);
        }
        
        echo "</pre>";
    }
}

AddEventHandler("main", "OnBeforeProlog", "MyOnBeforePrologHandler");

function MyOnBeforePrologHandler() {
    $session = \Bitrix\Main\Application::getInstance()->getSession();
    
    global $city_code;
    global $city_name;
    global $arGroups;
    
    if (!$session->has('city'))
    {
        $change_city_active = "active";
        $city_code = "khb"; // default
        $city_name = "Хабаровск"; // default
    } else {
        $change_city_active = "";
        
        $city_name = match ($session['city']) { // PHP 8
            "vld" => "Владивосток",
            "khb" => "Хабаровск",
            "ysl" => "Южно-Сахалинск",
            default => "Хабаровск",
        };
        $city_code = $session['city'];
    }
    
    global $USER;
    $arGroups = $USER->GetUserGroupArray();
    $arGroups = array_diff($arGroups, [9, 8]);
    if ($city_code == "ysl") {
        $arGroups[] = 8;
    } else {
        $arGroups[] = 9;
    }
    $USER->SetUserGroupArray($arGroups); 
    $arGroups = $USER->GetUserGroupArray();
} 

$eventManager = Bitrix\Main\EventManager::getInstance();
$eventManager->addEventHandler("catalog", "OnGetOptimalPrice", function($productId, $quantity = 1, $arUserGroups = [], $renewal = "N", $arPrices = [], $siteID = false, $arDiscountCoupons = false) {
    $prices = \CCatalogProduct::GetByIDEx($productId);
    $session = \Bitrix\Main\Application::getInstance()->getSession();
    if ($session["city"] != "ysl") {
        $regionPriceId = 1;
    } else {
        $regionPriceId = 2;
    }
    $price = $prices["PRICES"][$regionPriceId]["PRICE"];
    return [
        "PRICE" => [
            "ID" => $productId,
            "CATALOG_GROUP_ID" => $regionPriceId,
            "PRICE" => $price,
            "CURRENCY" => \Bitrix\Currency\CurrencyManager::getBaseCurrency(),
            "ELEMENT_IBLOCK_ID" => $productId,
            "VAT_INCLUDED" => "Y",
        ],
        "DISCOUNT" => [
            "VALUE" => "",
            "CURRENCY" => "RUB",
        ],
    ];
});

// Взято из гугла // Обработка изображений, преобразование в формат webp

// События которые срабатывают при создании или изменении элемента инфоблока
AddEventHandler("iblock", "OnAfterIBlockElementAdd", "ResizeUploadedPhoto");
AddEventHandler("iblock", "OnAfterIBlockElementUpdate", "ResizeUploadedPhoto");

function ResizeUploadedPhoto($arFields) {
    global $APPLICATION;
    CModule::IncludeModule('iblock');
    $IBLOCK_ID = 16; // ID инфоблока свойство которых нуждается в масштабировании
    $PROPERTY_CODE = "PHOTO";  // код свойства
    $imageMaxWidth = 1600; // Максимальная ширина картинки
    $imageMaxHeight = 1600; // Максимальная высота картинки
    // для начала убедимся, что изменяется элемент нужного нам инфоблока
    if($arFields["IBLOCK_ID"] == $IBLOCK_ID) {
        $VALUES = $VALUES_OLD = array();
        //Получаем свойство значение сво-ва $PROPERTY_CODE
        $res = CIBlockElement::GetProperty($arFields["IBLOCK_ID"], $arFields["ID"], "sort", "asc", array("CODE" => $PROPERTY_CODE));
        while ($ob = $res->GetNext()) {
            $file_path = CFile::GetPath($ob['VALUE']); // Получаем путь к файлу
            if($file_path) {
                $imsize = getimagesize($_SERVER["DOCUMENT_ROOT"].$file_path); //Узнаём размер файла
                // Если размер больше установленного максимума
                if($imsize[0] > $imageMaxWidth or $imsize[1] > $imageMaxHeight) {
                    // Уменьшаем размер картинки
                    $file = CFile::ResizeImageGet($ob['VALUE'], array(
                        'width'=>$imageMaxWidth,
                        'height'=>$imageMaxHeight
                    ), BX_RESIZE_IMAGE_PROPORTIONAL, true);
                    // добавляем в массив VALUES новую уменьшенную картинку
                    $VALUES[] = array("VALUE" => CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"].$file["src"]), "DESCRIPTION" => $ob['DESCRIPTION']);
                } else {
                    // добавляем в массив VALUES старую картинку
                    $VALUES[] = array("VALUE" => CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"].$file_path), "DESCRIPTION" => $ob['DESCRIPTION']);
                }
                // Собираем в массив ID старых файлов для их удаления (чтобы не занимали место)
                $VALUES_OLD[] = $ob['VALUE'];
            }
        }
        // Если в массиве есть информация о новых файлах
        if(count($VALUES) > 0) {
            $PROPERTY_VALUE = $VALUES;  // значение свойства
            // Установим новое значение для данного свойства данного элемента
            CIBlockElement::SetPropertyValuesEx($arFields["ID"], $arFields["IBLOCK_ID"], array($PROPERTY_CODE => $PROPERTY_VALUE));
            // Удаляем старые большие изображения
            foreach ($VALUES_OLD as $key=>$val) {
                CFile::Delete($val);
            }
        }
        unset($VALUES);
        unset($VALUES_OLD);
    }
}

?>