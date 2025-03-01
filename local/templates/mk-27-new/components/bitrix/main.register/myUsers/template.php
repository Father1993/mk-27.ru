<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<div class="registration-form-wrapper">
  <?if($USER->IsAuthorized()):?>
  <div class="alert alert-success">
    <p>
      <?echo GetMessage("MAIN_REGISTER_AUTH")?>
    </p>
  </div>
  <?else:?>
  <?if (count($arResult["ERRORS"]) > 0):?>
  <?foreach ($arResult["ERRORS"] as $key => $error):?>
  <?if (intval($key) == 0 && $key !== 0):?>
  <?$arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_".$key)."&quot;", $error);?>
  <?endif?>
  <?endforeach?>
  <div class="alert alert-danger">
    <?=ShowError(implode("<br />", $arResult["ERRORS"]))?>
  </div>
  <?elseif($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):?>
  <div class="alert alert-success">
    <?echo GetMessage("REGISTER_EMAIL_WILL_BE_SENT")?>
  </div>
  <?endif?>

  <div class="card shadow-sm">
    <div class="card-body p-4">
      <div class="text-center mb-4">
        <div class="registration-icon mb-3">
          <i class="bi bi-person-plus-fill"></i>
        </div>
        <h4 class="mb-1">Регистрация физического лица</h4>
        <p class="text-muted">Заполните форму для создания личного кабинета</p>
      </div>

      <form method="post" action="<?=POST_FORM_ACTION_URI?>" name="regform" enctype="multipart/form-data"
        class="registration-form">
        <?if($arResult["BACKURL"] <> ''):?>
        <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
        <?endif;?>

        <div class="row g-3">
          <!-- Основные данные -->
          <div class="col-md-6">
            <div class="form-group mb-3">
              <label class="form-label">Имя <span class="text-danger">*</span></label>
              <input type="text" name="REGISTER[NAME]" class="form-control" value="<?=$arResult["VALUES"]["NAME"]?>"
                required />
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group mb-3">
              <label class="form-label">Фамилия <span class="text-danger">*</span></label>
              <input type="text" name="REGISTER[LAST_NAME]" class="form-control"
                value="<?=$arResult["VALUES"]["LAST_NAME"]?>" required />
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group mb-3">
              <label class="form-label">Email <span class="text-danger">*</span></label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <input type="email" name="REGISTER[EMAIL]" class="form-control"
                  value="<?=$arResult["VALUES"]["EMAIL"]?>" required />
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group mb-3">
              <label class="form-label">Телефон <span class="text-danger">*</span></label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                <input type="tel" name="REGISTER[PERSONAL_PHONE]" class="form-control phone-mask"
                  value="<?=$arResult["VALUES"]["PERSONAL_PHONE"]?>" placeholder="+7 (___) ___-__-__" required />
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group mb-3">
              <label class="form-label">Логин (мин. 3 символа) <span class="text-danger">*</span></label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person"></i></span>
                <input type="text" name="REGISTER[LOGIN]" class="form-control" value="<?=$arResult["VALUES"]["LOGIN"]?>"
                  minlength="3" required />
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group mb-3">
              <label class="form-label">Пароль <span class="text-danger">*</span></label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                <input type="password" name="REGISTER[PASSWORD]" class="form-control"
                  value="<?=$arResult["VALUES"]["PASSWORD"]?>" autocomplete="off" required />
                <button class="btn btn-outline-secondary toggle-password" type="button">
                  <i class="bi bi-eye"></i>
                </button>
              </div>
              <div class="password-requirements mt-2">
                <small class="text-muted">
                  <i class="bi bi-info-circle me-1"></i>
                  Минимум 8 символов, включая буквы и цифры
                </small>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group mb-3">
              <label class="form-label">Подтверждение пароля <span class="text-danger">*</span></label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                <input type="password" name="REGISTER[CONFIRM_PASSWORD]" class="form-control"
                  value="<?=$arResult["VALUES"]["CONFIRM_PASSWORD"]?>" autocomplete="off" required />
                <button class="btn btn-outline-secondary toggle-password" type="button">
                  <i class="bi bi-eye"></i>
                </button>
              </div>
            </div>
          </div>

          <?if ($arResult["USE_CAPTCHA"] == "Y"):?>
          <div class="col-md-6">
            <div class="form-group mb-3">
              <label class="form-label"><?=GetMessage("REGISTER_CAPTCHA_TITLE")?> <span
                  class="text-danger">*</span></label>
              <div class="captcha-wrapper">
                <input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
                <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" class="img-fluid mb-2"
                  alt="CAPTCHA" />
                <input type="text" name="captcha_word" class="form-control" maxlength="50" value="" required />
              </div>
            </div>
          </div>
          <?endif?>

          <div class="col-12">
            <div class="form-check mb-3">
              <input class="form-check-input" type="checkbox" id="agreement" required>
              <label class="form-check-label" for="agreement">
                Я согласен с <a href="/privacy-policy/" target="_blank">политикой конфиденциальности</a>
              </label>
            </div>
          </div>

          <div class="col-12">
            <div class="d-grid">
              <button type="submit" name="register_submit_button" class="btn btn-primary btn-lg">
                <i class="bi bi-check2-circle me-2"></i><?=GetMessage("AUTH_REGISTER")?>
              </button>
            </div>
          </div>

          <div class="col-12 text-center mt-3">
            <p class="mb-0">Уже есть аккаунт? <a href="/auth/" class="text-primary">Войти</a></p>
          </div>
        </div>
      </form>
    </div>
  </div>
  <?endif?>
</div>

<script>
// Инициализация маски для телефона
$(document).ready(function() {
  $('.phone-mask').inputmask({
    mask: '+7 (999) 999-99-99',
    placeholder: '_',
    showMaskOnHover: false,
    showMaskOnFocus: true,
    clearIncomplete: true
  });

  // Переключение видимости пароля
  $('.toggle-password').on('click', function() {
    const input = $(this).closest('.input-group').find('input');
    const icon = $(this).find('i');

    if (input.attr('type') === 'password') {
      input.attr('type', 'text');
      icon.removeClass('bi-eye').addClass('bi-eye-slash');
    } else {
      input.attr('type', 'password');
      icon.removeClass('bi-eye-slash').addClass('bi-eye');
    }
  });
});
</script>