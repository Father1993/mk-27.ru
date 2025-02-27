<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;
$aMenuLinksExt = array();

if(CModule::IncludeModule('iblock'))
{
	$arFilter = array(
		"TYPE" => "catalog",
		"SITE_ID" => SITE_ID,
	);

	$dbIBlock = CIBlock::GetList(array('SORT' => 'ASC', 'ID' => 'ASC'), $arFilter);
	$dbIBlock = new CIBlockResult($dbIBlock);

	if ($arIBlock = $dbIBlock->GetNext())
	{
		if(defined("BX_COMP_MANAGED_CACHE"))
			$GLOBALS["CACHE_MANAGER"]->RegisterTag("iblock_id_".$arIBlock["ID"]);

		if($arIBlock["ACTIVE"] == "Y")
		{
		    $aMenuLinksExt = $APPLICATION->IncludeComponent("mk:menu.sections", "bootstrap_v4", Array(
		        "CACHE_TIME" => "36000000",
		        "CACHE_TYPE" => "A",
		        "DEPTH_LEVEL" => "2",
		        "DETAIL_PAGE_URL" => "#SECTION_CODE_PATH#/#ELEMENT_CODE#/",
		        "IBLOCK_ID" => "13",
		        "IBLOCK_TYPE" => "catalog",
		        "ID" => $_REQUEST["ID"],
		        "IS_SEF" => "Y",
		        "SECTION_PAGE_URL" => "#SECTION_CODE_PATH#/",
		        "SECTION_URL" => "",
		        "SEF_BASE_URL" => "/"
		    ), false, Array('HIDE_ICONS' => 'Y'));
		}
	}

	if(defined("BX_COMP_MANAGED_CACHE"))
		$GLOBALS["CACHE_MANAGER"]->RegisterTag("iblock_id_new");
}

$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?>