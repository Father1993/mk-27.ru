<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

$APPLICATION->SetAdditionalCSS (SITE_TEMPLATE_PATH . "/assets/plugins/fancybox/fancybox.css");
$APPLICATION->AddHeadScript (SITE_TEMPLATE_PATH . "/assets/plugins/fancybox/fancybox.umd.js");

?>
<div class="mini-gallery contaiter">

	<div class="row">

        <?php foreach ($arResult["ITEMS"] as $item):
        	$this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
        	$this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
        	?>
        	
        	<div class="col-6 col-md-3" id="<?=$this->GetEditAreaId($item['ID']);?>">
            	<a href="<?=$item["DETAIL_PICTURE"]["SRC"]?>" data-fancybox="gallery-<?=$arParams["IBLOCK_ID"]?>">
            		<img src="<?=$item["PREVIEW_PICTURE"]["SRC"]?>" title="<?=$item["NAME"]?>" alt="<?=$item["NAME"]?>">
        		</a>
        	</div>
        
        <?php endforeach; ?>

	</div>

</div>