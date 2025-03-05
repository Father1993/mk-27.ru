<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

// Проверяем права доступа
if (!$USER->IsAdmin()) {
    die("Доступ запрещен. Требуются права администратора.");
}

// Подключаем необходимые модули
if (!CModule::IncludeModule("iblock")) {
    die("Не удалось подключить модуль 'iblock'");
}

// Проверяем, существует ли уже инфоблок с ID 670
$res = CIBlock::GetByID(670);
if ($ar_res = $res->GetNext()) {
    echo "Инфоблок с ID 670 уже существует.<br>";
    $iblockId = 670;
} else {
    // Создаем новый инфоблок
    $arFields = array(
        "ACTIVE" => "Y",
        "NAME" => "Режимы работы",
        "CODE" => "holiday_schedule",
        "IBLOCK_TYPE_ID" => "info",
        "SITE_ID" => array("s1"),
        "SORT" => 500,
        "GROUP_ID" => array("1" => "X", "2" => "R"),
        "FIELDS" => array(
            "ACTIVE" => array("IS_REQUIRED" => "Y"),
            "NAME" => array("IS_REQUIRED" => "Y"),
            "DETAIL_TEXT_TYPE" => array("DEFAULT_VALUE" => "html"),
        ),
    );

    $iblock = new CIBlock;
    $iblockId = $iblock->Add($arFields);

    if (!$iblockId) {
        die("Ошибка при создании инфоблока: " . $iblock->LAST_ERROR);
    }

    echo "Создан новый инфоблок с ID: " . $iblockId . "<br>";

    // Создаем свойства инфоблока
    $arProps = array(
        array(
            "NAME" => "Код города",
            "CODE" => "KOD_GORODA",
            "PROPERTY_TYPE" => "S",
            "SORT" => 100,
        ),
        array(
            "NAME" => "Город",
            "CODE" => "GOROD",
            "PROPERTY_TYPE" => "S",
            "SORT" => 200,
        ),
    );

    $ibp = new CIBlockProperty;
    foreach ($arProps as $prop) {
        $prop["IBLOCK_ID"] = $iblockId;
        $propId = $ibp->Add($prop);
        if (!$propId) {
            echo "Ошибка при создании свойства '" . $prop["NAME"] . "': " . $ibp->LAST_ERROR . "<br>";
        } else {
            echo "Создано свойство '" . $prop["NAME"] . "' с ID: " . $propId . "<br>";
        }
    }
}

// Создаем элементы инфоблока
$cities = array(
    array(
        "NAME" => "Режим работы Хабаровск",
        "CODE" => "rezhim-raboty-khabarovsk",
        "SORT" => 500,
        "DETAIL_TEXT" => "<h3>Праздничный режим работы в Хабаровске</h3>
<p>Уважаемые клиенты! В связи с предстоящими праздниками наш магазин в Хабаровске будет работать по следующему графику:</p>
<ul>
<li>31 декабря: с 9:00 до 15:00</li>
<li>1-3 января: выходные дни</li>
<li>4-6 января: с 10:00 до 18:00</li>
<li>7 января: выходной день</li>
<li>8 января и далее: в обычном режиме</li>
</ul>
<p>Желаем вам счастливых праздников!</p>",
        "PROPERTY_VALUES" => array(
            "KOD_GORODA" => "khb",
            "GOROD" => "Хабаровск",
        ),
    ),
    array(
        "NAME" => "Режим работы Владивосток",
        "CODE" => "rezhim-raboty-vladivostok",
        "SORT" => 500,
        "DETAIL_TEXT" => "<h3>Праздничный режим работы во Владивостоке</h3>
<p>Уважаемые клиенты! В связи с предстоящими праздниками наш магазин во Владивостоке будет работать по следующему графику:</p>
<ul>
<li>31 декабря: с 9:00 до 15:00</li>
<li>1-3 января: выходные дни</li>
<li>4-6 января: с 10:00 до 18:00</li>
<li>7 января: выходной день</li>
<li>8 января и далее: в обычном режиме</li>
</ul>
<p>Желаем вам счастливых праздников!</p>",
        "PROPERTY_VALUES" => array(
            "KOD_GORODA" => "vld",
            "GOROD" => "Владивосток",
        ),
    ),
    array(
        "NAME" => "Режим работы Южно-Сахалинск",
        "CODE" => "rezhim-raboty-yuzhno-sakhalinsk",
        "SORT" => 500,
        "DETAIL_TEXT" => "<h3>Праздничный режим работы в Южно-Сахалинске</h3>
<p>Уважаемые клиенты! В связи с предстоящими праздниками наш магазин в Южно-Сахалинске будет работать по следующему графику:</p>
<ul>
<li>31 декабря: с 9:00 до 15:00</li>
<li>1-3 января: выходные дни</li>
<li>4-6 января: с 10:00 до 18:00</li>
<li>7 января: выходной день</li>
<li>8 января и далее: в обычном режиме</li>
</ul>
<p>Желаем вам счастливых праздников!</p>",
        "PROPERTY_VALUES" => array(
            "KOD_GORODA" => "ysl",
            "GOROD" => "Южно-Сахалинск",
        ),
    ),
);

// Создаем элементы
$el = new CIBlockElement;
foreach ($cities as $index => $city) {
    // Проверяем, существует ли уже элемент с таким кодом
    $res = CIBlockElement::GetList(
        array(),
        array("IBLOCK_ID" => $iblockId, "CODE" => $city["CODE"]),
        false,
        false,
        array("ID")
    );
    
    if ($ar_res = $res->GetNext()) {
        echo "Элемент '" . $city["NAME"] . "' уже существует с ID: " . $ar_res["ID"] . "<br>";
        
        // Обновляем элемент
        $city["IBLOCK_ID"] = $iblockId;
        $result = $el->Update($ar_res["ID"], $city);
        if (!$result) {
            echo "Ошибка при обновлении элемента '" . $city["NAME"] . "': " . $el->LAST_ERROR . "<br>";
        } else {
            echo "Элемент '" . $city["NAME"] . "' успешно обновлен.<br>";
        }
    } else {
        // Создаем новый элемент
        $city["IBLOCK_ID"] = $iblockId;
        $city["ACTIVE"] = "Y";
        
        $elementId = $el->Add($city);
        if (!$elementId) {
            echo "Ошибка при создании элемента '" . $city["NAME"] . "': " . $el->LAST_ERROR . "<br>";
        } else {
            echo "Создан элемент '" . $city["NAME"] . "' с ID: " . $elementId . "<br>";
        }
    }
}

echo "<br>Скрипт выполнен успешно!";
?>