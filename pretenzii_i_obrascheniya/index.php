<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Претензии и обращения");
$APPLICATION->SetAdditionalCSS ("/pretenzii_i_obrascheniya/claims_and_appeals.css");
$APPLICATION->AddHeadScript ("/pretenzii_i_obrascheniya/claims_and_appeals.js");

if(CModule::IncludeModule("iblock"))
{
    $res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 24), false, false, Array("ID", "NAME", "PROPERTY_EMAILS"));
}
while ($arItem = $res->fetch())
{
    $arEmail[$arItem["NAME"]] .= $arItem['PROPERTY_EMAILS_VALUE'] .  ", ";
}

?>

<div class="page-main-block claims-and-appeals">

	<h1>
		<?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "file",
    		"PATH" => SITE_TEMPLATE_PATH . "/include/claims_and_appeals/title.php"
    	));?>
	</h1>
	
	<p>
		<?$APPLICATION->IncludeComponent("bitrix:main.include","",Array("AREA_FILE_SHOW" => "file",
    		"PATH" => SITE_TEMPLATE_PATH . "/include/claims_and_appeals/text.php"
    	));?>
	</p>
	
	<div class="form-block">
		<div class="form-title">Оставить претензию или обращение</div>
		<form class="form" action="" method="POST">
		
			<input type="text" name="ANTIBOT" class="antibot" required>
		
			<label>
				<span>ФИО <span class="star">*</span></span>
				<input type="text" name="FIO" required>
			</label>
			
			<label>
				<span>Номер телефона <span class="star">*</span></span>
				<input type="phone" name="PHONE" required>
			</label>
			
			<label>
				<span>Email-адрес <span class="star">*</span></span>
				<input type="email" name="EMAIL" required>
			</label>
			
			<label>
				<span>Номер документа (УПД или чека) <span class="star">*</span></span>
				<input type="text" name="DOC_NUMBER" required>
			</label>
			
			<label>
				<span>Дата получения документа (УПД или чека) <span class="star">*</span></span>
				<input type="date" name="DOC_DATE" required>
			</label>
			
			<label>
				<span>Место получения <span class="star">*</span></span>
				<select name="PLACE_OF_COLLECTION" class="pace-of-collection">
					<?php foreach ($arEmail as $adderss_text => $email): ?>
						<option value="<?=$adderss_text?>" email_address="<?=$email?>"><?=$adderss_text?></option>
					<?php endforeach; ?>
				</select>
			</label>
			
			<input type="hidden" name="EMAIL_TO" class="email-to" value="<?=current($arEmail)?>">
			
			<label>
				<span>Текст обращения или претензии</span>
				<textarea name="TEXT" ></textarea>
			</label>
		
			<label class="file-label">
				<div class="file-text"><span class="plus">+</span>Прикрепить файлы</div>
				<input type="file" multiple class="file-input" accept=".jpg, .jpeg, .png, .webp, .pdf">
			</label>
			
			<input type="submit" class="submit-button" value="Отправить">
			
			<div class="policy">
    			Отправляя данную форму, вы соглашаетесь с <a href="/privacy/" target="_blank">политикой конфиденциальности</a>.
    		</div>
		</form>
	</div>

</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>