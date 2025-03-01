<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>

<?php 

// Формируем 

foreach ($arResult["ITEMS"] as $key => $item) {
    $res = CIBlockSection::GetByID($item["IBLOCK_SECTION_ID"]);
    $section_name = $res->GetNext()["NAME"];
    
    $arItems[explode(", ", $item["PROPERTIES"]["ADDRESS"]["VALUE"])[0]][$section_name][] = array(
        "NAME" => $item["NAME"],
        "SALARY_FROM" => $item["PROPERTIES"]["SALARY_FROM"]["VALUE"],
        "SALARY_TO" => $item["PROPERTIES"]["SALARY_TO"]["VALUE"],
        "ADDRESS" => $item["PROPERTIES"]["ADDRESS"]["VALUE"],
        "ACTIVE_FROM" => $item["ACTIVE_FROM"],
        "DETAIL_PAGE_URL" => $item["DETAIL_PAGE_URL"],
        "ID" => $item["ID"],
        "EDIT_LINK" => $item["EDIT_LINK"],
        "IBLOCK_ID" => $item["IBLOCK_ID"],
    );
}

ksort($arItems);

foreach ($arItems as $key => $val) {
    ksort($arItems[$key]);
}

$arResult["ITEMS"] = $arItems;

?>