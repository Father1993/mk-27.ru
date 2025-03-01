<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */
$this->setFrameMode(true);
?>

<div class="container action-winners no-padding-container">
	<div class="row">
		
		<div class="col-12">
			<h2><?=$arResult["NAME"]?></h2>
		</div>
		
		<?php foreach ($arResult["PROPERTIES"]["WINNERS_PHOTOS"]["VALUE"] as $key => $item):?>

			<?php $large_image = CFile::ResizeImageGet($item, array("width"=>"1024", "height"=>"1024"), BX_RESIZE_IMAGE_PROPORTIONAL, true); ?>
			<?php $small_image = CFile::ResizeImageGet($item, array("width"=>"512", "height"=>"512"), BX_RESIZE_IMAGE_PROPORTIONAL, true); ?>

        	<div class="col-6 col-md-4 col-lg-3 col-xl-2 item">
            	<a href="<?=$large_image["src"]?>" data-fancybox="gallery">
                	<div class="item-inner">
            			<div class="picture"><img src="<?=$small_image["src"]?>"></div>
                	</div>
            	</a>
        	</div>
			
		<?php endforeach; ?>
		
	</div>
</div>