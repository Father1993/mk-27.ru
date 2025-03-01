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
 *
 *  _________________________________________________________________________
 * |	Attention!
 * |	The following comments are for system use
 * |	and are required for the component to work correctly in ajax mode:
 * |	<!-- items-container -->
 * |	<!-- pagination-container -->
 * |	<!-- component-end -->
 */

$this->setFrameMode(true);
//$this->addExternalCss('/bitrix/css/main/bootstrap.css');
?>

	
		
	
        <?php foreach ($arResult["ITEMS"] as $item): ?>
        
        	<div class="col-12 col-md-6 col-lg-4 col-xl-3 item" id="<?=$this->GetEditAreaId($item['ID']);?>">
            	<a href="<?=$item["DETAIL_PAGE_URL"]?>">
                	<div class="item-inner">
            			<div class="picture" style="background-image: url('<?=$item["DETAIL_PICTURE"]["SRC"]?>');"></div>
            			<div class="title"><?=$item["NAME"]?></div>
                	</div>
            	</a>
        	</div>
        
        <?php endforeach; ?>
        
    </div>
</div>