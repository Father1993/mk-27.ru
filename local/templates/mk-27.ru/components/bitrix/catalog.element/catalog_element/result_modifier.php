<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

// Собираем все ID фоток в 1 массив
$arResult["PHOTOS"][]["ID"] = $arResult["DETAIL_PICTURE"]["ID"];
foreach ($arResult["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $key => $photoID)
{
    $arResult["PHOTOS"][]["ID"] = $photoID;
}

// Убираем пустые свойства
foreach ($arResult["PROPERTIES"] as $key => $arProps)
{
    if (!$arProps["VALUE"])
    {
        unset ($arResult["PROPERTIES"][$key]);
    }
}
?>

<?php
// Передаём картинку в component_epilog для вывода в open graph
global $APPLICATION;
$cp = $this->__component;
if (is_object($cp))
{
    $cp->arResult['DETAIL_PICTURE'] = $arResult["DETAIL_PICTURE"]["ID"];
    $cp->SetResultCacheKeys(array('DETAIL_PICTURE'));
    $arResult['DETAIL_PICTURE'] = $cp->arResult['DETAIL_PICTURE'];
}
?>

<?php 
/*
// Убираем свойства, где текст обрезан (1С не может записывать более 150 символов)
foreach ($arResult["PROPERTIES"] as $key => $val)
{
    if (strlen($val["VALUE"]) == 150)
    {
        unset ($arResult["PROPERTIES"][$key]);
    }
}
*/



?>

<?php 

if (empty($arResult["ITEM_PRICES"])) {
    LocalRedirect("/404.php", false, "404 Not Found");
}

?>

