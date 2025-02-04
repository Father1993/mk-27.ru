<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$sectList = CIBlockSection::GetList($arSort, array("IBLOCK_ID" => 13), false, array("ID", "UF_ELEMENT_CNT"));
while ($sectListGet = $sectList->GetNext())
{
    $arSections[$sectListGet["ID"]]["UF_ELEMENT_CNT"] = $sectListGet["UF_ELEMENT_CNT"];
}

// Изменяем количество товаров в свойстве раздела.
$s = 0;
foreach ($arResult['SECTIONS'] as $key => $section) {

    if ($arSections[$section["ID"]]["UF_ELEMENT_CNT"] != $section["ELEMENT_CNT"]) {
        $s++;
        $bs = new CIBlockSection;
        $bs->Update($section["ID"], array("UF_ELEMENT_CNT" => $section["ELEMENT_CNT"]));
    }
    
} 

define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"]."/recalculation_menu_log.txt");
AddMessage2Log("Количество изменённых разделов: $s.");

?>