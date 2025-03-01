<?
/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

if($arResult["SHOW_SMS_FIELD"] == true)
{
	CJSCore::Init('phone_auth');
}

// Подключаем необходимые библиотеки
CJSCore::Init(['jquery']);
$APPLICATION->AddHeadScript('https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.8/jquery.inputmask.min.js');
?>

<div class="profile-form-wrapper">
  <?if($arResult["strProfileError"]):?>
  <div class="errortext">
    <?ShowError($arResult["strProfileError"]);?>
  </div>
  <?endif?>
  <?if($arResult['DATA_SAVED'] == 'Y'):?>
  <div class="notetext">
    <?ShowNote(GetMessage('PROFILE_DATA_SAVED'));?>
  </div>
  <?endif?>

  <div class="card">
    <div class="card-body">
      <div class="text-center mb-4">
        <h4 class="mb-1"><?=$arResult["arUser"]["NAME"]?> <?=$arResult["arUser"]["LAST_NAME"]?></h4>
        <p class="text-muted"><?=$arResult["arUser"]["EMAIL"]?></p>
      </div>

      <form method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data"
        class="profile-form">
        <?=$arResult["BX_SESSION_CHECK"]?>
        <input type="hidden" name="lang" value="<?=LANG?>" />
        <input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
        <input type="hidden" name="save" value="Y" />

        <div class="row g-3">
          <!-- Основные данные -->
          <div class="col-md-6">
            <div class="form-group">
              <label class="form-label"><?=GetMessage('NAME')?></label>
              <input type="text" name="NAME" class="form-control" value="<?=$arResult["arUser"]["NAME"]?>" />
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label class="form-label"><?=GetMessage('LAST_NAME')?></label>
              <input type="text" name="LAST_NAME" class="form-control" value="<?=$arResult["arUser"]["LAST_NAME"]?>" />
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label class="form-label"><?=GetMessage('LOGIN')?> <span class="text-danger">*</span></label>
              <input type="text" name="LOGIN" class="form-control" value="<?=$arResult["arUser"]["LOGIN"]?>" required />
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label class="form-label"><?=GetMessage('EMAIL')?>
                <?if($arResult["EMAIL_REQUIRED"]):?> <span class="text-danger">*</span>
                <?endif?>
              </label>
              <input type="email" name="EMAIL" class="form-control" value="<?=$arResult["arUser"]["EMAIL"]?>"
                <?if($arResult["EMAIL_REQUIRED"]):?>required
              <?endif?> />
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label class="form-label"><?=GetMessage('USER_PHONE')?></label>
              <div class="input-group">
                <span class="input-group-text"><i class="bi bi-telephone"></i></span>
                <input type="tel" name="PERSONAL_PHONE" class="form-control phone-mask"
                  value="<?=$arResult["arUser"]["PERSONAL_PHONE"]?>" />
              </div>
            </div>
          </div>

          <!-- Данные организации -->
          <div class="col-12">
            <h5 class="border-bottom">Данные организации</h5>
          </div>

          <div class="col-md-12">
            <div class="form-group">
              <label class="form-label">Название организации</label>
              <input type="text" name="UF_ORGANIZATION" class="form-control"
                value="<?=$arResult["arUser"]["UF_ORGANIZATION"]?>" />
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label class="form-label">ИНН</label>
              <input type="text" name="UF_INN" class="form-control inn-mask"
                value="<?=$arResult["arUser"]["UF_INN"]?>" />
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label class="form-label">КПП</label>
              <input type="text" name="UF_KPP" class="form-control kpp-mask"
                value="<?=$arResult["arUser"]["UF_KPP"]?>" />
            </div>
          </div>

          <div class="col-md-4">
            <div class="form-group">
              <label class="form-label">ОГРН</label>
              <input type="text" name="UF_OGRN" class="form-control ogrn-mask"
                value="<?=$arResult["arUser"]["UF_OGRN"]?>" />
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label class="form-label">Юридический адрес</label>
              <input type="text" name="UF_UR_ADDRESS" class="form-control"
                value="<?=$arResult["arUser"]["UF_UR_ADDRESS"]?>" />
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label class="form-label">Фактический адрес</label>
              <input type="text" name="UF_FACT_ADDRESS" class="form-control"
                value="<?=$arResult["arUser"]["UF_FACT_ADDRESS"]?>" />
            </div>
          </div>

          <?if($arResult['CAN_EDIT_PASSWORD']):?>
          <!-- Смена пароля -->
          <div class="col-12">
            <h5 class="border-bottom"><?=GetMessage('NEW_PASSWORD_TITLE')?></h5>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label class="form-label"><?=GetMessage('NEW_PASSWORD_REQ')?></label>
              <input type="password" name="NEW_PASSWORD" class="form-control" autocomplete="new-password" />
              <?if($arResult["SECURE_AUTH"]):?>
              <span class="text-muted small">
                <?echo GetMessage("AUTH_SECURE_NOTE")?>
              </span>
              <?endif?>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label class="form-label"><?=GetMessage('NEW_PASSWORD_CONFIRM')?></label>
              <input type="password" name="NEW_PASSWORD_CONFIRM" class="form-control" autocomplete="new-password" />
            </div>
          </div>
          <?endif?>

          <div class="col-12">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
              <input type="submit" name="save" class="btn btn-primary" value="<?=GetMessage("MAIN_SAVE")?>" />
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
  $('.phone-mask').inputmask({
    mask: '+7 (999) 999-99-99',
    placeholder: '_',
    showMaskOnHover: false,
    showMaskOnFocus: true,
    clearIncomplete: true
  });

  $('.inn-mask').inputmask({
    mask: '9{10,12}',
    placeholder: '_',
    showMaskOnHover: false,
    showMaskOnFocus: true,
    clearIncomplete: true
  });

  $('.kpp-mask').inputmask({
    mask: '999999999',
    placeholder: '_',
    showMaskOnHover: false,
    showMaskOnFocus: true,
    clearIncomplete: true
  });

  $('.ogrn-mask').inputmask({
    mask: '9999999999999',
    placeholder: '_',
    showMaskOnHover: false,
    showMaskOnFocus: true,
    clearIncomplete: true
  });
});
</script>

<?if($arResult["SHOW_SMS_FIELD"] == true):?>
<script>
new BX.PhoneAuth({
  containerId: 'bx_profile_resend',
  errorContainerId: 'bx_profile_error',
  interval: <?=$arResult["PHONE_CODE_RESEND_INTERVAL"]?>,
  data: <?=CUtil::PhpToJSObject([
    'signedData' => $arResult["SIGNED_DATA"]
  ])?>,
  onError: function(response) {
    var errorDiv = BX('bx_profile_error');
    var errorNode = BX.findChildByClassName(errorDiv, 'errortext');
    errorNode.innerHTML = '';
    for (var i = 0; i < response.errors.length; i++) {
      errorNode.innerHTML = errorNode.innerHTML + BX.util.htmlspecialchars(response.errors[i].message) + '<br>';
    }
    errorDiv.style.display = '';
  }
});
</script>
<?endif?>