<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

// Переворачиваем массив фотографий. Сортировка в обратном порядке.
$arResult["PROPERTIES"]["WINNERS_PHOTOS"]["VALUE"] = array_reverse($arResult["PROPERTIES"]["WINNERS_PHOTOS"]["VALUE"]);


?>

