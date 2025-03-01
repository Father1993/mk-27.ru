<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

foreach ($arResult['SECTIONS'] as $key => $section) {

    pprint ($section["NAME"]);
    pprint ($section["ELEMENT_CNT"]);
    
    //$bs = new CIBlockSection;
    //$bs->Update($section["ID"], array("UF_ELEMENT_CNT" => $section["ELEMENT_CNT"])); 
    
}

define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"]."/recalculation_menu_log.txt");
AddMessage2Log(date("d.m.Y G:i:s") . " - OK");

?>