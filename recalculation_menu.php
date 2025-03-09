<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Пересчет меню");
?>

<?php // Ежедневные действия с каталогом. Срабатывает через cron. ?>

<?php 
/*
$elementFilter = Array
(
    "IBLOCK_ID" => "13",
    "CHECK_PERMISSIONS" => "Y",
    "MIN_PERMISSION" => "R",
    "INCLUDE_SUBSECTIONS" => "N",
    "ACTIVE" => "Y",
    "ACTIVE_DATE" => "Y",
    "AVAILABLE" => "Y",
    "SECTION_ID" => "1751",
    ">CATALOG_PRICE_1" => "0",
);

$arSelect = Array("NAME", "ID", "XML_ID",  "DETAIL_PAGE_URL", "PROPERTY_SUB_TITLE", "CATALOG_GROUP_1");


if(CModule::IncludeModule("iblock"))
{
    $res = CIBlockElement::GetList(Array(), $elementFilter, array());
}
pprint ($res);

*/
?>

<?php // Пересчет количества элементов в разделе и запись в доп свойство раздела. ?>

<?php if ($_GET["CODE"] == "8f58ad5db1852b7c153813c8b07cc340"): ?>

<?$APPLICATION->IncludeComponent(
	"mk:catalog.section.list.mk.recalculation", 
	"mk", 
	array(
		"ADD_SECTIONS_CHAIN" => "N",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"CACHE_TIME" => "0",
		"CACHE_TYPE" => "N",
		"COUNT_ELEMENTS" => "Y",
		"COUNT_ELEMENTS_FILTER" => "CNT_ALL",
		"FILTER_NAME" => "",
		"IBLOCK_ID" => "13",
		"IBLOCK_TYPE" => "catalog",
		"SECTION_CODE" => "",
		"SECTION_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_URL" => "",
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"SHOW_PARENT_NAME" => "Y",
		"TOP_DEPTH" => "100",
		"VIEW_MODE" => "LINE",
		"COMPONENT_TEMPLATE" => "mk"
	),
	false
);?>

<?php // Добавление доп свойств разделов. Присвоение категорий авито и яндекса. Далее присвоение категорий для товаров. ?>

<?php 

$sectList = CIBlockSection::GetList($arSort, array("IBLOCK_ID" => 13), false, array("ID", "IBLOCK_SECTION_ID", "NAME", "UF_YANDEX_CATEGORY_ID", "UF_AVITO_CATEGORY", "UF_AVITO_GOODS_SUB_TYPE", "UF_AVITO_PLUMBING_TYPE"));
while ($sectListGet = $sectList->GetNext())
{
    $arSections[$sectListGet["ID"]]["IBLOCK_SECTION_ID"] = $sectListGet["IBLOCK_SECTION_ID"];
    $arSections[$sectListGet["ID"]]["NAME"] = $sectListGet["NAME"];
    $arSections[$sectListGet["ID"]]["UF_YANDEX_CATEGORY_ID"] = $sectListGet["UF_YANDEX_CATEGORY_ID"];
    $arSections[$sectListGet["ID"]]["UF_AVITO_CATEGORY"] = $sectListGet["UF_AVITO_CATEGORY"];
    $arSections[$sectListGet["ID"]]["UF_AVITO_GOODS_SUB_TYPE"] = $sectListGet["UF_AVITO_GOODS_SUB_TYPE"];
    $arSections[$sectListGet["ID"]]["UF_AVITO_PLUMBING_TYPE"] = $sectListGet["UF_AVITO_PLUMBING_TYPE"];
}

for ($i = 0; $i <= 3; $i++) {
    foreach ($arSections as $key => $val) {
        
        if (!$val["UF_YANDEX_CATEGORY_ID"]) {
            if ($arSections[$val["IBLOCK_SECTION_ID"]]["UF_YANDEX_CATEGORY_ID"]) {
                $arSections[$key]["UF_YANDEX_CATEGORY_ID"] = $arSections[$val["IBLOCK_SECTION_ID"]]["UF_YANDEX_CATEGORY_ID"];
                $arSections[$key]["NEW_CATEGORY_YANDEX_ID"] = TRUE;
            }
        }
        
        if (!$val["UF_AVITO_CATEGORY"]) {
            if ($arSections[$val["IBLOCK_SECTION_ID"]]["UF_AVITO_CATEGORY"]) {
                //$arSections[$key]["UF_AVITO_CATEGORY"] = $arSections[$val["IBLOCK_SECTION_ID"]]["UF_AVITO_CATEGORY"];
                //$arSections[$key]["NEW_CATEGORY_AVITO_ID"] = TRUE;
            }
        }
        
        if (!$val["UF_AVITO_GOODS_SUB_TYPE"]) {
            if ($arSections[$val["IBLOCK_SECTION_ID"]]["UF_AVITO_GOODS_SUB_TYPE"]) {
                //$arSections[$key]["UF_AVITO_GOODS_SUB_TYPE"] = $arSections[$val["IBLOCK_SECTION_ID"]]["UF_AVITO_GOODS_SUB_TYPE"];
                //$arSections[$key]["NEW_AVITO_GOODS_SUB_TYPE"] = TRUE;
            }
        }
            
        if (!$val["UF_AVITO_PLUMBING_TYPE"]) {
            if ($arSections[$val["IBLOCK_SECTION_ID"]]["UF_AVITO_PLUMBING_TYPE"]) {
                //$arSections[$key]["UF_AVITO_PLUMBING_TYPE"] = $arSections[$val["IBLOCK_SECTION_ID"]]["UF_AVITO_PLUMBING_TYPE"];
                //$arSections[$key]["NEW_AVITO_PLUMBING_TYPE"] = TRUE;
            }
        }
        
    } 
}

foreach ($arSections as $key => $val) {
    
    if ($val["NEW_CATEGORY_YANDEX_ID"] === TRUE) {

        $bs = new CIBlockSection;
        $bs->Update($key, array("UF_YANDEX_CATEGORY_ID" => $val["UF_YANDEX_CATEGORY_ID"]));
        
    }
    
    if ($val["NEW_CATEGORY_AVITO_ID"] === TRUE) {

        //$bs = new CIBlockSection;
        //$bs->Update($key, array("UF_AVITO_CATEGORY" => $val["UF_AVITO_CATEGORY"]));
        
    }
    
    if ($val["NEW_AVITO_GOODS_SUB_TYPE"] === TRUE) {

        //$bs = new CIBlockSection;
        //$bs->Update($key, array("UF_AVITO_GOODS_SUB_TYPE" => $val["UF_AVITO_GOODS_SUB_TYPE"]));
        
    }
    
    if ($val["NEW_AVITO_PLUMBING_TYPE"] === TRUE) {

        //$bs = new CIBlockSection;
        //$bs->Update($key, array("UF_AVITO_PLUMBING_TYPE" => $val["UF_AVITO_PLUMBING_TYPE"]));
        
    }
    
}

if(CModule::IncludeModule("iblock"))
{
    $res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 13), false, false, Array("ID", "NAME", "IBLOCK_SECTION_ID", "PROPERTY_MARKET_CATEGORY"));
}
while ($arItem = $res->fetch())
{
    if (!$arItem["PROPERTY_MARKET_CATEGORY_VALUE_ID"]) {
        $arItemsUpdate[$arItem["ID"]]["ID"] = $arItem["ID"];
        $arItemsUpdate[$arItem["ID"]]["NAME"] = $arItem["NAME"];
        $arItemsUpdate[$arItem["ID"]]["UF_YANDEX_CATEGORY_ID"] = $arSections[$arItem["IBLOCK_SECTION_ID"]]["UF_YANDEX_CATEGORY_ID"];
    }
}

foreach ($arItemsUpdate as $key => $val) {
    if ($val["UF_YANDEX_CATEGORY_ID"]) {
        CIBlockElement::SetPropertyValuesEx($val["ID"], 13, array("MARKET_CATEGORY" => $val["UF_YANDEX_CATEGORY_ID"]));
    }
}
?>

<?php // Обработка фотографий. Приведение к стандарту 900 x 1200, форматы webp и jpeg. Обработка нейросетью. ?>

<?php 

if(CModule::IncludeModule("iblock"))
{
    $res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 13, "INCLUDE_SUBSECTIONS" => "Y"), false, false, Array("ID", "IBLOCK_ID", "DETAIL_PICTURE", "PREVIEW_PICTURE", "PROPERTY_PHOTO_EXTERNAL_ID"));
}
while ($item = $res->fetch())
{
    $arItems[$item["ID"]]["FILE"] = CFile::GetByID($item["DETAIL_PICTURE"])->arResult[0];
    $arItems[$item["ID"]]["PREVIEW_FILE"] = CFile::GetByID($item["PREVIEW_PICTURE"])->arResult[0];
    $arItems[$item["ID"]]["PROPERTY_PHOTO_EXTERNAL_ID"] = $item["PROPERTY_PHOTO_EXTERNAL_ID_VALUE"];
    $arItems[$item["ID"]]["IBLOCK_ID"] = $item["IBLOCK_ID"];
}

$n = 0;
$i = 0;
$k = 0;
$x = 0;

foreach ($arItems as $key => $val) {
    $width = 900;
    $height = 1200;
    
    $n++;
    
    if (!empty($val["FILE"])) {
        
        if (($val["FILE"]["WIDTH"] != $width) || ($val["FILE"]["HEIGHT"] != $height)) {
            $i++;
            
            $min_resolution = min([$val["FILE"]["WIDTH"], $val["FILE"]["HEIGHT"]]);

            if     ($min_resolution <= 300) $scale = 8;
            elseif ($min_resolution <= 400) $scale = 4;
            elseif ($min_resolution <= 600) $scale = 3;
            elseif ($min_resolution  < 900) $scale = 2;
            else                            $scale = 1;
            
            $path = $_SERVER["DOCUMENT_ROOT"] . $val["FILE"]["SRC"];
            
            if ($scale > 1) {
                $k++;
                $cmd = "python3 /home/bitrix/www/python/resize.py '$path' '$scale'";
                $result = system($cmd, $return_var);
                error_log("Python command: $cmd");
                error_log("Python result: $result");
                error_log("Python return code: $return_var");
            }
            
            $im = imagecreatetruecolor($width, $height);
            $back = imagecolorallocate($im, 255, 255, 255);
            imagefilledrectangle($im, 0, 0, $width, $height, $back);
            
            // Инициализируем $src как null
            $src = null;
            
            // Флаг для отладки (установите в true только при необходимости)
            $debug = false;
            
            // Проверяем существование файла
            if (file_exists($path)) {
                $image_type = exif_imagetype($path);
                
                // Логируем тип изображения только при отладке
                if ($debug) {
                    AddMessage2Log("Тип изображения для файла $path: " . $image_type);
                }
                
                if ($image_type == 1)  $src = imageCreateFromGif($path);
                else if ($image_type == 2)  $src = imageCreateFromJpeg($path);
                else if ($image_type == 3)  $src = imageCreateFromPng($path);
                else if ($image_type == 18) $src = imageCreateFromWebp($path);
                else {
                    AddMessage2Log("Неподдерживаемый тип изображения: " . $image_type . " для файла: " . $path);
                }
            } else {
                AddMessage2Log("Файл не существует: " . $path);
            }
            
            // Проверяем, что $src не null перед продолжением
            if ($src !== null) {
                list($width_orig, $height_orig) = getimagesize($path);
                
                // Проверка на деление на ноль
                if ($height_orig == 0) {
                    // Если высота равна 0, устанавливаем соотношение 1:1 (квадрат)
                    $ratio_orig = 1;
                } else {
                    $ratio_orig = $width_orig / $height_orig;
                }
                
                // Проверка на деление на ноль при сравнении соотношений
                if ($height == 0) {
                    // Если высота равна 0, устанавливаем ширину равной высоте * соотношение
                    $width = 900; // Стандартная ширина
                    $height = 1200; // Стандартная высота
                } else if ($width / $height > $ratio_orig) {
                    $width = $height * $ratio_orig;
                } else {
                    // Проверка на деление на ноль
                    if ($ratio_orig == 0) {
                        // Если соотношение равно 0, устанавливаем высоту равной ширине
                        $height = $width;
                    } else {
                        $height = $width / $ratio_orig;
                    }
                }
                
                $im_x = ((900 - $width) / 2);
                $im_y = ((1200 - $height) / 2);
                
                imagecopyresampled($im, $src, $im_x, $im_y, 0, 0, $width, $height, $width_orig, $height_orig);
                
                imagewebp($im, $_SERVER["DOCUMENT_ROOT"] . "/upload/temp.webp");
                imagedestroy($im);
                
                // Проверяем, что файл был успешно создан
                $temp_file = $_SERVER["DOCUMENT_ROOT"] . "/upload/temp.webp";
                if (file_exists($temp_file)) {
                    $file = CFile::MakeFileArray($temp_file);
                    
                    $el = new CIBlockElement;
                    $result = $el->Update($key, array("DETAIL_PICTURE" => $file));
                    
                    if ($result) {
                        // Обновление прошло успешно
                        if (empty($val["PROPERTY_PHOTO_EXTERNAL_ID"])) {
                            CIBlockElement::SetPropertyValuesEx($key, $val["IBLOCK_ID"], array("PHOTO_EXTERNAL_ID" => $val["FILE"]["EXTERNAL_ID"]));
                        }
                    } else {
                        // Логируем ошибку обновления
                        AddMessage2Log("Ошибка обновления элемента ID: " . $key . ". Ошибка: " . $el->LAST_ERROR);
                    }
                } else {
                    AddMessage2Log("Ошибка: Не удалось создать временный файл: " . $temp_file);
                }
            } else {
                // Логируем ошибку, если $src равен null
                AddMessage2Log("Ошибка: Не удалось создать изображение из файла: " . $path);
                // Освобождаем ресурсы
                if ($im) {
                    imagedestroy($im);
                }
            }
            
        }
    }
    
    /* Почему-то не работает, убираем. Это добавление анонсовых картинок после обработки нейросеткой.
    if ((!$val["PREVIEW_FILE"]) || (($val["PREVIEW_FILE"]["WIDTH"] != $width) || ($val["PREVIEW_FILE"]["HEIGHT"] != $height))) {
        if ($val["FILE"]) {
            $x++;
            
            $im = imagecreatefromwebp($_SERVER["DOCUMENT_ROOT"] . $val["FILE"]["SRC"]);
            imagejpeg($im, $_SERVER["DOCUMENT_ROOT"] . "/upload/temp.jpeg", 100);
            imagedestroy($im);
            
            $file = CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"] . "/upload/temp.jpeg");
            
            $el = new CIBlockElement;
            $el->Update($key, array("PREVIEW_PICTURE" => $file));
        }
    }
    */
}

define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"]."/local/logs/recalculation_menu_log.txt");
AddMessage2Log("Общее количество: " . count($arItems) . ". Пройдено: $n. Обработано: $i. Обработано нейросетью: $k. Создано анонсовых картинок: $x.");

?>

<?php // Устанавливаем нулевые цены для товаров без цен. Розница и Сахалин ОПТ. ?>

<?php 

if(CModule::IncludeModule("iblock"))
{
    $res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 13, "CATALOG_PRICE_1" => false), false, false, Array("ID"));
}
while ($arItem = $res->fetch())
{
    $arItems[$arItem["ID"]]["ID"] = $arItem["ID"];
    $arItemsIDs[] = $arItem["ID"];
}

if(CModule::IncludeModule("iblock"))
{
    $res = CPrice::GetList(Array(), Array("PRODUCT_ID" => $arItemsIDs));
}
while ($arItem = $res->fetch())
{
    $arItems[$arItem["PRODUCT_ID"]][$arItem["CATALOG_GROUP_ID"]] = $arItem["PRICE"];
}

foreach ($arItems as $item) {
    
    $arFields = [];
    $arFields["PRODUCT_ID"] = $item["ID"];
    
    if (!$item["1"]) {
        $arFields["CATALOG_GROUP_ID"] = 1;
        $arFields["CURRENCY"] = "RUB";
        $arFields["PRICE"] = 0.00;
        CPrice::Add($arFields);
    }
    if (!$item["2"]) {
        $arFields["CATALOG_GROUP_ID"] = 2;
        $arFields["CURRENCY"] = "RUB";
        $arFields["PRICE"] = 0.00;
        CPrice::Add($arFields);
    }
}
?>

<?php endif; ?>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>