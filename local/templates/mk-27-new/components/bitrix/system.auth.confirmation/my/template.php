<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

CJSCore::Init();
?>

<div class="auth-form-wrapper py-4">
  <?
    if($arResult["MESSAGE_TEXT"] <> ''):
        $messageClass = "";
        
        switch($arResult["MESSAGE_CODE"])
        {
            case "E01": // Пользователь не найден
                $messageClass = "alert-warning";
                $icon = '<i class="bi bi-exclamation-triangle me-2"></i>';
                break;
            case "E02": // Успешная авторизация после подтверждения
                $messageClass = "alert-success";
                $icon = '<i class="bi bi-check-circle me-2"></i>';
                break;
            case "E03": // Пользователь уже подтвердил регистрацию
                $messageClass = "alert-info";
                $icon = '<i class="bi bi-info-circle me-2"></i>';
                break;
            case "E04": // Отсутствует код подтверждения
                $messageClass = "alert-warning";
                $icon = '<i class="bi bi-exclamation-triangle me-2"></i>';
                break;
            case "E05": // Неверный код подтверждения
                $messageClass = "alert-danger";
                $icon = '<i class="bi bi-x-circle me-2"></i>';
                break;
            case "E06": // Подтверждение успешно
                $messageClass = "alert-success";
                $icon = '<i class="bi bi-check-circle me-2"></i>';
                break;
            case "E07": // Ошибка при подтверждении
                $messageClass = "alert-danger";
                $icon = '<i class="bi bi-x-circle me-2"></i>';
                break;
            default:
                $messageClass = "alert-info";
                $icon = '<i class="bi bi-info-circle me-2"></i>';
        }

        if($arResult["MESSAGE_CODE"] == "E02"): ?>
  <div class="card shadow-sm">
    <div class="card-body p-4 text-center">
      <div class="success-icon mb-4">
        <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
      </div>
      <h4 class="mb-4">Поздравляем!</h4>
      <p class="mb-4">Вы успешно авторизовались.</p>
    </div>
  </div>
  <? else: ?>
  <div class="alert <?=$messageClass?> d-flex align-items-center">
    <?=$icon?><?=nl2br(htmlspecialcharsbx($arResult["MESSAGE_TEXT"]))?>
  </div>
  <? endif;
    endif; ?>

  <?if($arResult["SHOW_FORM"]):?>
  <div class="card shadow-sm">
    <div class="card-body p-4">
      <h4 class="text-center mb-4">Подтверждение регистрации</h4>

      <form method="post" action="<?=$arResult["FORM_ACTION"]?>" class="confirmation-form">
        <div class="mb-3">
          <label for="confirmation-login" class="form-label"><?=GetMessage("CT_BSAC_LOGIN")?></label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-person"></i></span>
            <input type="text" class="form-control" name="<?=$arParams["LOGIN"]?>" id="confirmation-login"
              maxlength="50" value="<?=$arResult["LOGIN"]?>" required />
          </div>
        </div>

        <div class="mb-4">
          <label for="confirmation-code" class="form-label"><?=GetMessage("CT_BSAC_CONFIRM_CODE")?></label>
          <div class="input-group">
            <span class="input-group-text"><i class="bi bi-key"></i></span>
            <input type="text" class="form-control" name="<?=$arParams["CONFIRM_CODE"]?>" id="confirmation-code"
              maxlength="50" value="<?=$arResult["CONFIRM_CODE"]?>" required />
          </div>
          <div class="form-text">
            <i class="bi bi-info-circle me-1"></i>
            Введите код, который был отправлен вам на email
          </div>
        </div>

        <div class="d-grid">
          <button type="submit" class="btn btn-primary">
            <i class="bi bi-check2 me-2"></i><?=GetMessage("CT_BSAC_CONFIRM")?>
          </button>
        </div>

        <input type="hidden" name="<?=$arParams["USER_ID"]?>" value="<?=$arResult["USER_ID"]?>" />
      </form>
    </div>
  </div>
  <?elseif(!$USER->IsAuthorized()):?>
  <?$APPLICATION->IncludeComponent("bitrix:system.auth.authorize", "my", array());?>
  <?endif?>
</div>