<?php 

/** Проверка файлов */
function includeFile($path) {
    if(file_exists($_SERVER["DOCUMENT_ROOT"] . $path)) {
        require_once $_SERVER["DOCUMENT_ROOT"] . $path;
    }
}

/** Автолоадер классов */
includeFile("/local/vendor/autoload.php");

/** Функции */
includeFile("/local/php_interface/include/functions.php");

use Bitrix\Sale;
use Bitrix\Main;


AddEventHandler('main', 'OnEpilog', '_Check404Error', 1);
function _Check404Error(){
    if(defined('ERROR_404') && ERROR_404=='Y' || CHTTP::GetLastStatus() == "404 Not Found"){
        GLOBAL $APPLICATION;
        $APPLICATION->RestartBuffer();
        require $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/header.php';
        require $_SERVER['DOCUMENT_ROOT'].'/404.php';
        require $_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/footer.php';
    }
}

// TODO: Переделать работу с городами и cookies:
// 1. Перенести уведомление о cookies в localStorage
// 2. Перенести окно выбора города в localStorage
// 3. Установить срок жизни cookie города на 1 год
// 4. Добавить AJAX обработчик для установки города
// 5. Создать отдельный JavaScript файл для управления городами и cookies


// Города и группы пользователя в зависимости от выбранного города
AddEventHandler("main", "OnBeforeProlog", "MyOnBeforePrologHandler");
function MyOnBeforePrologHandler() {

    global $APPLICATION;
    
    $city_cookie = $APPLICATION->get_cookie("city");

    global $city_code;
    global $city_name;
    global $arGroups;
    global $change_city_active;
    
    if (!isset($city_cookie) || ($city_cookie == ""))
    {
        $change_city_active = "active";
        $city_code = "khb"; // default
        $city_name = "Хабаровск"; // default
    } else {
        $change_city_active = "";
        
        if ($city_cookie == "vld") {
            $city_name = "Владивосток";
        } elseif ($city_cookie == "ysl") {
            $city_name = "Южно-Сахалинск";
        } else {
            $city_name = "Хабаровск";
        }
        
        $city_code = $city_cookie;
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

// Пересчет корзины в зависимости от выбранного города

AddEventHandler("catalog", "OnGetOptimalPrice", "MyGetOptimalPrice");
function MyGetOptimalPrice($productID, $quantity = 1, $arUserGroups = array(), $renewal = "N", $arPrices = array(), $siteID = false, $arDiscountCoupons = false)
{
    $prices = CCatalogProduct::GetByIDEx($productID);
    
    global $APPLICATION;
    
    // Тип цен Сахалин ОПТ или РОЗНИЦА
    if (CModule::IncludeModule("iblock")) {
        $res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 35, "ID" => 53503), false, false, Array("ID", "PROPERTY_PRICE_TYPE"));
    }
    $arPriceTypeItem = $res->fetch();
    $priceTypeYsl = $arPriceTypeItem["PROPERTY_PRICE_TYPE_VALUE"];
    
    $city_cookie = $APPLICATION->get_cookie("city");
    if ($city_cookie != "ysl") {
        $regionPriceId = 1;
    } else {
        if ($priceTypeYsl == "Сахалин РОЗНИЦА") {
            $regionPriceId = 14;
        } elseif ($priceTypeYsl == "Сахалин ОПТ") {
            $regionPriceId = 2;
        }
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
    
}

Main\EventManager::getInstance()->addEventHandler(
    'sale',
    'OnSaleOrderBeforeSaved',
    'myFunction'
    );

// В обработчике изменим комментарий

function myFunction(Main\Event $event)
{
    /** @var Order $order */
    $order = $event->getParameter("ENTITY");
    $propertyCollection = $order->getPropertyCollection();
    
    global $APPLICATION;
    $city_cookie = $APPLICATION->get_cookie("city");
    
    if ($city_cookie == "khb") {
        $city = "Хабаровск";
    } elseif ($city_cookie == "vld") {
        $city = "Владивосток";
    } elseif ($city_cookie == "ysl") {
        $city = "Южно-Сахалинск";
    }
    
    foreach ($propertyCollection as $propertyItem) {
        if ($propertyItem->getField("CODE") == "CITY") {
            $propertyItem->setField("VALUE", $city);
            break;
        }
    }
    
}

AddEventHandler("sale", "OnOrderNewSendEmail", "MyOnOrderNewSendEmail");
function MyOnOrderNewSendEmail($orderID, &$eventName, &$arFields) {
    
    global $APPLICATION;
    $city_cookie = $APPLICATION->get_cookie("city");

    $arOrder = CSaleOrder::GetByID($orderID);
    
    $order = Sale\Order::load($orderID);
    $propertyCollection = $order->getPropertyCollection()->getArray();
    foreach ($propertyCollection["properties"] as $val) {
        $arProps[$val["CODE"]] = $val["VALUE"][0];
    }

    $newOrderFields["ORDER_ID"] = $orderID;
    
    $newOrderFields["ORDER_USER"]  = $arFields["ORDER_USER"];
    $newOrderFields["ORDER_DATE"]  = $arFields["ORDER_DATE"];
    $newOrderFields["PRICE"]       = $arFields["PRICE"];
    $newOrderFields["ORDER_LIST"]  = $arFields["ORDER_LIST"];
    
    $newOrderFields["USER_EMAIL"]  = $arProps["EMAIL"];
    $newOrderFields["PHONE"]       = $arProps["PHONE"];
    $newOrderFields["COMPANY"]     = $arProps["COMPANY"];
    $newOrderFields["INN"]         = $arProps["INN"];
    $newOrderFields["KPP"]         = $arProps["KPP"];
    $newOrderFields["COMPANY_ADR"] = $arProps["COMPANY_ADR"];
    $newOrderFields["ADDRESS"]     = $arProps["ADDRESS"];
    $newOrderFields["CITY"]        = $arProps["CITY"];

    $newOrderFields["COMMENT"]     = $arOrder["USER_DESCRIPTION"];
    
    if ($arOrder["DELIVERY_ID"] == 2) $newOrderFields["DELIVERY"] = "Доставка";
    if ($arOrder["DELIVERY_ID"] == 3) $newOrderFields["DELIVERY"] = "Самовывоз";
    
    $newOrderFields["MANAGER_EMAIL"] = "919044@mk-27.ru";
    
    if ($city_cookie == "khb") {
        if ($arOrder["PERSON_TYPE_ID"] == 1) {
            $newOrderFields["MANAGER_EMAIL"] .= ", 919045@mk-27.ru";
        }
        if ($arOrder["PERSON_TYPE_ID"] == 2) {
            $newOrderFields["MANAGER_EMAIL"] .= ", com_director@mk-27.ru";
        }
        if ($arOrder["DELIVERY_ID"] == 3) {
            $newOrderFields["ADDRESS"] = "680006, г. Хабаровск, ул. Иртышская, 25";
        }
    } elseif ($city_cookie == "vld") {
        if ($arOrder["PERSON_TYPE_ID"] == 1) {
            $newOrderFields["MANAGER_EMAIL"] .= ", torgzal1_vl@mk-27.ru";
        }
        if ($arOrder["PERSON_TYPE_ID"] == 2) {
            $newOrderFields["MANAGER_EMAIL"] .= ", manager2_vl@mk-27.ru";
            // $newOrderFields["MANAGER_EMAIL"] .= ", director_vl@mk-27.ru";
        }
        if ($arOrder["DELIVERY_ID"] == 3) {
            $newOrderFields["ADDRESS"] = "​690039, г. Владивосток, ул.Енисейская, 32, складской комплекс 6";
        }
    } elseif ($city_cookie == "ysl") {
        if ($arOrder["PERSON_TYPE_ID"] == 1) {
            $newOrderFields["MANAGER_EMAIL"] .= ", director_sh@mk-27.ru";
        }
        if ($arOrder["PERSON_TYPE_ID"] == 2) {
            $newOrderFields["MANAGER_EMAIL"] .= ", director_sh@mk-27.ru";
        }
        if ($arOrder["DELIVERY_ID"] == 3) {
            $newOrderFields["ADDRESS"] = "​693012, г. Южно-Сахалинск, проспект Мира 2Б/8";
        }
    }
    
    $arFields["ADDRESS"] = $newOrderFields["ADDRESS"];
    $arFields["DELIVERY"] = $newOrderFields["DELIVERY"];
    
    CSaleOrderPropsValue::Update($orderID, array("CITY" => $newOrderFields["CITY"]));
    
    if ($arOrder["PERSON_TYPE_ID"] == 2) {
        $send = CEvent::Send('NEW_ORDER_FOR_MANAGER', "s1", $newOrderFields);
    } else {
        $send = CEvent::Send('NEW_ORDER_FOR_MANAGER_INDIVIDUAL', "s1", $newOrderFields);
    }

}

AddEventHandler("main", "OnAfterUserRegister", "OnBeforeUserUpdateHandler");
AddEventHandler("main", "OnAfterUserUpdate", "OnBeforeUserUpdateHandler");
function OnBeforeUserUpdateHandler(&$arFields)
{
    $logDir = $_SERVER["DOCUMENT_ROOT"] . "/ADEV";
    if (!file_exists($logDir)) {
        mkdir($logDir, 0777, true);
    }

    $logFile = $logDir . "/after_log.txt";
    define("LOG_FILENAME", $logFile);

    // Проверяем размер файла
    if (file_exists($logFile) && filesize($logFile) > 5 * 1024 * 1024) { // 5MB
        // Создаем архивную копию
        $archiveFile = $logDir . "/after_log_" . date('Y-m-d_H-i-s') . ".txt";
        rename($logFile, $archiveFile);
    }

    $logData = date('Y-m-d H:i:s') . " - Обновление пользователя:\n";
    $logData .= print_r($arFields, true) . "\n";
    $logData .= "-------------------\n";
    
    file_put_contents($logFile, $logData, FILE_APPEND);
    
    $arFields["LOGIN"] = $arFields["EMAIL"];
    return $arFields;
}

// // Обработчик для удаления фотографий при импорте из 1С  !!!!!!!! ЗАЧЕМ ДУБЛИРОВАТЬ ШТАТНЫЙ ФУННКЦИОНАЛ ИЗ-зА НЕГО ОШИБКИ БЫЛИ С ФОТО НАВРЕНО!
// AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", "DeletePhotosOn1CImport");

// function DeletePhotosOn1CImport(&$arFields)
// {
//     // Проверяем, что это импорт из 1С
//     if(isset($GLOBALS["IS1C"]) && $GLOBALS["IS1C"] === true) {
//         // Очищаем поля с фотографиями
//         $arFields["PREVIEW_PICTURE"] = array("del" => "Y");
//         $arFields["DETAIL_PICTURE"] = array("del" => "Y");
        
//         // Очищаем дополнительные фотографии
//         if(isset($arFields["PROPERTY_VALUES"])) {
//             // Получаем ID свойства с доп. картинками (MORE_PHOTO)
//             $propertyCode = "MORE_PHOTO"; // Стандартный код свойства с доп. фото
//             $dbProperty = CIBlockProperty::GetList(
//                 array(),
//                 array("CODE" => $propertyCode, "IBLOCK_ID" => $arFields["IBLOCK_ID"])
//             );
//             if($property = $dbProperty->Fetch()) {
//                 $arFields["PROPERTY_VALUES"][$property["ID"]] = array();
//             }
//         }
//     }
// }

