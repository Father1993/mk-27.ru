<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();
/*
global $USER;
if (!$USER->IsAdmin())
{
    foreach ($arResult["ITEMS"] as $key => $val)
    {
        if (!$val["ITEM_PRICES"][0]["PRICE"])
        {
            unset ($arResult["ITEMS"][$key]);
        }
        if (!$val["DETAIL_PICTURE"]["SRC"])
        {
            unset ($arResult["ITEMS"][$key]);
        }
        if ($val["PRODUCT"]["QUANTITY"] < 1)
        {
            unset ($arResult["ITEMS"][$key]);
        }
    }
}
*/