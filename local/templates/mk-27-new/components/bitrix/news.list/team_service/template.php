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

<div class="team_service container no-padding-container">
 
	<div class="row head">
        	<div class="col col-12 col-lg-2 image">Фото</div>
        	<div class="col col-12 col-lg-2">Имя, фамилия</div>
        	<div class="col col-12 col-lg-2">Телефон</div>
        	<div class="col col-12 col-lg-2">Город</div>
        	<div class="col col-12 col-lg-2">Email</div>
        	<div class="col col-12 col-lg-2">Пароль</div>
	</div>

	<?php foreach ($arResult["ITEMS"] as $item):?>
		<div class="row">
		
        	<div class="col col-12 col-lg-2 image"><img src="<?=$item["DETAIL_PICTURE"]["SRC"]?>"></div>
        	<div class="col col-12 col-lg-2"><input type="text" value="<?=$item["NAME"]?>"></div>
        	<div class="col col-12 col-lg-2"><input type="text" value="<?=$item["PROPERTIES"]["POSITION"]["VALUE"]?>"></div>
        	<div class="col col-12 col-lg-2"><input type="text" value="<?=$item["PROPERTIES"]["PHONE_PLUS_CODE"]["VALUE"]?>"></div>
        	<div class="col col-12 col-lg-2"><input type="text" value="<?=$item["PROPERTIES"]["EMAIL"]["VALUE"]?>"></div>
        	<div class="col col-12 col-lg-2"><input type="text" value="<?=$item["PROPERTIES"]["PASSWORD"]["VALUE"]?>"></div>
        
    	</div>
	<?php endforeach; ?>
	
</div>