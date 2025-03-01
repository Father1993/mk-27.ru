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
?>
<script src='https://www.google.com/recaptcha/api.js'></script>
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

<form method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform">
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

<div class="container">
    <div class="row">
        <div class="col-md-4 reg-left-side">
            <div class="bx-authform-formgroup-container">
                <div class="bx-authform-label-container">Логин (мин. 3 символа)<span class="starrequired">*</span></div>
                <div class="bx-authform-input-container">
                    <input size="30" type="text" name="LOGIN" value="">
                </div>
            </div>
            <div class="bx-authform-formgroup-container">
                <div class="bx-authform-label-container">Email<span class="starrequired">*</span></div>
                <div class="bx-authform-input-container">
                    <input size="30" type="text" name="EMAIL" value="">
                </div>
            </div>
            <div class="bx-authform-formgroup-container">
                <div class="bx-authform-label-container">
                    ИНН организации:
                </div>
                <div class="bx-authform-input-container">
                    <input type="text" name="UF_ORGINN" maxlength="255" value="">
                </div>
            </div>
            <div class="bx-authform-formgroup-container">
                <div class="bx-authform-label-container">
                    Название организации:
                </div>
                <div class="bx-authform-input-container">
                    <input type="text" name="UF_ORGNAME" maxlength="255" value="">
                </div>
            </div>
            <div class="bx-authform-formgroup-container">
                <div class="bx-authform-label-container">
                    Юридический адрес:
                </div>
                <div class="bx-authform-input-container">
                    <input type="text" name="UF_URADDRESS" maxlength="255" value="">
                </div>
            </div>
            <div class="bx-authform-formgroup-container">
                <div class="bx-authform-label-container">
                    Телефон руководителя:
                </div>
                <div class="bx-authform-input-container">
                    <input type="text" name="UF_HEAD_PHONE" maxlength="255" value="">
                </div>
            </div>
            <div class="bx-authform-formgroup-container">
                <div class="bx-authform-label-container">
                    Контактное лицо:
                </div>
                <div class="bx-authform-input-container">
                    <input type="text" name="UF_CONTACT_PERSON" maxlength="255" value="">
                </div>
            </div>
            <div class="bx-authform-formgroup-container">
                <div class="g-recaptcha" data-sitekey="<?=$publicKey?>"></div>
            </div>
            <?
            // публичный ключ:   6LdgL6cpAAAAAKzSqysYCO4IzzYBz46tcKDDjI21
            //приватный ключ:   6LdgL6cpAAAAANOvx1rPzhJJQ_VEnUyXQO6ec1cA
            ?>
        </div>
        <div class="col-md-1"></div>
        <div class="col-md-4 reg-right-side">

            <div class="bx-authform-formgroup-container">
                <div class="bx-authform-label-container">Пароль</div>
                <div class="bx-authform-input-container">
                    <input size="30" type="password" name="REGISTER[PASSWORD]" value="" autocomplete="off" class="bx-auth-input">
                </div>
            </div>
            <div class="bx-authform-formgroup-container">
                <div class="bx-authform-label-container">Подтверждение пароля</div>
                <div class="bx-authform-input-container">
                    <input size="30" type="password" name="REGISTER[CONFIRM_PASSWORD]" value="" autocomplete="off">
                </div>
            </div>
            <div class="bx-authform-formgroup-container">
                <div class="bx-authform-label-container">
                    КПП:
                </div>
                <div class="bx-authform-input-container">
                    <input type="text" name="UF_KPPORG" maxlength="255" value="">
                </div>
            </div>
            <div class="bx-authform-formgroup-container">
                <div class="bx-authform-label-container">
                    ФИО руководителя:
                </div>
                <div class="bx-authform-input-container">
                    <input type="text" name="UF_FIO" maxlength="255" value="">
                </div>
            </div>
            <div class="bx-authform-formgroup-container">
                <div class="bx-authform-label-container">
                    Почтовый адрес:
                </div>
                <div class="bx-authform-input-container">
                    <input type="text" name="UF_POST_ADDRESS" maxlength="255" value="">
                </div>
            </div>
            <div class="bx-authform-formgroup-container">
                <div class="bx-authform-label-container">
                    Адрес доставки:
                </div>
                <div class="bx-authform-input-container">
                    <input type="text" name="UF_DELIVERY_ADDR" maxlength="255" value="">
                </div>
            </div>

        </div>
    </div>
</div>
    <div class="bx-authform-formgroup-container">
        <input type="submit" class="btn btn-primary" name="register_submit_button" value="<?=GetMessage("AUTH_REGISTER")?>">
    </div>
    </form>

    <p><?echo $arResult["GROUP_POLICY"]["PASSWORD_REQUIREMENTS"];?></p>

    <?endif //$arResult["SHOW_SMS_FIELD"] == true ?>

    <p><span class="starrequired">*</span><?=GetMessage("AUTH_REQ")?></p>

    <?endif?>
    </div>
</div>
</div>