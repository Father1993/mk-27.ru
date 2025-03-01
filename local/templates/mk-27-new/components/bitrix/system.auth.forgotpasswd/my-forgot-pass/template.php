<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?
/**
* @global CMain $APPLICATION
* @var array $arParams
* @var array $arResult
*/

?>

<div class="forgot-password-wrapper">
  <div class="forgot-password-card">
    <div class="forgot-password-card-body">
      <div class="forgot-icon">
        <i class="bi bi-key"></i>
      </div>

      <?if(!empty($arParams["~AUTH_RESULT"])):
                $text = str_replace(array("<br>", "<br />"), "\n", $arParams["~AUTH_RESULT"]["MESSAGE"]);?>
      <div class="alert <?=($arParams["~AUTH_RESULT"]["TYPE"] == "OK"? "alert-success":"alert-danger")?>">
        <?=nl2br(htmlspecialcharsbx($text))?>
      </div>
      <?endif?>

      <h3 class="forgot-title"><?=GetMessage("AUTH_GET_CHECK_STRING")?></h3>
      <p class="forgot-subtitle"><?=GetMessage("AUTH_FORGOT_PASSWORD_2")?></p>

      <form name="bform" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>" id="forgot-form">
        <?if($arResult["BACKURL"] <> ''):?>
        <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
        <?endif?>
        <input type="hidden" name="AUTH_FORM" value="Y">
        <input type="hidden" name="TYPE" value="SEND_PWD">

        <div class="form-group">
          <label class="form-label">
            <?echo GetMessage("AUTH_LOGIN_EMAIL")?>
          </label>
          <input type="text" name="USER_LOGIN" maxlength="255" value="<?=$arResult["USER_LOGIN"]?>" class="form-control"
            id="user-email" />
          <input type="hidden" name="USER_EMAIL" />
          <div class="form-note">
            <?echo GetMessage("forgot_pass_email_note")?>
          </div>
          <div class="invalid-feedback" style="display: none;">Пожалуйста, введите корректный email</div>
        </div>

        <?if($arResult["PHONE_REGISTRATION"]):?>
        <div class="form-group">
          <label class="form-label">
            <?echo GetMessage("forgot_pass_phone_number")?>
          </label>
          <input type="text" name="USER_PHONE_NUMBER" maxlength="255" value="<?=$arResult["USER_PHONE_NUMBER"]?>"
            class="form-control" />
          <div class="form-note">
            <?echo GetMessage("forgot_pass_phone_number_note")?>
          </div>
        </div>
        <?endif?>

        <?if ($arResult["USE_CAPTCHA"]):?>
        <div class="form-group">
          <label class="form-label">
            <?echo GetMessage("system_auth_captcha")?>
          </label>
          <input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
          <div class="captcha-wrapper">
            <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" alt="CAPTCHA" />
            <input type="text" name="captcha_word" maxlength="50" value="" class="form-control" autocomplete="off" />
          </div>
        </div>
        <?endif?>

        <div class="form-group">
          <input type="submit" class="btn btn-primary" name="send_account_info" value="<?=GetMessage("AUTH_SEND")?>" />
        </div>

        <div class="auth-links">
          <a href="/auth/" class="auth-link"><?=GetMessage("AUTH_AUTH")?></a>
        </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
  // Функция валидации email
  function isValidEmail(email) {
    var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    return emailRegex.test(email);
  }

  // Валидация при вводе
  $('#user-email').on('input', function() {
    var email = $(this).val();
    var $feedback = $(this).siblings('.invalid-feedback');

    if (email && !isValidEmail(email)) {
      $(this).addClass('is-invalid');
      $feedback.show();
    } else {
      $(this).removeClass('is-invalid');
      $feedback.hide();
    }
  });

  // Оригинальная логика Bitrix + валидация
  document.bform.onsubmit = function() {
    var email = document.bform.USER_LOGIN.value;

    if (!isValidEmail(email)) {
      $('#user-email').addClass('is-invalid');
      $('#user-email').siblings('.invalid-feedback').show();
      return false;
    }

    document.bform.USER_EMAIL.value = email;
    return true;
  };

  // Автофокус на поле email
  document.bform.USER_LOGIN.focus();
});
</script>