<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

// Подключение необходимых модулей
if (!CModule::IncludeModule("sale") || !CModule::IncludeModule("iblock")) {
    die('Необходимые модули не найдены.');
}

// Получение заказа ID и нового статуса из GET параметров
$orderId = intval($_GET['ORDER_ID']);
$newStatus = htmlspecialchars($_GET['STATUS']);

// Проверка корректности входящих данных
if ($orderId <= 0 || empty($newStatus)) {
    die(json_encode(["RESULT" => "Неправильные параметры."]));
}

// Функция для изменения статуса заказа
function changeOrderStatus($orderId, $newStatus) {
    // Проверка существования заказа
    $order = CSaleOrder::GetByID($orderId);
    if (!$order) {
        return ["RESULT" => "Заказ с ID {$orderId} не найден."];
    }

    // Изменение статуса заказа
    if (CSaleOrder::StatusOrder($orderId, $newStatus)) {
        return ["RESULT" => "Статус заказа успешно изменен."];
    } else {
        return ["RESULT" => "Ошибка при изменении статуса заказа."];
    }
}

// Вызов функции изменения статуса заказа и вывод результата
$result = changeOrderStatus($orderId, $newStatus);
echo json_encode($result);
?>