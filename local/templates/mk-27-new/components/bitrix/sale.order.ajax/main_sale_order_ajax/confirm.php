<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;

/**
 * @var array $arParams
 * @var array $arResult
 * @var $APPLICATION CMain
 */

if ($arParams["SET_TITLE"] == "Y")
{
	$APPLICATION->SetTitle(Loc::getMessage("SOA_ORDER_COMPLETE"));
}
?>



<? if (!empty($arResult["ORDER"])): ?>

<?php 
// Заменяем логин на Email при регистрации нового пользователя
$USER_UPD = new CUser;
$rsUser = CUser::GetByID($arResult["ORDER"]['USER_ID']);
$arUser = $rsUser->Fetch();
$fields = array(
    "EMAIL" => $arUser['EMAIL'],
    "LOGIN" => $arUser['EMAIL']
);
$USER_UPD->Update($arResult["ORDER"]['USER_ID'], $fields);

?>

<h1 class="confirm-title">Заказ сформирован</h1>

<div class="confirm-block">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="">
    				<?=Loc::getMessage("SOA_ORDER_SUC", array(
    					"#ORDER_DATE#" => $arResult["ORDER"]["DATE_INSERT"]->toUserTime()->format('d.m.Y H:i'),
    					"#ORDER_ID#" => $arResult["ORDER"]["ACCOUNT_NUMBER"]
    				))?>
    				<? if (!empty($arResult['ORDER']["PAYMENT_ID"])): ?>
    					<?=Loc::getMessage("SOA_PAYMENT_SUC", array(
    						"#PAYMENT_ID#" => $arResult['PAYMENT'][$arResult['ORDER']["PAYMENT_ID"]]['ACCOUNT_NUMBER']
    					))?>
    				<? endif ?>
    				<? if ($arParams['NO_PERSONAL'] !== 'Y'): ?>
    					<br /><br />
    					<?=Loc::getMessage('SOA_ORDER_SUC1', ['#LINK#' => $arParams['PATH_TO_PERSONAL']])?>
    				<? endif; ?>
    				
                	<?
                	if ($arResult["ORDER"]["IS_ALLOW_PAY"] === 'Y')
                	{
                		if (!empty($arResult["PAYMENT"]))
                		{
                			foreach ($arResult["PAYMENT"] as $payment)
                			{
                				if ($payment["PAID"] != 'Y')
                				{
                					if (!empty($arResult['PAY_SYSTEM_LIST'])
                						&& array_key_exists($payment["PAY_SYSTEM_ID"], $arResult['PAY_SYSTEM_LIST'])
                					)
                					{
                						$arPaySystem = $arResult['PAY_SYSTEM_LIST_BY_PAYMENT_ID'][$payment["ID"]];
                
                						if (empty($arPaySystem["ERROR"]))
                						{
                							?>
                							<br /><br />
                
                							<table class="sale_order_full_table">
                								<tr>
                									<td class="ps_logo">
                										<div class="pay_name"><?=Loc::getMessage("SOA_PAY") ?></div>
                										<?=CFile::ShowImage($arPaySystem["LOGOTIP"], 100, 100, "border=0\" style=\"width:100px\"", "", false) ?>
                										<div class="paysystem_name"><?=$arPaySystem["NAME"] ?></div>
                										<br/>
                									</td>
                								</tr>
                								<tr>
                									<td>
                										<? if ($arPaySystem["ACTION_FILE"] <> '' && $arPaySystem["NEW_WINDOW"] == "Y" && $arPaySystem["IS_CASH"] != "Y"): ?>
                											<?
                											$orderAccountNumber = urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]));
                											$paymentAccountNumber = $payment["ACCOUNT_NUMBER"];
                											?>
                											<script>
                												window.open('<?=$arParams["PATH_TO_PAYMENT"]?>?ORDER_ID=<?=$orderAccountNumber?>&PAYMENT_ID=<?=$paymentAccountNumber?>');
                											</script>
                										<?=Loc::getMessage("SOA_PAY_LINK", array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".$orderAccountNumber."&PAYMENT_ID=".$paymentAccountNumber))?>
                										<? if (CSalePdf::isPdfAvailable() && $arPaySystem['IS_AFFORD_PDF']): ?>
                										<br/>
                											<?=Loc::getMessage("SOA_PAY_PDF", array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".$orderAccountNumber."&pdf=1&DOWNLOAD=Y"))?>
                										<? endif ?>
                										<? else: ?>
                											<?=$arPaySystem["BUFFERED_OUTPUT"]?>
                										<? endif ?>
                									</td>
                								</tr>
                							</table>
                
                							<?
                						}
                						else
                						{
                							?>
                							<span style="color:red;"><?=Loc::getMessage("SOA_ORDER_PS_ERROR")?></span>
                							<?
                						}
                					}
                					else
                					{
                						?>
                						<span style="color:red;"><?=Loc::getMessage("SOA_ORDER_PS_ERROR")?></span>
                						<?
                					}
                				}
                			}
                		}
                	}
                	else
                	{
                		?>
                		<strong><?=$arParams['MESS_PAY_SYSTEM_PAYABLE_ERROR']?></strong>
                		<?
                	}
                	?>
    				
				</div>
			</div>
		</div>
	</div>
</div>
<? else: ?>

<h1 class="confirm-title"><?=Loc::getMessage("SOA_ERROR_ORDER")?></h1>

<div class="confirm-block">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="">
    				<?=Loc::getMessage("SOA_ERROR_ORDER_LOST", ["#ORDER_ID#" => htmlspecialcharsbx($arResult["ACCOUNT_NUMBER"])])?>
    				<?=Loc::getMessage("SOA_ERROR_ORDER_LOST1")?>
				</div>
			</div>
		</div>
	</div>
</div>

<? endif ?>