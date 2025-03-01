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

<div class="team-section">
	<div class="container no-padding-container">
		<h2 class="team-title">
			<?$APPLICATION->IncludeComponent("bitrix:main.include","",Array(
				"AREA_FILE_SHOW" => "file",
				"PATH" => SITE_TEMPLATE_PATH . "/include/team_title.php"
			));?>
		</h2>
		
		<div class="team-grid">
			<?php foreach ($arResult["ITEMS"] as $item):
				$this->AddEditAction($item['ID'], $item['EDIT_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($item['ID'], $item['DELETE_LINK'], CIBlock::GetArrayByID($item["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				
				$name = explode(" ", $item["NAME"]);
				$fname = $name[0] ?? '';
				$sname = $name[1] ?? '';
			?>
			
			<div class="team-card" id="<?=$this->GetEditAreaId($item['ID']);?>">
				<div class="card-inner">
					<div class="image-wrapper">
						<?php if($item["DETAIL_PICTURE"]["SRC"]): ?>
							<img src="<?=$item["DETAIL_PICTURE"]["SRC"]?>" alt="<?=$item["NAME"]?>" class="team-photo">
						<?php else: ?>
							<div class="no-photo">
								<i class="bi bi-person-circle"></i>
							</div>
						<?php endif; ?>
					</div>
					
					<div class="card-content">
						<h3 class="member-name">
							<span class="firstname"><?=$fname?></span>
							<span class="lastname"><?=$sname?></span>
						</h3>
						
						<?php if ($item["PROPERTIES"]["POSITION"]["VALUE"]): ?>
							<div class="position">
								<i class="bi bi-briefcase"></i>
								<span><?=$item["PROPERTIES"]["POSITION"]["VALUE"]?></span>
							</div>
						<?php endif; ?>
						
						<div class="contact-info">
							<?php if ($item["PROPERTIES"]["PHONE_PLUS_CODE"]["VALUE"]): 
								$phone_to_link = preg_replace('![^0-9]+!', '', explode("+", $item["PROPERTIES"]["PHONE_PLUS_CODE"]["VALUE"])[1]); 
							?>
								<div class="phone-block">
									<a href="tel:+<?=$phone_to_link?>" class="contact-button phone-button">
										<i class="bi bi-telephone"></i>
										<span><?=$item["PROPERTIES"]["PHONE_PLUS_CODE"]["VALUE"]?></span>
									</a>
								</div>
							<?php endif; ?>
							
							<?php if ($item["PROPERTIES"]["PHONE_PLUS_CODE_2"]["VALUE"]): 
								$phone_to_link_2 = preg_replace('![^0-9]+!', '', explode("+", $item["PROPERTIES"]["PHONE_PLUS_CODE_2"]["VALUE"])[1]); 
							?>
								<div class="phone-block">
									<a href="tel:+<?=$phone_to_link_2?>" class="contact-button phone-button">
										<i class="bi bi-telephone"></i>
										<span><?=$item["PROPERTIES"]["PHONE_PLUS_CODE_2"]["VALUE"]?></span>
									</a>
								</div>
							<?php endif; ?>
							
							<?php if ($item["PROPERTIES"]["EMAIL"]["VALUE"]): ?>
								<a href="mailto:<?=$item["PROPERTIES"]["EMAIL"]["VALUE"]?>" class="contact-button email-button">
									<i class="bi bi-envelope"></i>
									<span><?=$item["PROPERTIES"]["EMAIL"]["VALUE"]?></span>
								</a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>