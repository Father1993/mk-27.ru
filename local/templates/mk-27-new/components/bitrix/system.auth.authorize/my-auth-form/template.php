<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponent $component
 */

// Подключаем стили компонента
$APPLICATION->SetAdditionalCSS($templateFolder."/style.css");
// Подключаем скрипты компонента
$APPLICATION->AddHeadScript($templateFolder."/script.js");

// Передаем параметры в JavaScript
$jsParams = array(
    "LAST_LOGIN" => $arResult["LAST_LOGIN"]
);
?>
<script>
BX.message(<?=CUtil::PhpToJSObject($jsParams)?>);
</script>

<div class="b2b-auth-container">
  <div class="b2b-auth-form">
    <div class="b2b-auth-header">
      <h2 class="auth-title">Вход в личный кабинет</h2>
      <p class="auth-subtitle">Удобное управление заказами и специальные цены</p>
    </div>

    <?if(!empty($arParams["~AUTH_RESULT"])):?>
    <div class="alert alert-danger">
      <?=nl2br(htmlspecialcharsbx(str_replace(array("<br>", "<br />"), "\n", $arParams["~AUTH_RESULT"]["MESSAGE"])))?>
    </div>
    <?endif?>

    <?if($arResult['ERROR_MESSAGE'] <> ''):?>
    <div class="alert alert-danger">
      <?=nl2br(htmlspecialcharsbx(str_replace(array("<br>", "<br />"), "\n", $arResult['ERROR_MESSAGE'])))?>
    </div>
    <?endif?>

    <?if($arResult["AUTH_SERVICES"]):?>
    <?$APPLICATION->IncludeComponent("bitrix:socserv.auth.form",
                "flat",
                array(
                    "AUTH_SERVICES"=>$arResult["AUTH_SERVICES"],
                    "AUTH_URL"=>$arResult["AUTH_URL"],
                    "POST"=>$arResult["POST"],
                ),
                $component,
                array("HIDE_ICONS"=>"Y")
            );?>
    <div class="auth-divider">
      <span>или</span>
    </div>
    <?endif?>

    <form name="form_auth" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>" class="b2b-form">
      <input type="hidden" name="AUTH_FORM" value="Y" />
      <input type="hidden" name="TYPE" value="AUTH" />
      <?if ($arResult["BACKURL"] <> ''):?>
      <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
      <?endif?>
      <?foreach ($arResult["POST"] as $key => $value):?>
      <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
      <?endforeach?>

      <div class="form-group">
        <label class="form-label" for="user-login">
          <i class="fa fa-envelope"></i>
          E-mail
        </label>
        <input type="email" class="form-control" id="user-login" name="USER_LOGIN" value="<?=$arResult["LAST_LOGIN"]?>"
          required placeholder="mail@company.ru">
      </div>

      <div class="form-group">
        <label class="form-label" for="user-password">
          <i class="fa fa-lock"></i>
          Пароль
        </label>
        <div class="password-input-wrapper">
          <input type="password" class="form-control" id="user-password" name="USER_PASSWORD" required
            placeholder="Введите пароль">
          <button type="button" class="toggle-password" title="Показать/скрыть пароль">
            <i class="fa fa-eye"></i>
          </button>
        </div>
      </div>

      <?if($arResult["CAPTCHA_CODE"]):?>
      <div class="form-group captcha-group">
        <label class="form-label">
          <?echo GetMessage("AUTH_CAPTCHA_PROMT")?>
        </label>
        <input type="hidden" name="captcha_sid" value="<?echo $arResult[" CAPTCHA_CODE"]?>" />
        <div class="captcha-wrapper">
          <img class="captcha-image" src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult[" CAPTCHA_CODE"]?>"
          alt="CAPTCHA">
          <input type="text" class="form-control" name="captcha_word" maxlength="50" value="" required
            placeholder="Введите код с картинки">
        </div>
      </div>
      <?endif?>

      <?if ($arResult["STORE_PASSWORD"] == "Y"):?>
      <div class="form-group remember-group">
        <label class="custom-checkbox">
          <input type="checkbox" id="USER_REMEMBER" name="USER_REMEMBER" value="Y">
          <span class="checkmark"></span>
          <span class="checkbox-text"><?=GetMessage("AUTH_REMEMBER_ME")?></span>
        </label>
      </div>
      <?endif?>

      <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block" name="Login">
          <i class="fa fa-sign-in"></i> Войти в систему
        </button>
      </div>

      <?if ($arParams["NOT_SHOW_LINKS"] != "Y"):?>
      <div class="auth-links">
        <a href="/auth/forgot.php" class="forgot-password-link">
          <i class="fa fa-key"></i> Забыли пароль?
        </a>
      </div>

      <div class="auth-info">
        <i class="fa fa-info-circle"></i>
        <p>Если вы уже совершали заказ на нашем сайте, для вас автоматически создан личный кабинет.<br>
          Используйте email из заказа и восстановите пароль.</p>
      </div>
      <?endif?>

      <?if($arParams["NOT_SHOW_LINKS"] != "Y" && $arResult["NEW_USER_REGISTRATION"] == "Y" && $arParams["AUTHORIZE_REGISTRATION"] != "Y"):?>
      <div class="register-block">
        <p class="register-text">Впервые у нас?</p>
        <a href="/auth/register.php" class="btn btn-outline-primary btn-block">
          <i class="fa fa-user-plus"></i> Зарегистрироваться
        </a>
      </div>
      <?endif?>
    </form>
  </div>

  <div class="b2b-benefits">
    <h3>Преимущества личного кабинета</h3>
    <div class="benefits-list">
      <div class="benefit-item">
        <i class="fa fa-percentage"></i>
        <span>Специальные цены для постоянных клиентов</span>
      </div>
      <div class="benefit-item">
        <i class="fa fa-history"></i>
        <span>История заказов</span>
      </div>
      <div class="benefit-item">
        <i class="fa fa-file-invoice"></i>
        <span>Документы и счета</span>
      </div>
      <div class="benefit-item">
        <i class="fa fa-truck-fast"></i>
        <span>Отслеживание доставки</span>
      </div>
    </div>
  </div>
</div>