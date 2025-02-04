<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php"); ?>
<?php 

if ($_GET["code"] == "fa6a09a5396ec03b7a19bf09f6a49b94") {
    
    if(CModule::IncludeModule("iblock"))
    {
        $res = CIBlockElement::GetList(Array("ID"=>"DESC"), Array("IBLOCK_ID" => 37), false, Array("nPageSize" => 20), 
            Array("ID", "DATE_CREATE", "NAME", "PROPERTY_COUNT", "PROPERTY_NAME_FROM", "PROPERTY_PHONE", "PROPERTY_PRODUCT_LINK", "PROPERTY_CITY", "PROPERTY_EMAIL", "PROPERTY_PRODUCT_XML_ID", ));
    }
    while ($arItem = $res->fetch())
    {
        $arResult[$arItem["ID"]]["ID"] = $arItem["ID"];
        $arResult[$arItem["ID"]]["DATE_CREATE"] = $arItem["DATE_CREATE"];
        $arResult[$arItem["ID"]]["NAME"] = $arItem["NAME"];
        $arResult[$arItem["ID"]]["COUNT"] = $arItem["PROPERTY_COUNT_VALUE"];
        $arResult[$arItem["ID"]]["NAME_FROM"] = $arItem["PROPERTY_NAME_FROM_VALUE"];
        $arResult[$arItem["ID"]]["PHONE"] = $arItem["PROPERTY_PHONE_VALUE"];
        $arResult[$arItem["ID"]]["PRODUCT_LINK"] = $arItem["PROPERTY_PRODUCT_LINK_VALUE"];
        $arResult[$arItem["ID"]]["CITY"] = $arItem["PROPERTY_CITY_VALUE"];
        $arResult[$arItem["ID"]]["EMAIL"] = $arItem["PROPERTY_EMAIL_VALUE"];
        $arResult[$arItem["ID"]]["PRODUCT_XML_ID"] = $arItem["PROPERTY_PRODUCT_XML_ID_VALUE"];
    }
    //pprint ($arResult);
    $arResult = array_values($arResult); // Сбрасываем ключи массива
    $arResult = json_encode($arResult, JSON_UNESCAPED_UNICODE); // Кодируем в JSON
    
    echo $arResult;
    
}

/*
ID - id (в битриксе)
DATE_CREATE - Дата создания
NAME - Название товара
NAME_FROM - От кого
PHONE - Номер телефона
PRODUCT_LINK - Ссылка на товар
CITY - Город
EMAIL - Email
PRODUCT_XML_ID - Внешний код
*/



?>