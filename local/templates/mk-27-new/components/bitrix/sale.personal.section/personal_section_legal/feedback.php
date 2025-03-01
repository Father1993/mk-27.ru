<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Localization\Loc;

if ($arParams["MAIN_CHAIN_NAME"] <> '')
{
	$APPLICATION->AddChainItem(htmlspecialcharsbx($arParams["MAIN_CHAIN_NAME"]), $arResult['SEF_FOLDER']);
}
?>

<div class="container personal">
    <div class="row">
        <div class="col-12 col-lg-3 personal-left">
            <div class="personal-menu">
                <?php $APPLICATION->IncludeFile(
                    SITE_TEMPLATE_PATH . "/components/bitrix/sale.personal.section/personal_section_legal/personal_menu.php",
                    Array(),
                    Array("MODE"=>"PHP")
                ); ?>
            </div>
        </div>

        <div class="col-12 col-lg-9">

            <h1>Обратная связь</h1>

            <?$APPLICATION->IncludeComponent("bitrix:form","",Array(
                    "AJAX_MODE" => "N",
                    "SEF_MODE" => "Y",
                    "WEB_FORM_ID" => "1",
                    "RESULT_ID" => $_REQUEST["RESULT_ID"],
                    "START_PAGE" => "new",
                    "SHOW_LIST_PAGE" => "N",
                    "SHOW_EDIT_PAGE" => "N",
                    "SHOW_VIEW_PAGE" => "N",
                    "SUCCESS_URL" => "",
                    "SHOW_ANSWER_VALUE" => "Y",
                    "SHOW_ADDITIONAL" => "Y",
                    "SHOW_STATUS" => "Y",
                    "EDIT_ADDITIONAL" => "Y",
                    "EDIT_STATUS" => "Y",
                    "NOT_SHOW_FILTER" => Array(),
                    "NOT_SHOW_TABLE" => Array(),
                    "CHAIN_ITEM_TEXT" => "",
                    "CHAIN_ITEM_LINK" => "",
                    "IGNORE_CUSTOM_TEMPLATE" => "Y",
                    "NAME_TEMPLATE" => "#LAST_NAME# #NAME#",
                    "USE_EXTENDED_ERRORS" => "Y",
                    "CACHE_TYPE" => "A",
                    "CACHE_TIME" => "3600",
                    "AJAX_OPTION_JUMP" => "N",
                    "AJAX_OPTION_STYLE" => "Y",
                    "AJAX_OPTION_HISTORY" => "N",
                    "SEF_FOLDER" => "/communication/web-forms/",
                    "SEF_URL_TEMPLATES" => Array(
                        "new" => "#WEB_FORM_ID#/",
                        "list" => "#WEB_FORM_ID#/list/",
                        "edit" => "#WEB_FORM_ID#/edit/#RESULT_ID#/",
                        "view" => "#WEB_FORM_ID#/view/#RESULT_ID#/"
                    ),
                    "VARIABLE_ALIASES" => Array(
                        "new" => Array(),
                        "list" => Array(),
                        "edit" => Array(),
                        "view" => Array(),
                    )
                )
            );?>
        </div>
    </div>
</div>

<style>
    .container.personal .personal-left {
        padding-left: 0px;
    }
    .main-block .container {
        padding-left: 6px;
    }
</style>

