<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>


<?php 

// Хак на избранное, формируем ссылку на детальную страницу с учетом раздела.

if ($APPLICATION->GetCurPage() == "/izbrannoe/")
{
    $arSectionUrl = CIBlockSection::GetByID($arResult["ITEM"]["IBLOCK_SECTION_ID"]);
    if ($sectinoUrl = $arSectionUrl->GetNext())
    {
        $arResult["ITEM"]["DETAIL_PAGE_URL"] = $sectinoUrl['SECTION_PAGE_URL'] . $arResult["ITEM"]["CODE"] . "/";
    }
}

    

?>