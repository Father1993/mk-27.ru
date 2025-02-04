<?php
// Подключаем процедурный API Битрикс, если скрипт запускается вне Битрикс
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('iblock');

// ID инфоблока с товарами
$IBLOCK_ID = 13; // Замените 2 на фактический ID вашего инфоблока

// Получаем текущую дату
$today = new \Bitrix\Main\Type\DateTime();
$today->setTime(0,0,0); // Устанавливаем начало дня

// Фильтр для выборки товаров
$filter = array(
    "IBLOCK_ID" => $IBLOCK_ID,
    ">=TIMESTAMP_X" => $today, // Измененные с начала сегодняшнего дня
    "ACTIVE" => "N", // Не активные
);

// Выбираем товары по фильтру
$select = array("*");
$res = CIBlockElement::GetList(array(), $filter, false, false, $select);

while($ob = $res->GetNext()){
    //$arFields = $ob->GetFields();
    // Активируем найденные товары
    $ELEMENT_ID = $ob['ID'];
    $el = new CIBlockElement;

    $arLoadProductArray = Array(
        "ACTIVE" => "Y", // Активность товара
    );

    if($res11 = $el->Update($ELEMENT_ID, $arLoadProductArray)){
        echo "Товар с ID: " . $ELEMENT_ID . " (" . $ob['NAME'] . ") успешно активирован.<br>";
    }else{
        echo "Ошибка активации товара с ID: " . $ELEMENT_ID . " (" . $ob['NAME'] . ").<br>";
    }
}
?>