<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?

// Складываем заказ удобненько в $arResult["ORDERS_LIST"]

foreach ($arResult["ORDERS"] as $order) {
        
    $arResult["ORDERS_LIST"][$order["ORDER"]["ID"]]["ID"] = $order["ORDER"]["ID"];
    $arResult["ORDERS_LIST"][$order["ORDER"]["ID"]]["PRICE"] = $order["ORDER"]["PRICE"];
    $arResult["ORDERS_LIST"][$order["ORDER"]["ID"]]["USER_DESCRIPTION"] = $order["ORDER"]["USER_DESCRIPTION"];
    $arResult["ORDERS_LIST"][$order["ORDER"]["ID"]]["DATE_INSERT_FORMATED"] = $order["ORDER"]["DATE_INSERT_FORMATED"];
    $arResult["ORDERS_LIST"][$order["ORDER"]["ID"]]["SHIPMENT"] = $order["ORDER"]["SHIPMENT"][0]["DELIVERY_NAME"];
    
    foreach ($order["BASKET_ITEMS"] as $basket_items) {
        
        $arResult["ORDERS_LIST"][$order["ORDER"]["ID"]]["BASKET"][$basket_items["PRODUCT_ID"]]["PRODUCT_ID"] = $basket_items["PRODUCT_ID"];
        $arResult["ORDERS_LIST"][$order["ORDER"]["ID"]]["BASKET"][$basket_items["PRODUCT_ID"]]["NAME"] = $basket_items["NAME"];
        $arResult["ORDERS_LIST"][$order["ORDER"]["ID"]]["BASKET"][$basket_items["PRODUCT_ID"]]["QUANTITY"] = $basket_items["QUANTITY"];
        $arResult["ORDERS_LIST"][$order["ORDER"]["ID"]]["BASKET"][$basket_items["PRODUCT_ID"]]["PRICE"] = $basket_items["PRICE"];
        $arResult["ORDERS_LIST"][$order["ORDER"]["ID"]]["BASKET"][$basket_items["PRODUCT_ID"]]["DETAIL_PAGE_URL"] = $basket_items["DETAIL_PAGE_URL"];
        $arResult["ORDERS_LIST"][$order["ORDER"]["ID"]]["BASKET"][$basket_items["PRODUCT_ID"]]["MEASURE_NAME"] = $basket_items["MEASURE_NAME"];
        
        $arProducts[] = $basket_items["PRODUCT_ID"];
    }

}

// Складываем картинки товаров удобненько в $arResult["PRODUCT_PICTURES"]

if(CModule::IncludeModule("iblock")) {
    $res = CIBlockElement::GetList(Array(), Array("ID" => $arProducts), false, false, Array("ID", "DETAIL_PICTURE"));
}
while ($arItem = $res->fetch()) {
    $arResult["PRODUCT_PICTURES"][$arItem["ID"]] = CFile::GetPath($arItem["DETAIL_PICTURE"]);
}
