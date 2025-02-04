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
$i = 0;
?>

<div class="vacancy">

    <h1><?=$APPLICATION->GetTitle();?></h1>
    
    <?php foreach ($arResult["ITEMS"] as $cityName => $arItems): ?>
    
    	<div class="city-list-title"><?=$cityName?></div>
    
        <?php foreach ($arItems as $categoryName => $arVacancy): ?>
        	<div class="category">
        	
        		<div class="category-name-block">
            		<span class="name" onclick="showVacancyList(<?=$i?>);"><?=$categoryName?></span>
            		<span class="count"><?=count($arVacancy);?></span>
        		</div>
        		
        		<div class="category-list container category-list-<?=$i?>">
        			<?php foreach ($arVacancy as $vacancy): 
        			$this->AddEditAction($vacancy['ID'], $vacancy['EDIT_LINK'], CIBlock::GetArrayByID($vacancy["IBLOCK_ID"], "ELEMENT_EDIT"));
        			$this->AddDeleteAction($vacancy['ID'], $vacancy['DELETE_LINK'], CIBlock::GetArrayByID($vacancy["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                	?>
        				
        				<div class="row"  id="<?=$this->GetEditAreaId($vacancy['ID']);?>">
        				
        					<div class="col-12 col-sm-6 name">
        						<a href="<?=$vacancy["DETAIL_PAGE_URL"]?>"><?=$vacancy["NAME"]?></a>
        					</div>
        					
        					<div class="col-12 col-sm-6 salary">
        						<?php if ($vacancy["SALARY_FROM"] || $vacancy["SALARY_TO"]): ?>
        							<?php if ($vacancy["SALARY_FROM"]): ?>
        								<span>от <?=number_format($vacancy["SALARY_FROM"], 0, ".", " ")?></span>
        							<?php endif; ?>
        							<?php if ($vacancy["SALARY_TO"]): ?>
        								<span> до <?=number_format($vacancy["SALARY_TO"], 0, ".", " ")?></span>
        							<?php endif; ?>
        							<span> руб.</span>
    							<?php else: ?>
    							<span>з/п не указана</span>
        						<?php endif; ?>
        					</div>
        					        					
        				</div>
        				
        				<div class="row">
        					<div class="col-12 date">
    							<?=$vacancy["ACTIVE_FROM"]?>
        					</div>
        				</div>
        				
        			<?php endforeach; ?>
        		</div>
        	</div>
        	<?php $i++; ?>
        <?php endforeach; ?>
    <?php endforeach; ?>
    
</div>
