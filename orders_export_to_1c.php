<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php"); ?>

<?php // Передача заказов с сайта в 1С ?>

<?php 

use Bitrix\Sale;

$data = file_get_contents('php://input'); // Получаем POST данные
$data = (array) json_decode($data);

global $USER;
if (!is_object($USER)) $USER = new CUser;
$arAuthResult = $USER->Login($data["login"], $data["password"], "N");

if ($arAuthResult == 1) { // Проверка авторизции

    CModule::IncludeModule('sale');
    $res = CSaleOrder::GetList(array("ID" => "DESC"), array(), false, Array("nPageSize" => 20));
    while ($arItemOrder = $res->Fetch()) { // Список заказов
        
        $arOrders[$arItemOrder["ID"]]["ID"] = $arItemOrder["ID"];
        $arOrders[$arItemOrder["ID"]]["DATE_STATUS"] = $arItemOrder["DATE_STATUS"];
        $arOrders[$arItemOrder["ID"]]["PRICE"] = $arItemOrder["PRICE"];
        $arOrders[$arItemOrder["ID"]]["XML_ID"] = $arItemOrder["XML_ID"];
        $arOrders[$arItemOrder["ID"]]["USER_DESCRIPTION"] = $arItemOrder["USER_DESCRIPTION"];
        $arOrders[$arItemOrder["ID"]]["PERSON_TYPE_ID"] = $arItemOrder["PERSON_TYPE_ID"];
        $arOrders[$arItemOrder["ID"]]["DELIVERY_ID"] = $arItemOrder["DELIVERY_ID"];
        
        $order = Sale\Order::load($arItemOrder["ID"]);
        $propertyCollection = $order->getPropertyCollection()->getArray();
        foreach ($propertyCollection["properties"] as $val) { // Детали заказа
            $arOrders[$arItemOrder["ID"]][$val["CODE"]] = $val["VALUE"][0];
        }
        
        $listOrderIDs[] = $arItemOrder["ID"];        
    }
    
    $dbBasketItems = CSaleBasket::GetList(
        array(),
        array("ORDER_ID" => $listOrderIDs),
        false,
        false,
        false
    );
    
    while ($arBasketItem = $dbBasketItems->Fetch()) { // Список товаров в заказах
        
        $arOrders[$arBasketItem["ORDER_ID"]]["ITEMS"][$arBasketItem["ID"]]["NAME"] = $arBasketItem["NAME"];
        $arOrders[$arBasketItem["ORDER_ID"]]["ITEMS"][$arBasketItem["ID"]]["PRICE"] = $arBasketItem["PRICE"];
        $arOrders[$arBasketItem["ORDER_ID"]]["ITEMS"][$arBasketItem["ID"]]["QUANTITY"] = $arBasketItem["QUANTITY"];
        $arOrders[$arBasketItem["ORDER_ID"]]["ITEMS"][$arBasketItem["ID"]]["SUMM"] = $arBasketItem["PRICE"] * $arBasketItem["QUANTITY"];
        $arOrders[$arBasketItem["ORDER_ID"]]["ITEMS"][$arBasketItem["ID"]]["PRODUCT_XML_ID"] = $arBasketItem["PRODUCT_XML_ID"];
        $arOrders[$arBasketItem["ORDER_ID"]]["ITEMS"][$arBasketItem["ID"]]["PRICE_TYPE_ID"] = $arBasketItem["PRICE_TYPE_ID"];

    }
    
    foreach ($arOrders as $key => $val) {
        $arOrders[$key]["ITEMS"] = array_values($arOrders[$key]["ITEMS"]);
        
        if ($arOrders[$key]["DELIVERY_ID"] == 2) {
            $delivery = "Доставка";
        } elseif ($arOrders[$key]["DELIVERY_ID"] == 3) {
            $delivery = "Самовывоз";
            
            if ($arOrders[$key]["CITY"] == "Хабаровск") {
                $arOrders[$key]["PICKUP_ADDRESS"] = "680006, г. Хабаровск, ул. Иртышская, 25";
            } elseif ($arOrders[$key]["CITY"] == "Владивосток") {
                $arOrders[$key]["PICKUP_ADDRESS"] = "690039, г. Владивосток, ул.Енисейская, 32, складской комплекс 6";
            } elseif ($arOrders[$key]["CITY"] == "Южно-Сахалинск") {
                $arOrders[$key]["PICKUP_ADDRESS"] = "​693012, г. Южно-Сахалинск, проспект Мира 2Б/8";
            }
            
        }
        
        $arOrders[$key]["ORDER_DESCRIPTION"] = "Номер заказа: " . $arOrders[$key]["ID"] . "\n";
        $arOrders[$key]["ORDER_DESCRIPTION"] .= "Способ доставки: " . $delivery . "\n";
        $arOrders[$key]["ORDER_DESCRIPTION"] .= "Адрес доставки: " . $arOrders[$key]["PICKUP_ADDRESS"] . $arOrders[$key]["ADDRESS"] . "\n";
        
    }
    
    $arOrders = array_values($arOrders); // Сбрасываем ключи массива
    $arOrders = json_encode($arOrders, JSON_UNESCAPED_UNICODE); // Кодируем в JSON
    
    echo $arOrders;
    
    // PERSON_TYPE_ID = 1 — Физическое лицо
    // PERSON_TYPE_ID = 2 — Юридическое лицо
    
    // DELIVERY_ID = 2 — Доставка
    // DELIVERY_ID = 3 — Самовывоз
    
    // PRICE_TYPE_ID = 1 — Розничная Ф
    // PRICE_TYPE_ID = 2 — Сахалин ОПТ
    
    // CITY = Город, выбранный на сайте во время оформления заказа
    // ADDRESS если доставка
    // PICKUP_ADDRESS если самовывоз
    // ORDER_DESCRIPTION = Описание заказа. Номер, способ, адрес.
    
}

?>