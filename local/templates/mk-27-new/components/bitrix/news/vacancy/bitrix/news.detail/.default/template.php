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

<div class="vacancy-popup">
	<div class="cross" onclick="hideVacancyPopup();">✖</div>
	<div class="vacancy-popup__title">
		Отклинкуться на вакансию<br><?=$arResult["NAME"]?>
	</div>
	
	<form class="vacancy-form" action="" method="POST">
	
		<input type="text" name="ANTIBOT" class="antibot" required>
	
		<input type="hidden" name="VACANCY" value="<?=$arResult["NAME"]?>">
		<input type="hidden" name="CITY" value="<?=explode(", ", $arResult["PROPERTIES"]["ADDRESS"]["VALUE"])[0]?>">
		<input type="hidden" name="ADDRESS_CODE" value="<?=$arResult["PROPERTIES"]["ADDRESS"]["VALUE_XML_ID"]?>">
		<input type="text" name="NAME" placeholder="Ваше имя" required>
		<input type="phone" name="PHONE" placeholder="Номер телефона" required>
		<input type="email" name="EMAIL" placeholder="E-mail (не обязательно)">
		<input type="submit" value="Отправить">
	
		<div class="policy">
			Отправляя данную форму, вы соглашаетесь с <a href="/privacy/" target="_blank">политикой конфиденциальности</a>.
		</div>
		
		<div class="success">Ваш отклик успешно отправлен.</div>
		
	</form>
	
</div>

<div class="vacancy-detail">
	<h1><?=$arResult["NAME"]?></h1>

	<?php // Зарплата ?>
	
	<div class="salary">
		<?php if ($arResult["PROPERTIES"]["SALARY_FROM"]["VALUE"] || $arResult["PROPERTIES"]["SALARY_TO"]["VALUE"]): ?>
			<?php if ($arResult["PROPERTIES"]["SALARY_FROM"]["VALUE"]): ?>
				<span>от <?=number_format($arResult["PROPERTIES"]["SALARY_FROM"]["VALUE"], 0, ".", " ")?></span>
			<?php endif; ?>
			<?php if ($arResult["PROPERTIES"]["SALARY_TO"]["VALUE"]): ?>
				<span> до <?=number_format($arResult["PROPERTIES"]["SALARY_TO"]["VALUE"], 0, ".", " ")?></span>
			<?php endif; ?>
			<span> руб.</span>
		<?php else: ?>
		<span>з/п не указана</span>
		<?php endif; ?>
	</div>
	
	<?php // Требуемый опыт работы ?>
	
	<?php if ($arResult["PROPERTIES"]["REQUIRED_WORK_EXPERIENCE"]["VALUE"]): ?>
    	<div class="required-work-experience">
    		<span><?=$arResult["PROPERTIES"]["REQUIRED_WORK_EXPERIENCE"]["NAME"]?>:</span>
        	<span><?=$arResult["PROPERTIES"]["REQUIRED_WORK_EXPERIENCE"]["VALUE"]?></span>
    	</div>
	<?php endif;?>
	
	<?php // График работы ?>
	
	<?php if ($arResult["PROPERTIES"]["SCHEDULE"]["VALUE"]): ?>
		<span class="schedule"><?=$arResult["PROPERTIES"]["SCHEDULE"]["VALUE"]?></span>
	<?php endif; ?>
	
	<div class="connection">
		
		<div class="title">
			Связаться с нами
		</div>
		
		<div class="vacancy-respond-button" onclick="showVacancyPopup();">Откликнуться</div>
		<p>Email отдала персонала: <a href="mailto:kadry@mk-27.ru">kadry@mk-27.ru</a></p>
		<p>Телефон отдела персонала: <a href="tel:+79842552035">+7 (984) 255-20-35</a></p>
		
	</div>
	
	<?php // Видео ?>
	
	<?php
    if ($arResult["DISPLAY_PROPERTIES"]["YOUTUBE_LINK"]["VALUE"]):
	
    	$code = explode("=", $arResult["DISPLAY_PROPERTIES"]["YOUTUBE_LINK"]["VALUE"])[1];
    	if (!$code) $code = explode("https://youtu.be/", $arResult["DISPLAY_PROPERTIES"]["YOUTUBE_LINK"]["VALUE"])[1];
	?>

    	<div class="video">
        	<iframe width="100%" height="410px" loading="lazy" src="https://www.youtube.com/embed/<?=$code?>" title="<?=$arResult["NAME"]?> - Метиз Комплект" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
    	</div>
    	
	<?php endif; ?>
	
	<?php // Детальное описание ?>
	
	<?php if ($arResult["PROPERTIES"]["DETAIL_DESCRIPTION_TITLE"]["VALUE"]): ?>
		<div class="detail-description-title">
			<?=$arResult["PROPERTIES"]["DETAIL_DESCRIPTION_TITLE"]["VALUE"]?>
		</div>
	<?php endif; ?>
	
	<?php if ($arResult["DETAIL_TEXT"]): ?>
		<div class="detail-text">
			<?=$arResult["DETAIL_TEXT"]?>
		</div>
	<?php endif; ?>
	
	<?php // Список 1 ?>
	
	<?php if ($arResult["PROPERTIES"]["LIST_1"]["VALUE"]): ?>
    	<div class="list">
    		<div class="list-title"><?=$arResult["PROPERTIES"]["LIST_NAME_1"]["VALUE"]?>:</div>
    		<ul>
            	<?php foreach ($arResult["PROPERTIES"]["LIST_1"]["VALUE"] as $val): ?>
            		<li><span><?=$val?>.</span></li>
            	<?php endforeach; ?>
        	</ul>
    	</div>
	<?php endif;?>
	
	<?php // Список 2 ?>
	
	<?php if ($arResult["PROPERTIES"]["LIST_2"]["VALUE"]): ?>
    	<div class="list">
    		<div class="list-title"><?=$arResult["PROPERTIES"]["LIST_NAME_2"]["VALUE"]?>:</div>
    		<ul>
            	<?php foreach ($arResult["PROPERTIES"]["LIST_2"]["VALUE"] as $val): ?>
            		<li><span><?=$val?>.</span></li>
            	<?php endforeach; ?>
        	</ul>
    	</div>
	<?php endif;?>
	
	<?php // Список 3 ?>
	
	<?php if ($arResult["PROPERTIES"]["LIST_3"]["VALUE"]): ?>
    	<div class="list">
    		<div class="list-title"><?=$arResult["PROPERTIES"]["LIST_NAME_3"]["VALUE"]?>:</div>
    		<ul>
            	<?php foreach ($arResult["PROPERTIES"]["LIST_3"]["VALUE"] as $val): ?>
            		<li><span><?=$val?>.</span></li>
            	<?php endforeach; ?>
        	</ul>
    	</div>
	<?php endif;?>
	
	<?php // Список 4 ?>
	
	<?php if ($arResult["PROPERTIES"]["LIST_4"]["VALUE"]): ?>
    	<div class="list">
    		<div class="list-title"><?=$arResult["PROPERTIES"]["LIST_NAME_4"]["VALUE"]?>:</div>
    		<ul>
            	<?php foreach ($arResult["PROPERTIES"]["LIST_4"]["VALUE"] as $val): ?>
            		<li><span><?=$val?>.</span></li>
            	<?php endforeach; ?>
        	</ul>
    	</div>
	<?php endif;?>
	
	<?php // Список 5 ?>
	
	<?php if ($arResult["PROPERTIES"]["LIST_5"]["VALUE"]): ?>
    	<div class="list">
    		<div class="list-title"><?=$arResult["PROPERTIES"]["LIST_NAME_5"]["VALUE"]?>:</div>
    		<ul>
            	<?php foreach ($arResult["PROPERTIES"]["LIST_5"]["VALUE"] as $val): ?>
            		<li><span><?=$val?>.</span></li>
            	<?php endforeach; ?>
        	</ul>
    	</div>
	<?php endif;?>
	
	<?php // Ключевые навыки ?>
	
	<?php if ($arResult["PROPERTIES"]["KEY_SKILLS"]["VALUE"]): ?>
		<div class="key-skills">
			<div class="list-title"><?=$arResult["PROPERTIES"]["KEY_SKILLS"]["NAME"]?></div>
			<?php foreach ($arResult["PROPERTIES"]["KEY_SKILLS"]["VALUE"] as $val): ?>
				<div class="item"><?=$val?></div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

	<?php // Условия для водителей ?>
	
	<?php if ($arResult["PROPERTIES"]["CONDITIONS_FOR_FRIVERS"]["VALUE"]): ?>
    	<div class="list">
    		<div class="list-title"><?=$arResult["PROPERTIES"]["CONDITIONS_FOR_FRIVERS"]["NAME"]?>:</div>
    			Нужны права категории: 
            	<?php foreach ($arResult["PROPERTIES"]["CONDITIONS_FOR_FRIVERS"]["VALUE"] as $key => $val): ?>
            	
                	<?php if (count($arResult["PROPERTIES"]["CONDITIONS_FOR_FRIVERS"]["VALUE"]) - 1 != $key): ?>
                		<?=$val?>,
                	<?php else: ?>
                		<?=$val?>.
                	<?php endif; ?>
            	
            	<?php endforeach; ?>
    	</div>
	<?php endif;?>

	<?php // Адрес ?>
	
	<div class="address">
		<div class="list-title">Адрес</div>
		<span><?=$arResult["PROPERTIES"]["ADDRESS"]["VALUE"]?></span>
	</div>
	
	<?php 
	
	if ($arResult["PROPERTIES"]["ADDRESS"]["VALUE_XML_ID"] == "khb-1") {
	    $longitude = "48.417163";
	    $latitude = "135.103268";
	} elseif ($arResult["PROPERTIES"]["ADDRESS"]["VALUE_XML_ID"] == "khb-2") {
	    $longitude = "48.397857";
	    $latitude = "135.097573";
	} elseif ($arResult["PROPERTIES"]["ADDRESS"]["VALUE_XML_ID"] == "khb-3") {
	    $longitude = "48.490214";
	    $latitude = "135.113383";
	} elseif ($arResult["PROPERTIES"]["ADDRESS"]["VALUE_XML_ID"] == "vld-1") {
	    $longitude = "43.174033";
	    $latitude = "131.907493";
	} elseif ($arResult["PROPERTIES"]["ADDRESS"]["VALUE_XML_ID"] == "ysl-1") {
	    $longitude = "47.004636";
	    $latitude = "142.729192";
	} elseif ($arResult["PROPERTIES"]["ADDRESS"]["VALUE_XML_ID"] == "ysl-2") {
	    $longitude = "46.967500";
	    $latitude = "142.738391";
	}

	?>

	<?php // Карта ?>
	
	<div id="information-map"></div>

	<script>
	var map;
	
	function load_map(coords, zoom, popup) {
		DG.then(function() {
			map = DG.map('information-map', {
				center: coords,
				zoom: zoom,
				touchZoom: false,
				scrollWheelZoom: false,
				doubleClickZoom: false,
				dragging : false,
			});
			DG.marker(coords).addTo(map).bindPopup(popup);
		});
	}

	load_map([<?=$longitude?>, <?=$latitude?>], 16, 'Метиз Комплект');

	</script>
	
	<div class="connection">
		
		<div class="title">
			Связаться с нами
		</div>
		
		<div class="vacancy-respond-button" onclick="showVacancyPopup();">Откликнуться</div>
		<p>Email отдала персонала: <a href="mailto:kadry@mk-27.ru">kadry@mk-27.ru</a></p>
		<p>Телефон отдела персонала: <a href="tel:+79842552035">+7 (984) 255-20-35</a>
		
	</div>
	
</div>