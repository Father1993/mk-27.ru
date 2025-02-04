<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 */

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

if($arResult["SHOW_SMS_FIELD"] == true)
{
	CJSCore::Init('phone_auth');
}
$publicKey = "6LdgL6cpAAAAAKzSqysYCO4IzzYBz46tcKDDjI21";
$dadataKey = "b9f0a7c5b2905af336a9dc9a99d0cf36d0c3ca85";

global $APPLICATION;
$APPLICATION->SetAdditionalCSS (SITE_TEMPLATE_PATH . "/assets/plugins/fancybox/suggestions.min.css");
$APPLICATION->AddHeadScript (SITE_TEMPLATE_PATH . "/assets/plugins/jquery.suggestions.min.js");
?>
<div class="bx-auth-reg legal-entity col-md-12">

    <?if($USER->IsAuthorized()):?>

<p><?echo GetMessage("MAIN_REGISTER_AUTH")?></p>

<?else:?>
<?
if (!empty($arResult["ERRORS"])):
	foreach ($arResult["ERRORS"] as $key => $error)
		if (intval($key) == 0 && $key !== 0)
			$arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_".$key)."&quot;", $error);

	ShowError(implode("<br />", $arResult["ERRORS"]));

elseif($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):
?>
<p><?echo GetMessage("REGISTER_EMAIL_WILL_BE_SENT")?></p>
<?endif?>

<?if($arResult["SHOW_SMS_FIELD"] == true):?>

<form method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" id="regform">
<?
if($arResult["BACKURL"] <> ''):
?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?
endif;
?>
<input type="hidden" name="SIGNED_DATA" value="<?=htmlspecialcharsbx($arResult["SIGNED_DATA"])?>" />
<table>
	<tbody>
		<tr>
			<td><?echo GetMessage("main_register_sms")?><span class="starrequired">*</span></td>
			<td><input size="30" type="text" name="SMS_CODE" value="<?=htmlspecialcharsbx($arResult["SMS_CODE"])?>" autocomplete="off" /></td>
		</tr>
	</tbody>
	<tfoot>
		<tr>
			<td></td>
			<td><input type="submit" name="code_submit_button" value="<?echo GetMessage("main_register_sms_send")?>" /></td>
		</tr>
	</tfoot>
</table>
</form>

<script>
new BX.PhoneAuth({
	containerId: 'bx_register_resend',
	errorContainerId: 'bx_register_error',
	interval: <?=$arResult["PHONE_CODE_RESEND_INTERVAL"]?>,
	data:
		<?=CUtil::PhpToJSObject([
			'signedData' => $arResult["SIGNED_DATA"],
		])?>,
	onError:
		function(response)
		{
			var errorDiv = BX('bx_register_error');
			var errorNode = BX.findChildByClassName(errorDiv, 'errortext');
			errorNode.innerHTML = '';
			for(var i = 0; i < response.errors.length; i++)
			{
				errorNode.innerHTML = errorNode.innerHTML + BX.util.htmlspecialchars(response.errors[i].message) + '<br>';
			}
			errorDiv.style.display = '';
		}
});
</script>

<div id="bx_register_error" style="display:none"><?ShowError("error")?></div>

<div id="bx_register_resend"></div>

<?else:?>

<form method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data">
<?
if($arResult["BACKURL"] <> ''):
?>
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
<?
endif;

    $arLeftCol = [];
    $arRightCol = [];
?>
<input type="hidden" name="UF_ISURFACE" value="Да">
<div class="container">
    <div class="row">
        <div class="col-md-4 reg-left-side">
            <div class="bx-authform-formgroup-container">
                <div class="bx-authform-label-container">Логин (мин. 3 символа)<span class="starrequired">*</span></div>
                <div class="bx-authform-input-container">
                    <input size="30" type="text" name="REGISTER[LOGIN]" required value="">
                </div>
            </div>
            <div class="bx-authform-formgroup-container">
                <div class="bx-authform-label-container">Email<span class="starrequired">*</span></div>
                <div class="bx-authform-input-container">
                    <input size="30" type="text" name="REGISTER[EMAIL]" required value="">
                </div>
            </div>
            <div class="bx-authform-formgroup-container">
                <div class="bx-authform-label-container">
                    ИНН организации<span class="starrequired">***</span>
                </div>
                <div class="bx-authform-input-container">
                    <input type="text" name="UF_ORGINN" maxlength="255" required id="UF_ORGINN" value="">
                </div>
            </div>
            <div class="bx-authform-formgroup-container">
                <div class="bx-authform-label-container">
                    Название организации<span class="starrequired">*</span>
                </div>
                <div class="bx-authform-input-container">
                    <input type="text" name="UF_ORGNAME" maxlength="255" required id="UF_ORGNAME" value="">
                </div>
            </div>
            <div class="bx-authform-formgroup-container">
                <div class="bx-authform-label-container">
                    Юридический адрес<span class="starrequired">*</span>
                </div>
                <div class="bx-authform-input-container">
                    <input type="text" name="UF_URADDRESS" maxlength="255" required id="UF_URADDRESS" value="">
                </div>
            </div>
            <div class="bx-authform-formgroup-container">
                <div class="bx-authform-label-container">
                    Телефон руководителя<span class="starrequired">*</span>
                </div>
                <div class="bx-authform-input-container">
                    <input type="text" name="UF_HEAD_PHONE" maxlength="255" required id="UF_HEAD_PHONE" value="">
                </div>
            </div>
            <div class="bx-authform-formgroup-container">
                <div class="bx-authform-label-container">
                    Контактное лицо<span class="starrequired">*</span>
                </div>
                <div class="bx-authform-input-container">
                    <input type="text" name="UF_CONTACT_PERSON" maxlength="255" id="UF_CONTACT_PERSON" value="">
                </div>
            </div>
            <div class="bx-authform-formgroup-container">
                <div class="g-recaptcha" data-sitekey="<?=$publicKey?>" data-callback="onRecaptchaSuccess"></div>
            </div>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-4 reg-right-side">

            <div class="bx-authform-formgroup-container">
                <div class="bx-authform-label-container">Пароль<span class="starrequired">*</span></div>
                <div class="bx-authform-input-container">
                    <input size="30" type="password" name="REGISTER[PASSWORD]" id="password-field" required value="" autocomplete="off" class="bx-auth-input password-field">
                    <i class="fa fa-eye fa-lg password-toggle" onclick="togglePasswordVisibility()"></i>
                </div>
            </div>
            <div class="bx-authform-formgroup-container">
                <div class="bx-authform-label-container">Подтверждение пароля<span class="starrequired">*</span></div>
                <div class="bx-authform-input-container">
                    <input size="30" type="password" name="REGISTER[CONFIRM_PASSWORD]" required id="password-repeat-field"  value="" autocomplete="off" class="bx-auth-input password-field">
                    <i class="fa fa-eye fa-lg password-confirm-toggle" onclick="toggleConfirmPasswordVisibility()"></i>
                </div>
            </div>
            <div class="bx-authform-formgroup-container">
                <div class="bx-authform-label-container">
                    КПП<span class="starrequired">*</span>
                </div>
                <div class="bx-authform-input-container">
                    <input type="text" name="UF_KPPORG" maxlength="255" required id="UF_KPPORG" value="">
                </div>
            </div>
            <div class="bx-authform-formgroup-container">
                <div class="bx-authform-label-container">
                    ФИО руководителя<span class="starrequired">*</span>
                </div>
                <div class="bx-authform-input-container">
                    <input type="text" name="UF_FIO" maxlength="255" required id="UF_FIO" value="">
                </div>
            </div>
            <div class="bx-authform-formgroup-container">
                <div class="bx-authform-label-container">
                    Почтовый адрес
                </div>
                <div class="bx-authform-input-container">
                    <input type="text" name="UF_POST_ADDRESS" maxlength="255" id="UF_POST_ADDRESS" value="">
                </div>
            </div>
            <div class="bx-authform-formgroup-container">
                <div class="bx-authform-label-container">
                    Адрес доставки
                </div>
                <div class="bx-authform-input-container">
                    <input type="text" name="UF_DELIVERY_ADDR" maxlength="255" id="UF_DELIVERY_ADDR" value="">
                </div>
            </div>

        </div>
    </div>
</div>
    <div class="bx-authform-formgroup-container">
        <input disabled type="submit" class="btn btn-primary" id="register_submit_button" name="register_submit_button" value="<?=GetMessage("AUTH_REGISTER")?>">
        <div class="submit-disable-notice">Подтвердите, что вы не робот</div>
    </div>
    </form>

    <p><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></p>

    <?endif //$arResult["SHOW_SMS_FIELD"] == true ?>

    <p><span class="starrequired">*</span><?=GetMessage("AUTH_REQ")?></p>
    <p><span class="starrequired">***</span><?=GetMessage("CAN_DADATA")?></p>
    <?endif?>
    </div>
</div>
</div>
<script>
    $("#UF_ORGINN").suggestions({
        token: "<?=$dadataKey?>",
        type: "PARTY",
        onSelect: function(suggestion) {
            var inn = suggestion["data"]["inn"];
            var kpp = suggestion["data"]["kpp"];
            var orgname = suggestion["value"];
			if(suggestion["data"]["address"]["value"] != undefined)
            	var address = suggestion["data"]["address"]["value"];
            if(suggestion["data"]["opf"]["short"] == "ИП") {
                var headname = suggestion["data"]["name"]["full"];
            } else {
                var headname = suggestion["data"]["management"]["name"];
            }
            $('#UF_ORGINN').val(inn);
            $('#UF_ORGNAME').val(orgname);
            $('#UF_KPPORG').val(kpp);
            $('#UF_URADDRESS').val(address);
            $('#UF_POST_ADDRESS').val(address);
            $('#UF_FIO').val(headname);
        }
    });

</script>