<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<div class="container gallery-detail no-padding-container">
	<div class="row">
		
		<div class="col-12">
			<h1><?=$arResult["IBLOCK"]["NAME"]?>: <?=$arResult["NAME"]?></h1>
		</div>
		
		<a href="<?=$arResult["LIST_PAGE_URL"]?>" class="return"><span>➜</span> Вернуться к списку</a>
		
    	<?php if ($arResult["DISPLAY_PROPERTIES"]["PHOTO"]["FILE_VALUE"]): ?>
    		
    		<?php foreach ($arResult["DISPLAY_PROPERTIES"]["PHOTO"]["FILE_VALUE"] as $key => $item):?>
    			<?php $small_image = CFile::ResizeImageGet($item["ID"], array("width"=>"512", "height"=>"512"), BX_RESIZE_IMAGE_PROPORTIONAL, true); ?>
    
            	<div class="col-12 col-md-6 col-lg-3 col-xl-2 item">
                	<a href="<?=$item["SRC"]?>" data-fancybox="gallery">
                    	<div class="item-inner">
                			<div class="picture" style="background-image: url('<?=$small_image["src"]?>');"></div>
                    	</div>
                	</a>
            	</div>
    		
    		<?php endforeach; ?>
    		
		<?php endif; ?>
		
		<?php if ($arResult["DISPLAY_PROPERTIES"]["YOUTUBE_LINK"]["VALUE"]): ?>
		
    		<div class="col-12">
        		<h2>Видео</h2>
    		</div>
    		
			<?php foreach ($arResult["DISPLAY_PROPERTIES"]["YOUTUBE_LINK"]["VALUE"] as $item): ?>
				
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
