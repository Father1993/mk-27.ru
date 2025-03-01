<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>

<?php 
 
global $USER;
$arGroups = $USER->GetUserGroupArray();
if (in_array("8", $arGroups)) {
    
    // Тип цен Сахалин ОПТ или РОЗНИЦА
    if (CModule::IncludeModule("iblock")) {
        $res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 35, "ID" => 53503), false, false, Array("ID", "PROPERTY_PRICE_TYPE"));
    }
    $arPriceTypeItem = $res->fetch();
    $priceTypeYsl = $arPriceTypeItem["PROPERTY_PRICE_TYPE_VALUE"];
    
    if ($priceTypeYsl == "Сахалин РОЗНИЦА") {
        $catalog_price_id = "CATALOG_PRICE_14";
    } elseif ($priceTypeYsl == "Сахалин ОПТ") {
        $catalog_price_id = "CATALOG_PRICE_2";
    }

} else {
    $catalog_price_id = "CATALOG_PRICE_1";
}

foreach ($arResult["SEARCH"] as $key => $item) {
    if (substr($item["ITEM_ID"], 0, 1) !== "S") {
        $arIDs[$key] = $item["ITEM_ID"];
    }
}
if ($arIDs) {
    $arSelect = Array("ID", "NAME", $catalog_price_id, "DETAIL_PICTURE");
    $arFilter = Array("IBLOCK_ID"=>IntVal(13), "ID" => $arIDs);
    $res = CIBlockElement::GetList(Array("ID" => $arIDs), $arFilter, false, false, $arSelect);
    while($ob = $res->GetNext())
    {
        $arResult["ADVANCED"][$ob["ID"]]["IS_PRODUCT"] = TRUE;
        $arResult["ADVANCED"][$ob["ID"]]["PRICE"] = $ob[$catalog_price_id];
        $arResult["ADVANCED"][$ob["ID"]]["DETAIL_PICTURE"] = CFile::GetPath($ob["DETAIL_PICTURE"]);
        
        if (!$arResult["ADVANCED"][$ob["ID"]]["PRICE"]) {
            unset($arResult["ADVANCED"][$ob["ID"]]);
            $arDelete[] = $ob["ID"];
        }
        
    }
}

foreach ($arResult["SEARCH"] as $key => $item) {
    if (isset($arDelete) && in_array($item["ITEM_ID"], $arDelete)) {
        unset ($arResult["SEARCH"][$key]);
    }
}

// Сортировка по имени
array_multisort(array_column($arResult["SEARCH"], "TITLE"), SORT_ASC, SORT_STRING, $arResult["SEARCH"]); 

?>