<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$chars = " ()-"; // Символы для удаления из номера, для вставки в ссылку.
?>

<div class="phones-list">
	<div class="phones-dropdown">
	
		<a href=""><?=$arResult["ITEMS"][0]["NAME"]?></a>
		
		<div class="phones-dropdown-menu">
		
    		<?php foreach ($arResult["ITEMS"] as $item):
                $phone_to_link = preg_replace("/[".$chars."]/", "", $item["NAME"]);?>
                
    			<a href="tel:<?=$phone_to_link?>"><?=$item["NAME"]?></a>
    			
    		<?php endforeach; ?>
    		
		</div>
		
	</div>
	
</div>
