<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Localization\Loc;

if($arResult["ERROR_MESSAGE"] <> '')
{
	ShowError($arResult["ERROR_MESSAGE"]);
}
if($arResult["NAV_STRING"] <> '')
{
	?>
	<p><?=$arResult["NAV_STRING"]?></p>
	<?
}
?>

<?php 
global $USER;
if ($USER->IsAuthorized()):
?>

    <div class="container personal">
    	<div class="row">
    		<div class="col-12 col-lg-3 personal-left">
    			
    			<div class="personal-menu">
    				<?php $APPLICATION->IncludeFile(SITE_TEMPLATE_PATH . "/components/bitrix/sale.personal.section/personal_section/personal_menu.php", Array(), Array("MODE"=>"PHP")); ?>
    			</div>
    
    		</div>
    		
    		<div class="col-12 col-lg-9">
    		
    		<h1>Профили заказов</h1>
    
                <?php 
                if (is_array($arResult["PROFILES"]) && !empty($arResult["PROFILES"]))
                {
                	?>
                	<table class="table sale-personal-profile-list-container">
                		<tr>
                			<?
                			$dataColumns = array(
                				"DATE_UPDATE", "NAME", "PERSON_TYPE_ID"
                			);
                			foreach ($dataColumns as $column)
                			{
                				?>
                				<th>
                					<?=Loc::getMessage("P_".$column)?>
                					<a class="sale-personal-profile-list-arrow-up" href="<?=$arResult['URL']?>by=<?=$column?>&order=asc#nav_start">
                						<i class="fa fa-chevron-up"></i>
                					</a>
                					<a class="sale-personal-profile-list-arrow-down" href="<?=$arResult['URL']?>by=<?=$column?>&order=desc#nav_start">
                						<i class="fa fa-chevron-down"></i>
                					</a>
                				</th>
                				<?
                			}
                			?>
                			<th><?=Loc::getMessage("SALE_ACTION")?></th>
                		</tr>
                		<?foreach($arResult["PROFILES"] as $val)
                		{
                			?>
                			<tr>
                				<td><?= $val["DATE_UPDATE"] ?></td>
                				<td><?= $val["NAME"] ?></td>
                				<td><?= $val["PERSON_TYPE"]["NAME"] ?></td>
                				<td class="sale-personal-profile-list-actions">
                					<a class="sale-personal-profile-list-change-button" title="<?= Loc::getMessage("SALE_DETAIL_DESCR") ?>"
                						href="<?= $val["URL_TO_DETAIL"] ?>"><?= GetMessage("SALE_DETAIL") ?>
                					</a>
                					<span class="sale-personal-profile-list-border"></span>
                					<a class="sale-personal-profile-list-close-button" title="<?= Loc::getMessage("SALE_DELETE_DESCR") ?>"
                						href="javascript:if(confirm('<?= Loc::getMessage("STPPL_DELETE_CONFIRM") ?>')) window.location='<?= $val["URL_TO_DETELE"] ?>'">
                						<?= Loc::getMessage("SALE_DELETE") ?>
                					</a>
                				</td>
                			</tr>
                			<?
                		}?>
                	</table>
                	<?
                	if($arResult["NAV_STRING"] <> '')
                	{
                		?>
                		<p><?=$arResult["NAV_STRING"]?></p>
                		<?
                	}
                }
                elseif ($arResult['USER_IS_NOT_AUTHORIZED'] !== 'Y')
                {
                	?>
                	<h3><?=Loc::getMessage("STPPL_EMPTY_PROFILE_LIST") ?></h3>
                	<?
                }
                ?>
    		</div>
    	</div>
    </div>
    
<?php endif; ?>