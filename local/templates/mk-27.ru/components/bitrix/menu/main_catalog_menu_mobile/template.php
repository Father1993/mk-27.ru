<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<div class="main-catalog-menu-block-mobile">
    <ul class="main-catalog-menu-mobile">
        
        <?
        $previousLevel = 0;
        foreach($arResult as $arItem):?>
        
        	<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
        		<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
        	<?endif?>
        
        	<?if ($arItem["IS_PARENT"]):?>
        	
        		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
        		
        		<?php if ($arItem["PARAMS"]["UF_ELEMENT_CNT"] > 0) $parent = TRUE; else $parent = FALSE; // parent ?>
        		
        			<li class="<?php if ($arItem["IS_PARENT"]):?>parent<?php endif;?>">
            			<?php if ($parent): ?>
                			<a class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>" onclick="showLevel2Menu('<?=$arItem["CODE"]?>');">
                				<img src="<?=SITE_TEMPLATE_PATH?>/assets/images/catalog/<?=$arItem["CODE"]?>.svg"> <span><?=$arItem["TEXT"]?></span>
                				<?php if ($parent) echo "<i class='fa fa-angle-right'></i>"?>
                			</a>
            			<?php else: ?>
                			<a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>">
                				<img src="<?=SITE_TEMPLATE_PATH?>/assets/images/catalog/<?=$arItem["CODE"]?>.svg"> <span><?=$arItem["TEXT"]?></span>
                				<?php if ($parent) echo "<i class='fa fa-angle-right'></i>"?>
                			</a>            			
            			<?php endif; ?>

            			<div class="level-2-block level-2-block-<?=$arItem["CODE"]?>">
        				<ul class="root-item">
            				<div class="back" onclick="hideLevel2Catalog();">
                        		<i class="fa fa-angle-left"></i>
                        		<h3>Назад</h3>
                    		</div>
        		<?else:?>
        			<li class="<?php if ($arItem["IS_PARENT"]):?>parent<?php endif;?>">
        			<a href="<?=$arItem["LINK"]?>" class="parent<?if ($arItem["SELECTED"]):?> item-selected<?endif?>">
        				<?=$arItem["TEXT"]?>
        			</a>
        				<ul class="level3">
        		<?endif?>
        
        	<?else:?>
        
        		<?if ($arItem["PERMISSION"] > "D"):?>
        
        			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
        				<li><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>"><img src="<?=SITE_TEMPLATE_PATH?>/assets/images/catalog/<?=$arItem["CODE"]?>.svg"> <span><?=$arItem["TEXT"]?></span></a></li>
        			<?else:?>
        				<li>
            				<a href="<?=$arItem["LINK"]?>" <?if ($arItem["SELECTED"]):?> class="item-selected"<?endif?>>
            					<?=$arItem["TEXT"]?><span class="count"><?=$arItem["PARAMS"]["UF_ELEMENT_CNT"]?></span>
            				</a>
        				</li>
        			<?endif?>
        
        		<?else:?>
        
        			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
        				<li><a href="" class="<?if ($arItem["SELECTED"]):?>root-item-selected<?else:?>root-item<?endif?>" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
        			<?else:?>
        				<li><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
        			<?endif?>
        
        		<?endif?>
        
        	<?endif?>
        
        	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>
        
        <?endforeach?>
        
        <?if ($previousLevel > 1)://close last item tags?>
        	<?=str_repeat("</ul></div></li>", ($previousLevel-1) );?>
        <?endif?>
    
    </ul>
</div>
<?endif?>
