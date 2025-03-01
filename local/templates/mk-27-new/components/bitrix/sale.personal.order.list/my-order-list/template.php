<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
{
	die();
}

/** @var CBitrixPersonalOrderListComponent $component */
/** @var array $arParams */
/** @var array $arResult */

use Bitrix\Main;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Page\Asset;

\Bitrix\Main\UI\Extension::load([
	'ui.design-tokens',
	'ui.fonts.opensans',
	'clipboard',
	'fx',
]);

Asset::getInstance()->addJs("/bitrix/components/bitrix/sale.order.payment.change/templates/.default/script.js");
Asset::getInstance()->addCss("/bitrix/components/bitrix/sale.order.payment.change/templates/.default/style.css");
$this->addExternalCss("/bitrix/css/main/bootstrap.css");

Loc::loadMessages(__FILE__);

if (!empty($arResult['ERRORS']['FATAL']))
{
	foreach($arResult['ERRORS']['FATAL'] as $error)
	{
		ShowError($error);
	}
	$component = $this->__component;
	if ($arParams['AUTH_FORM_IN_TEMPLATE'] && isset($arResult['ERRORS']['FATAL'][$component::E_NOT_AUTHORIZED]))
	{
		$APPLICATION->AuthForm('', false, false, 'N', false);
	}

}
else
{
	$filterHistory = ($_REQUEST['filter_history'] ?? '');
	$filterShowCanceled = ($_REQUEST["show_canceled"] ?? '');

	if (!empty($arResult['ERRORS']['NONFATAL']))
	{
		foreach($arResult['ERRORS']['NONFATAL'] as $error)
		{
			ShowError($error);
		}
	}
	if (empty($arResult['ORDERS']))
	{
		if ($filterHistory === 'Y')
		{
			if ($filterShowCanceled === 'Y')
			{
				?>
<h3><?= Loc::getMessage('SPOL_TPL_EMPTY_CANCELED_ORDER')?></h3>
<?
			}
			else
			{
				?>
<h3><?= Loc::getMessage('SPOL_TPL_EMPTY_HISTORY_ORDER_LIST')?></h3>
<?
			}
		}
		else
		{
			?>
<h3><?= Loc::getMessage('SPOL_TPL_EMPTY_ORDER_LIST')?></h3>
<?
		}
	}
	?>
<div class="orders-list-wrapper">
  <!-- Фильтр заказов -->
  <div class="orders-filter mb-4">
    <div class="btn-group" role="group">
      <?if (!isset($_REQUEST["filter_history"])):?>
      <a href="<?=$APPLICATION->GetCurPageParam("filter_history=Y", array("filter_history","filter_status","show_all","show_canceled"))?>#orders"
        class="btn btn-outline-primary">
        <i class="bi bi-clock-history"></i>
        <?=Loc::getMessage("SPOL_TPL_VIEW_ORDERS_HISTORY")?>
      </a>
      <?else:?>
      <a href="<?=$APPLICATION->GetCurPageParam("", array("filter_history","filter_status","show_all","show_canceled"))?>#orders"
        class="btn btn-outline-primary">
        <i class="bi bi-cart"></i>
        <?=Loc::getMessage("SPOL_TPL_CUR_ORDERS")?>
      </a>
      <?if($_REQUEST["show_canceled"] !== 'Y'):?>
      <a href="<?=$APPLICATION->GetCurPageParam("filter_history=Y&show_canceled=Y", array("filter_history","filter_status","show_all","show_canceled"))?>#orders"
        class="btn btn-outline-danger">
        <i class="bi bi-x-circle"></i>
        <?=Loc::getMessage("SPOL_TPL_VIEW_ORDERS_CANCELED")?>
      </a>
      <?endif;?>
      <?endif;?>
    </div>
  </div>

  <?if (!empty($arResult['ORDERS'])):?>
  <!-- Список заказов -->
  <div class="orders-grid">
    <?foreach ($arResult['ORDERS'] as $key => $order):?>
    <div class="order-card">
      <div class="order-card-header">
        <div class="order-info">
          <h3 class="order-number">
            <?=Loc::getMessage('SPOL_TPL_ORDER')?>
            <?=Loc::getMessage('SPOL_TPL_NUMBER_SIGN')?><?=$order['ORDER']['ACCOUNT_NUMBER']?>
          </h3>
          <div class="order-date">
            <i class="bi bi-calendar3"></i>
            <?=$order['ORDER']['DATE_INSERT_FORMATED']?>
          </div>
        </div>
      </div>

      <div class="order-card-body">
        <div class="order-details">
          <div class="order-sum">
            <i class="bi bi-wallet2"></i>
            <strong><?=Loc::getMessage('SPOL_TPL_SUMOF')?></strong>
            <?=$order['ORDER']['FORMATED_PRICE']?>
          </div>
          <div class="order-items">
            <i class="bi bi-box"></i>
            <strong><?=count($order['BASKET_ITEMS'])?></strong>
            <?
            $count = count($order['BASKET_ITEMS']) % 10;
            if ($count == '1')
                echo Loc::getMessage('SPOL_TPL_GOOD');
            elseif ($count >= '2' && $count <= '4')
                echo Loc::getMessage('SPOL_TPL_TWO_GOODS');
            else
                echo Loc::getMessage('SPOL_TPL_GOODS');
            ?>
          </div>
        </div>
      </div>

      <div class="order-card-footer">
        <div class="order-actions">
          <a href="<?=$order["ORDER"]["URL_TO_COPY"]?>" class="btn btn-outline-primary btn-sm">
            <i class="bi bi-arrow-repeat"></i>
            <?=Loc::getMessage('SPOL_TPL_REPEAT_ORDER')?>
          </a>
          <?if ($order['ORDER']['CAN_CANCEL'] !== 'N'):?>
          <a href="<?=$order["ORDER"]["URL_TO_CANCEL"]?>" class="btn btn-outline-danger btn-sm">
            <i class="bi bi-x-circle"></i>
            <?=Loc::getMessage('SPOL_TPL_CANCEL_ORDER')?>
          </a>
          <?endif;?>
        </div>
      </div>
    </div>
    <?endforeach;?>
  </div>

  <?if ($arResult["NAV_STRING"]):?>
  <div class="orders-pagination mt-4">
    <?=$arResult["NAV_STRING"]?>
  </div>
  <?endif;?>

  <?else:?>
  <div class="orders-empty text-center">
    <i class="bi bi-cart-x"></i>
    <h3 class="mb-4">
      <?if ($_REQUEST["filter_history"] === 'Y'):?>
      <?if ($_REQUEST["show_canceled"] === 'Y'):?>
      <?=Loc::getMessage('SPOL_TPL_EMPTY_CANCELED_ORDER')?>
      <?else:?>
      <?=Loc::getMessage('SPOL_TPL_EMPTY_HISTORY_ORDER_LIST')?>
      <?endif;?>
      <?else:?>
      <?=Loc::getMessage('SPOL_TPL_EMPTY_ORDER_LIST')?>
      <?endif;?>
    </h3>
    <a href="<?=htmlspecialcharsbx($arParams['PATH_TO_CATALOG'])?>" class="btn btn-primary">
      <i class="bi bi-cart"></i>
      <?=Loc::getMessage('SPOL_TPL_LINK_TO_CATALOG')?>
    </a>
  </div>
  <?endif;?>
</div>
<?}?>