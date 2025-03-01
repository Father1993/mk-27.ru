<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

CJSCore::Init();
?>

<div class="auth-form-wrapper py-4">
  <?if ($arResult['SHOW_ERRORS'] === 'Y' && $arResult['ERROR'] && !empty($arResult['ERROR_MESSAGE'])):?>
  <div class="alert alert-danger">
    <?ShowMessage($arResult['ERROR_MESSAGE']);?>
  </div>
  <?endif?>

  <?if($arResult["FORM_TYPE"] == "login"):?>
  <div class="card shadow-sm">
    <div class="card-body p-4">
      <form name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top"
        action="<?=$arResult["AUTH_URL"]?>">
        <?if($arResult["BACKURL"] <> ''):?>
        <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
        <?endif?>
        <?foreach ($arResult["POST"] as $key => $value):?>
        <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
        <?endforeach?>
        <input type="hidden" name="AUTH_FORM" value="Y" />
        <input type="hidden" name="TYPE" value="AUTH" />

        <div class="mb-3">
          <label for="user-login" class="form-label"><?=GetMessage("AUTH_LOGIN")?></label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-person"></i></span>
            <input type="text" class="form-control" name="USER_LOGIN" id="user-login" maxlength="50" value=""
              required />
          </div>
        </div>

        <div class="mb-3">
          <label for="user-password" class="form-label"><?=GetMessage("AUTH_PASSWORD")?></label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-lock"></i></span>
            <input type="password" class="form-control" name="USER_PASSWORD" id="user-password" maxlength="255"
              autocomplete="off" required />
          </div>
        </div>

        <?if ($arResult["STORE_PASSWORD"] == "Y"):?>
        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="USER_REMEMBER_frm" name="USER_REMEMBER" value="Y" />
          <label class="form-check-label" for="USER_REMEMBER_frm"><?=GetMessage("AUTH_REMEMBER_SHORT")?></label>
        </div>
        <?endif?>

        <?if ($arResult["CAPTCHA_CODE"]):?>
        <div class="mb-3">
          <label class="form-label"><?=GetMessage("AUTH_CAPTCHA_PROMT")?></label>
          <input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
          <div class="mb-2">
            <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" class="img-fluid"
              alt="CAPTCHA" />
          </div>
          <input type="text" class="form-control" name="captcha_word" maxlength="50" value="" required />
        </div>
        <?endif?>

        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-primary" name="Login"><?=GetMessage("AUTH_LOGIN_BUTTON")?></button>
        </div>

        <div class="mt-3 text-center">
          <?if($arResult["NEW_USER_REGISTRATION"] == "Y"):?>
          <div class="mb-2">
            <a href="<?=$arResult["AUTH_REGISTER_URL"]?>"
              class="text-decoration-none"><?=GetMessage("AUTH_REGISTER")?></a>
          </div>
          <?endif?>
          <div>
            <a href="<?=$arResult["AUTH_FORGOT_PASSWORD_URL"]?>"
              class="text-decoration-none"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></a>
          </div>
        </div>

        <?if($arResult["AUTH_SERVICES"]):?>
        <div class="mt-4">
          <div class="text-center mb-2"><?=GetMessage("socserv_as_user_form")?></div>
          <?
							$APPLICATION->IncludeComponent("bitrix:socserv.auth.form", "modern",
								array(
									"AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
									"SUFFIX"=>"form",
								),
								$component,
								array("HIDE_ICONS"=>"Y")
							);
							?>
        </div>
        <?endif?>
      </form>
    </div>
  </div>

  <?elseif($arResult["FORM_TYPE"] == "otp"):?>
  <div class="card shadow-sm">
    <div class="card-body p-4">
      <form name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top"
        action="<?=$arResult["AUTH_URL"]?>">
        <?if($arResult["BACKURL"] <> ''):?>
        <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
        <?endif?>
        <input type="hidden" name="AUTH_FORM" value="Y" />
        <input type="hidden" name="TYPE" value="OTP" />

        <div class="mb-3">
          <label class="form-label"><?=GetMessage("auth_form_comp_otp")?></label>
          <input type="text" class="form-control" name="USER_OTP" maxlength="50" value="" autocomplete="off" required />
        </div>

        <?if ($arResult["CAPTCHA_CODE"]):?>
        <div class="mb-3">
          <label class="form-label"><?=GetMessage("AUTH_CAPTCHA_PROMT")?></label>
          <input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
          <div class="mb-2">
            <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" class="img-fluid"
              alt="CAPTCHA" />
          </div>
          <input type="text" class="form-control" name="captcha_word" maxlength="50" value="" required />
        </div>
        <?endif?>

        <?if ($arResult["REMEMBER_OTP"] == "Y"):?>
        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" id="OTP_REMEMBER_frm" name="OTP_REMEMBER" value="Y" />
          <label class="form-check-label" for="OTP_REMEMBER_frm"><?=GetMessage("auth_form_comp_otp_remember")?></label>
        </div>
        <?endif?>

        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-primary" name="Login"><?=GetMessage("AUTH_LOGIN_BUTTON")?></button>
        </div>

        <div class="mt-3 text-center">
          <a href="<?=$arResult["AUTH_LOGIN_URL"]?>"
            class="text-decoration-none"><?=GetMessage("auth_form_comp_auth")?></a>
        </div>
      </form>
    </div>
  </div>

  <?else:?>
  <div class="card shadow-sm">
    <div class="card-body p-4">
      <div class="text-center mb-4">
        <h5 class="mb-1"><?=$arResult["USER_NAME"]?></h5>
        <small class="text-muted">[<?=$arResult["USER_LOGIN"]?>]</small>
      </div>

      <div class="d-grid gap-2">

        <a href="/" class="btn btn-outline-primary">
          <i class="bi bi-shop me-2"></i>Перейти в каталог
        </a>

        <a href="<?=$arResult["PROFILE_URL"]?>" class="btn btn-outline-primary">
          <i class="bi bi-person-circle me-2"></i><?=GetMessage("AUTH_PROFILE")?>
        </a>

        <form action="<?=$arResult["AUTH_URL"]?>" class="mt-2">
          <?foreach ($arResult["GET"] as $key => $value):?>
          <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
          <?endforeach?>
          <?=bitrix_sessid_post()?>
          <input type="hidden" name="logout" value="yes" />
          <button type="submit" class="btn btn-danger w-100" name="logout_butt">
            <i class="bi bi-box-arrow-right me-2"></i><?=GetMessage("AUTH_LOGOUT_BUTTON")?>
          </button>
        </form>
      </div>
    </div>
  </div>
  <?endif?>
</div>

<script>
BX.ready(function() {
  var loginCookie = BX.getCookie("<?=CUtil::JSEscape($arResult["~LOGIN_COOKIE_NAME"])?>");
  if (loginCookie) {
    var form = document.forms["system_auth_form<?=$arResult["RND"]?>"];
    if (form) {
      var loginInput = form.elements["USER_LOGIN"];
      if (loginInput) {
        loginInput.value = loginCookie;
      }
    }
  }
});
</script>