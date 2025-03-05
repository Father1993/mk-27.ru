<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>

<?php if (!empty($arResult["ITEMS"])): ?>
<div class="holiday-schedule">
  <div class="container no-padding-container">
    <div class="holiday-schedule-inner">
      <div class="holiday-schedule-title">
        <i class="bi bi-calendar-check-fill"></i>
        <span>Праздничный режим работы</span>
        <div class="holiday-badge">Важно!</div>
      </div>

      <?php foreach ($arResult["ITEMS"] as $item): 
        $this->AddEditAction($item["ID"], $item["EDIT_LINK"], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
        $this->AddDeleteAction($item["ID"], $item["DELETE_LINK"], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage("CT_BNL_ELEMENT_DELETE_CONFIRM")));
      ?>
      <div class="holiday-schedule-content" id="<?=$this->GetEditAreaId($item["ID"]);?>">
        <div class="holiday-schedule-text">
          <?php if (!empty($item["DETAIL_TEXT"])): ?>
          <div class="schedule-detail-content">
            <?=$item["DETAIL_TEXT"]?>
          </div>

          <div class="schedule-note mt-3">
            <div class="d-flex align-items-center">
              <i class="bi bi-info-circle"></i>
              <small>Информация изменена:
                <?=FormatDate("d.m.Y", MakeTimeStamp($item["ACTIVE_TO"] ?: $item["TIMESTAMP_X"]))?></small>
            </div>
          </div>
          <?php else: ?>
          <div class="holiday-default-content">
            <div class="holiday-icon-wrapper">
              <i class="bi bi-calendar-event"></i>
            </div>
            <h3>Особый режим работы в праздничные дни</h3>
            <p>В связи с предстоящими праздниками наш график работы может измениться. Пожалуйста, уточняйте актуальную
              информацию по телефону или электронной почте.</p>
            <div class="holiday-contact-info">
              <p><i class="bi bi-telephone"></i> Телефон для справок: <a href="tel:+78001234567">8 (800) 123-45-67</a>
              </p>
              <p><i class="bi bi-envelope"></i> Email: <a href="mailto:info@mk-27.ru">info@mk-27.ru</a></p>
            </div>
          </div>
          <?php endif; ?>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<?php endif; ?>