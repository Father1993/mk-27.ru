<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$chars = " ()-"; // Символы для удаления из номера, для вставки в ссылку.
?>

<div class="contacts-grid">
  <?php foreach ($arResult["ITEMS"] as $item):
        $this->AddEditAction($item["ID"], $item["EDIT_LINK"], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($item["ID"], $item["DELETE_LINK"], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage("CT_BNL_ELEMENT_DELETE_CONFIRM")));
    ?>

  <div class="contact-card" id="<?=$this->GetEditAreaId($item["ID"]);?>">
    <div class="card-inner">
      <div class="card-header"
        onclick="changeMapAddress(<?=$item["PROPERTIES"]["COORD"]["VALUE"]?>, <?=$item["ID"]?>);">
        <h3 class="card-title">
          <i class="bi bi-building"></i>
          <?=$item["NAME"]?>
        </h3>
      </div>

      <div class="card-body">
        <div class="address-block">
          <i class="bi bi-geo-alt-fill"></i>
          <span><?=$item["PROPERTIES"]["ADDRESS"]["VALUE"]?></span>
        </div>

        <?php if ($item["PROPERTIES"]["SCHEDULE"]["VALUE"]["TEXT"]): ?>
        <div class="schedule-block">
          <i class="bi bi-clock-fill"></i>
          <span><?=html_entity_decode($item["PROPERTIES"]["SCHEDULE"]["VALUE"]["TEXT"])?></span>
        </div>
        <?php endif; ?>

        <div class="phones-block">
          <?php 
          $phones = $item["PROPERTIES"]["PHONE"]["VALUE"];
          $phonesCount = count($phones);
          foreach ($phones as $index => $phone):
              $phone_to_link = preg_replace("/[".$chars."]/", "", $phone);
              $hideClass = $index >= 2 ? 'hidden-phone' : '';
          ?>
          <div class="phone-item <?=$hideClass?>">
            <i class="bi bi-telephone-fill"></i>
            <a href="tel:<?=$phone_to_link?>"><?=$phone?></a>
          </div>
          <?php endforeach; ?>

          <?php if ($phonesCount > 2): ?>
          <div class="show-more-phones" onclick="togglePhones(this)" data-count="<?=$phonesCount - 2?>">
            <i class="bi bi-plus-circle"></i>
            <span class="show-text">Показать ещё</span>
            <span class="hide-text">Скрыть номера</span>
          </div>
          <?php endif; ?>
        </div>

        <?php if ($item["PROPERTIES"]["EMAIL"]["VALUE"]): ?>
        <div class="email-block">
          <i class="bi bi-envelope-fill"></i>
          <a href="mailto:<?=$item["PROPERTIES"]["EMAIL"]["VALUE"]?>"><?=$item["PROPERTIES"]["EMAIL"]["VALUE"]?></a>
        </div>
        <?php endif; ?>
      </div>

      <?php if ($item["DETAIL_TEXT"]): ?>
      <div class="card-footer">
        <div class="detail-text">
          <?=html_entity_decode($item["DETAIL_TEXT"])?>
        </div>
      </div>
      <?php endif; ?>
    </div>
  </div>
  <?php endforeach; ?>
</div>

<script>
function declension(number, titles) {
  const cases = [2, 0, 1, 1, 1, 2];
  return titles[(number % 100 > 4 && number % 100 < 20) ? 2 : cases[(number % 10 < 5) ? number % 10 : 5]];
}

function togglePhones(button) {
  const phoneBlock = button.closest('.phones-block');
  const hiddenPhones = phoneBlock.querySelectorAll('.hidden-phone');
  const showText = button.querySelector('.show-text');
  const count = parseInt(button.dataset.count);

  phoneBlock.classList.toggle('show-all');

  if (showText && !phoneBlock.classList.contains('show-all')) {
    const word = declension(count, ['номер', 'номера', 'номеров']);
    showText.textContent = `Показать ещё ${count} ${word}`;
  }

  hiddenPhones.forEach(phone => {
    phone.style.display = phoneBlock.classList.contains('show-all') ? 'flex' : 'none';
  });
}

// Инициализация при загрузке страницы
document.addEventListener('DOMContentLoaded', function() {
  // Скрываем дополнительные номера
  document.querySelectorAll('.hidden-phone').forEach(phone => {
    phone.style.display = 'none';
  });

  // Устанавливаем начальный текст для кнопок
  document.querySelectorAll('.show-more-phones').forEach(button => {
    const count = parseInt(button.dataset.count);
    const showText = button.querySelector('.show-text');
    const word = declension(count, ['номер', 'номера', 'номеров']);
    showText.textContent = `Показать ещё ${count} ${word}`;
  });
});
</script>