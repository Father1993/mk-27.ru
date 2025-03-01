<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

// Сортируем товары по разделам. Чтобы выбирались по одному элементу из раздела, на каждый раздел, потом второй элемент и т.д.

foreach ($arResult["ITEMS"] as $item) {
    $arSectItems[$item["IBLOCK_SECTION_ID"]][] = $item["NAME"];
}

pprint ($arSectItems);

$max_count = 0;
foreach ($arSectItems as $sect_ID => $arItems) {
    if ($max_count < count($arItems)) {
        $max_count = count($arItems);
    }
}

for ($i = 0; $i < $max_count; $i++) {
    foreach ($arSectItems as $sect_ID => $arItems) {
        if ($arSectItems[$sect_ID][$i]) {
            $newResultItems[] = $arSectItems[$sect_ID][$i];
        }
    }
}

pprint ($newResultItems);

$arResult["ITEMS"] = $newResultItems;

?>