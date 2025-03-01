<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogTopComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

// Убираем элементы подразделов из ТОПа.
foreach ($arResult["ITEMS"] as $key => $item) {
    if ($item["IBLOCK_SECTION_ID"]) {
        unset ($arResult["ITEMS"][$key]);
    }
}