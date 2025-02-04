<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>

<?php 
/*
global $USER;
if (!$USER->IsAdmin())
{
    
    // Выбираем все товары
    if(CModule::IncludeModule("iblock"))
    {
        $res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 5), false, false, Array("ID", "DETAIL_PICTURE", "CATALOG_QUANTITY", "CATALOG_PRICE_2"));
    }
    while ($arItem = $res->fetch())
    {
        // Если есть картинка, остаток и цена
        if ($arItem["DETAIL_PICTURE"] && $arItem["CATALOG_QUANTITY"] > 0 && $arItem["CATALOG_PRICE_2"] > 0)
        {
            $arItems[] = $arItem["ID"];
        }
    }
    
    // Выбираем все разделы для товаров с картинкой, остатком и ценой
    $arGroups = CIBlockElement::GetElementGroups(($arItems), false, array("ID", "IBLOCK_ELEMENT_ID", "NAME"));
    while($arGroup = $arGroups->Fetch())
    {
        if (!in_array($arGroup["NAME"], $arAvailableSections))
        {
            $arAvailableSections[] = $arGroup["NAME"];
        }
    }
    
    // Убираем разделы без подходящих товаров
    foreach ($arResult as $key => $val)
    {
        if (!in_array($val["TEXT"], $arAvailableSections))
        {
            unset ($arResult[$key]);
        }
    }

}
*/

// Добавляем код элемента для подгрузки картинок

foreach ($arResult as $key => $menu_item) {
    $arResult[$key]["CODE"] = str_replace("/", "", $menu_item["LINK"]);
}

?>