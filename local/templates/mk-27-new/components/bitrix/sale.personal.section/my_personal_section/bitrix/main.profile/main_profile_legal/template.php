<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use Bitrix\Main\Localization\Loc;

global $USER;
$arUser = $USER::GetById($USER->getId())->Fetch();

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

			<h1>Профиль пользователя</h1>

            <div class="bx_profile">
            	<?
            	ShowError($arResult["strProfileError"]);

            	if (($arResult['DATA_SAVED'] ?? 'N') === 'Y')
            	{
            		ShowNote(Loc::getMessage('PROFILE_DATA_SAVED'));
            	}

            	?>
            	<form method="post" name="form1" action="<?=POST_FORM_ACTION_URI?>" enctype="multipart/form-data" role="form">
            		<?=$arResult["BX_SESSION_CHECK"]?>
            		<input type="hidden" name="lang" value="<?=LANG?>" />
            		<input type="hidden" name="ID" value="<?=$arResult["ID"]?>" />
            		<input type="hidden" name="LOGIN" value="<?=$arResult["arUser"]["LOGIN"]?>" />

                    <div class="container">
                        <div class="row">
                            <div class="col-md-5 reg-left-side">
                                <div class="bx-authform-formgroup-container">
                                    <div class="bx-authform-label-container">Логин (мин. 3 символа)<span class="starrequired">*</span></div>
                                    <div class="bx-authform-input-container">
                                        <input size="30" type="text" name="LOGIN" value="<?=$arResult["arUser"]["LOGIN"]?>">
                                    </div>
                                </div>
                                <div class="bx-authform-formgroup-container">
                                    <div class="bx-authform-label-container">Email<span class="starrequired">*</span></div>
                                    <div class="bx-authform-input-container">
                                        <input size="30" type="text" name="EMAIL" value="<?=$arResult["arUser"]["EMAIL"]?>">
                                    </div>
                                </div>
                                <? if($arUser["UF_ISURFACE"] == "1") { ?>
                                    <div class="bx-authform-formgroup-container">
                                        <div class="bx-authform-label-container">
                                            ИНН организации:
                                        </div>
                                        <div class="bx-authform-input-container">
                                            <input type="text" name="UF_ORGINN" maxlength="255" value="<?=$arResult["arUser"]["UF_ORGINN"]?>">
                                        </div>
                                    </div>
                                    <div class="bx-authform-formgroup-container">
                                        <div class="bx-authform-label-container">
                                            Название организации:
                                        </div>
                                        <div class="bx-authform-input-container">
                                            <input type="text" name="UF_ORGNAME" maxlength="255" value="<?=$arResult["arUser"]["UF_ORGNAME"]?>">
                                        </div>
                                    </div>
                                    <div class="bx-authform-formgroup-container">
                                        <div class="bx-authform-label-container">
                                            Юридический адрес:
                                        </div>
                                        <div class="bx-authform-input-container">
                                            <input type="text" name="UF_URADDRESS" maxlength="255" value="<?=$arResult["arUser"]["UF_URADDRESS"]?>">
                                        </div>
                                    </div>
                                    <div class="bx-authform-formgroup-container">
                                        <div class="bx-authform-label-container">
                                            Телефон руководителя:
                                        </div>
                                        <div class="bx-authform-input-container">
                                            <input type="text" name="UF_HEAD_PHONE" maxlength="255" value="<?=$arResult["arUser"]["UF_HEAD_PHONE"]?>">
                                        </div>
                                    </div>
                                    <div class="bx-authform-formgroup-container">
                                        <div class="bx-authform-label-container">
                                            Контактное лицо:
                                        </div>
                                        <div class="bx-authform-input-container">
                                            <input type="text" name="UF_CONTACT_PERSON" maxlength="255" value="<?=$arResult["arUser"]["UF_CONTACT_PERSON"]?>">
                                        </div>
                                    </div>
                                <? } else { ?>
                                    <div class="bx-authform-formgroup-container">
                                        <div class="bx-authform-label-container">
                                            Имя:
                                        </div>
                                        <div class="bx-authform-input-container">
                                            <input type="text" name="NAME" maxlength="255" value="<?=$arResult["arUser"]["NAME"]?>">
                                        </div>
                                    </div>
                                    <div class="bx-authform-formgroup-container">
                                        <div class="bx-authform-label-container">
                                            Фамилия:
                                        </div>
                                        <div class="bx-authform-input-container">
                                            <input type="text" name="LAST_NAME" maxlength="255" value="<?=$arResult["arUser"]["LAST_NAME"]?>">
                                        </div>
                                    </div>
                                    <div class="bx-authform-formgroup-container">
                                        <div class="bx-authform-label-container">
                                            Отчество:
                                        </div>
                                        <div class="bx-authform-input-container">
                                            <input type="text" name="SECOND_NAME" maxlength="255" value="<?=$arResult["arUser"]["SECOND_NAME"]?>">
                                        </div>
                                    </div>
                                <? } ?>
                                <?
                                // публичный ключ:   6LdgL6cpAAAAAKzSqysYCO4IzzYBz46tcKDDjI21
                                //приватный ключ:   6LdgL6cpAAAAANOvx1rPzhJJQ_VEnUyXQO6ec1cA
                                ?>
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-6 reg-right-side">

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
                                <? if($arUser["UF_ISURFACE"] == "1") { ?>
                                <div class="bx-authform-formgroup-container">
                                    <div class="bx-authform-label-container">
                                        КПП:
                                    </div>
                                    <div class="bx-authform-input-container">
                                        <input type="text" name="UF_KPPORG" maxlength="255" value="<?=$arResult["arUser"]["UF_KPPORG"]?>">
                                    </div>
                                </div>
                                <div class="bx-authform-formgroup-container">
                                    <div class="bx-authform-label-container">
                                        ФИО руководителя:
                                    </div>
                                    <div class="bx-authform-input-container">
                                        <input type="text" name="UF_FIO" maxlength="255" value="<?=$arResult["arUser"]["UF_FIO"]?>">
                                    </div>
                                </div>
                                <div class="bx-authform-formgroup-container">
                                    <div class="bx-authform-label-container">
                                        Почтовый адрес:
                                    </div>
                                    <div class="bx-authform-input-container">
                                        <input type="text" name="UF_POST_ADDRESS" maxlength="255" value="<?=$arResult["arUser"]["UF_POST_ADDRESS"]?>">
                                    </div>
                                </div>
                                <? } ?>
                                <div class="bx-authform-formgroup-container">
                                    <div class="bx-authform-label-container">
                                        Адрес доставки:
                                    </div>
                                    <div class="bx-authform-input-container">
                                        <input type="text" name="UF_DELIVERY_ADDR" maxlength="255" value="<?=$arResult["arUser"]["UF_DELIVERY_ADDR"]?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            		<p class="main-profile-form-buttons-block col-sm-9 col-md-offset-3">
            			<input type="submit" name="save" class="btn btn-themes btn-default btn-md main-profile-submit" value="<?=(($arResult["ID"]>0) ? Loc::getMessage("MAIN_SAVE") : Loc::getMessage("MAIN_ADD"))?>">
            			&nbsp;
            			<input type="submit" class="btn btn-themes btn-default btn-md"  name="reset" value="<?echo GetMessage("MAIN_RESET")?>">
            		</p>
            	</form>
            	<div class="col-sm-12 main-profile-social-block">
            		<?
            		if ($arResult["SOCSERV_ENABLED"])
            		{
            			$APPLICATION->IncludeComponent("bitrix:socserv.auth.split", ".default", array(
            				"SHOW_PROFILES" => "Y",
            				"ALLOW_DELETE" => "Y"
            			),
            				false
            			);
            		}
            		?>
            	</div>
            	<div class="clearfix"></div>
            	<script>
            		BX.Sale.PrivateProfileComponent.init();
            	</script>
        	</div>

        </div>
    </div>
</div>