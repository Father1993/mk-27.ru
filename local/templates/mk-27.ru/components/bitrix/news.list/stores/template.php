<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

?>
<div class="stores contaiter">

	<div class="row">

        <?php foreach ($arResult["ITEMS"] as $item): ?>
        	<?
        	$this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
        	$this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        	?>

        	<div class="col-6 col-md-3" id="<?=$this->GetEditAreaId($item['ID']);?>">
        		<img src="<?=$item["DETAIL_PICTURE"]["SRC"]?>" title="<?=$item["NAME"]?>" alt="<?=$item["NAME"]?>">
        		<p>г. <?=$item["PROPERTIES"]["CITY"]["VALUE"]?></p>
        		<p>ул. <?=$item["PROPERTIES"]["ADDRESS"]["VALUE"]?></p>
				<?/*<p>тел: <?=$item["PROPERTIES"]["PHONE"]["VALUE"]?></p>*/?>
				<p><?=$item["PROPERTIES"]["PHONE"]["VALUE"]?></p>
        	</div>

        <?php endforeach; ?>

	</div>

</div>