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

<div class="container gallery-detail no-padding-container">
	<div class="row">
		
		<div class="col-12">
			<h1>Фотогалерея: <?=$arResult["NAME"]?></h1>
		</div>
		
		<?php $back_link = $arResult["SECTION"]["SECTION_PAGE_URL"] ? $arResult["SECTION"]["SECTION_PAGE_URL"] : $arResult["ORIGINAL_PARAMETERS"]["COMPARE_PATH"]; ?>
		
		<a href="<?=$back_link?>" class="return"><span>➜</span> Вернуться к списку</a>
		
    	<?php if ($arResult["PROPERTIES"]["PHOTOS"]["VALUE"]): ?>
    		
    		<?php foreach ($arResult["PROPERTIES"]["PHOTOS"]["VALUE"] as $key => $item):?>

    			<?php $large_image = CFile::ResizeImageGet($item, array("width"=>"1024", "height"=>"1024"), BX_RESIZE_IMAGE_PROPORTIONAL, true); ?>
    			<?php $small_image = CFile::ResizeImageGet($item, array("width"=>"512", "height"=>"512"), BX_RESIZE_IMAGE_PROPORTIONAL, true); ?>
    			
    
            	<div class="col-12 col-md-6 col-lg-3 col-xl-2 item">
                	<a href="<?=$large_image["src"]?>" data-fancybox="gallery">
                    	<div class="item-inner">
                			<div class="picture" style="background-image: url('<?=$small_image["src"]?>');"></div>
                    	</div>
                	</a>
            	</div>
    		
    		<?php endforeach; ?>
    		
		<?php endif; ?>
		
		<?php if ($arResult["PROPERTIES"]["YOUTUBE_LINKS"]["VALUE"]): ?>
		
    		<div class="col-12">
        		<h2>Видео</h2>
    		</div>
    		
			<?php foreach ($arResult["PROPERTIES"]["YOUTUBE_LINKS"]["VALUE"] as $item): ?>
				
				<?php 
				$code = explode("=", $item)[1];
				if (!$code) $code = explode("https://youtu.be/", $item)[1];
				
				?>
		
            	<div class="col-12 col-md-6 col-lg-3 col-xl-2 item">
                	<a href="<?=$item?>" data-fancybox="gallery-video">
                    	<div class="item-inner">
                			<div class="picture" style="background-image: url('https://img.youtube.com/vi/<?=$code?>/hqdefault.jpg');"></div>
                    	</div>
                	</a>
            	</div>
		
			<?php endforeach; ?>
			
		<?php endif; ?>
		
	</div>
</div>