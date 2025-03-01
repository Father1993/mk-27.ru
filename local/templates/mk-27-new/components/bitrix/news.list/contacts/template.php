<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$chars = " ()-"; // Символы для удаления из номера, для вставки в ссылку.
?>

<?php foreach ($arResult["ITEMS"] as $item):
	$this->AddEditAction($item["ID"], $item["EDIT_LINK"], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($item["ID"], $item["DELETE_LINK"], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage("CT_BNL_ELEMENT_DELETE_CONFIRM")));
	?>

<div class="contacts-item container contacts-item-<?=$item["ID"]?>" id="<?=$this->GetEditAreaId($item["ID"]);?>">

  <div class="row">

    <div class="col-12 col-md-7">

      <div class="title" onclick="changeMapAddress(<?=$item["PROPERTIES"]["COORD"]["VALUE"]?>, <?=$item["ID"]?>);">
        <?=$item["NAME"]?>
      </div>
      <div class="address">
        <?=$item["PROPERTIES"]["ADDRESS"]["VALUE"]?>
      </div>

      <?php if ($item["PROPERTIES"]["SCHEDULE"]["VALUE"]["TEXT"]): ?>

      <div class="schedule">
        <div class="scheduler-img">
          <img src="/local/templates/mk-27-new/assets/images/ic-schedule.png">
        </div>
        <?=html_entity_decode($item["PROPERTIES"]["SCHEDULE"]["VALUE"]["TEXT"])?>
      </div>

      <?php endif; ?>

      <div class="phones">

        <?php foreach ($item["PROPERTIES"]["PHONE"]["VALUE"] as $phone):
                	   $phone_to_link = preg_replace("/[".$chars."]/", "", $phone); ?>

        <?php if (count($item["PROPERTIES"]["PHONE"]["VALUE"]) > 1): ?>

        <a class="phone" href="tel:<?=$phone_to_link?>"><?=$phone?></a><span class="v-line"></span>

        <?php else: ?>

        <a class="phone" href="tel:<?=$phone_to_link?>"><?=$phone?></a>

        <?php endif; ?>

        <?php endforeach; ?>

      </div>

      <?php if ($item["PROPERTIES"]["EMAIL"]["VALUE"]): ?>
      <div class="email">
        <img src="/local/templates/mk-27-new/assets/images/ic-mail.png">
        <a href="mailto:<?=$item["PROPERTIES"]["EMAIL"]["VALUE"]?>"><?=$item["PROPERTIES"]["EMAIL"]["VALUE"]?></a>
      </div>

      <?php endif; ?>
    </div>

    <div class="info col-12 col-md-5">
      <?php if ($item["DETAIL_TEXT"]): ?>

      <div class="text"><?=html_entity_decode($item["DETAIL_TEXT"])?></div>

      <?php endif; ?>
    </div>

  </div>

</div>

<?php endforeach; ?>