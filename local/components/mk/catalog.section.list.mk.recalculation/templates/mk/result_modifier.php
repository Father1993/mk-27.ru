<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$sectList = CIBlockSection::GetList($arSort, array("IBLOCK_ID" => 13), false, array("ID", "UF_ELEMENT_CNT"));
while ($sectListGet = $sectList->GetNext())
{
    $arSections[$sectListGet["ID"]]["UF_ELEMENT_CNT"] = $sectListGet["UF_ELEMENT_CNT"];
}

// Инициализируем счетчик изменённых разделов
$s = 0;

if (!empty($arResult["SECTIONS"])) {
    foreach ($arResult["SECTIONS"] as $section) {
        $s++;
        $bs = new CIBlockSection;
        $bs->Update($section["ID"], array("UF_ELEMENT_CNT" => $section["ELEMENT_CNT"]));
    }
    
} 

// Проверяем существование директории для логов
$log_dir = $_SERVER["DOCUMENT_ROOT"]."/local/logs/";
if (!file_exists($log_dir)) {
    mkdir($log_dir, 0755, true);
}

define("LOG_FILENAME", $log_dir."recalculation_menu_log.txt");
AddMessage2Log("Количество изменённых разделов: $s.");

?>