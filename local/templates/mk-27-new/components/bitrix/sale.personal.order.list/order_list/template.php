<?php if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>
<?php
    $fmt = numfmt_create("ru_RU", NumberFormatter::CURRENCY);
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
                <h1>Список заказов</h1>
    
                <?php if ($arResult["ORDERS_LIST"]): ?>    
                    <div class="orders-list-container">
                    
                        <?php if ($arResult["ORDERS_LIST"]): ?>
                        
                            <?php foreach ($arResult["ORDERS_LIST"] as $order): ?>
                        		
                            	<div class="row order-row" id="<?=$order["ID"]?>">
                            	
                            		<div class="col order-main-info" onclick="showOrderDetail(<?=$order["ID"]?>);">
                            			<img class="arrow" src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTYiIGhlaWdodD0iMTAiIHZpZXdCb3g9IjAgMCAxNiAxMCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4NCjxwYXRoIGZpbGwtcnVsZT0iZXZlbm9kZCIgY2xpcC1ydWxlPSJldmVub2RkIiBkPSJNNy40Mjk4MSAxLjE0OTU1QzcuNzQ3MTEgMC44MzIyOTMgOC4yNjE1MyAwLjgzMjMxMyA4LjU3ODgxIDEuMTQ5NkwxNS41NDM2IDguMTE0MzVDMTUuODYwOSA4LjQzMTY1IDE1Ljg2MDkgOC45NDYwOSAxNS41NDM2IDkuMjYzMzlDMTUuMjI2MyA5LjU4MDcgMTQuNzExOCA5LjU4MDcgMTQuMzk0NSA5LjI2MzM5TDguMDA0MjQgMi44NzMxMkwxLjYxMjkzIDkuMjYzNDRDMS4yOTU2MSA5LjU4MDcyIDAuNzgxMTYgOS41ODA2OCAwLjQ2Mzg4MyA5LjI2MzM1QzAuMTQ2NjA3IDguOTQ2MDIgMC4xNDY2NDcgOC40MzE1OCAwLjQ2Mzk3MyA4LjExNDNMNy40Mjk4MSAxLjE0OTU1WiIgZmlsbD0iIzRFNEU0RSIvPg0KPC9zdmc+DQo=">
                        				<b class="order-number">Заказ № <?=$order["ID"]?></b> от <?=$order["DATE_INSERT_FORMATED"]?>
                        			</div>
                        			
                            		<div class="col summ_price">
                            			Итого:&nbsp;<b><?= number_format($order["PRICE"], 2, ".", " ") ?> <i class="fa fa-rub" aria-hidden="true"></i></b>
                            		</div>
                            		
                            		<div class="order-details__list">
                            			
                            			<?php foreach ($order["BASKET"] as $basket): ?>
                            			
                            				<div class="order-details__item row">
                            					<div class="col image">
                            					<?php if ($arResult["PRODUCT_PICTURES"][$basket["PRODUCT_ID"]]): ?>
                            						<img src="<?=$arResult["PRODUCT_PICTURES"][$basket["PRODUCT_ID"]]?>">
                        						<?php else: ?>
                        							<img src="<?=SITE_TEMPLATE_PATH . "/assets/images/placeholder.jpg"?>">
                    							<?php endif; ?>
                            					</div>
                            					<div class="col name">
                            						<a href="<?=$basket["DETAIL_PAGE_URL"]?>"><?=$basket["NAME"]?></a>
                            					</div>
                            					<div class="col prices">
                                					<div class="prices-inner">
                                						<div class="prices-inner-summ">Цена: <b><?= $basket["PRICE"] * $basket["QUANTITY"] ?> <i class="fa fa-rub" aria-hidden="true"></i></b></div>
                                						<div class="prices-inner-detail"><?=$basket["QUANTITY"]?> <?=$basket["MEASURE_NAME"]?>. x <?= number_format($basket["PRICE"], 2, ".", " ") ?> <i class="fa fa-rub" aria-hidden="true"></i></div>
                                					</div>
                            					</div>
                            				</div>
                            			
                            			<?php endforeach; ?>
                            		</div>
                            		
                            	</div>
                            	
                            <?php endforeach; ?>
                            
                        <?php else: ?>
                        
                        <div class="row order-row">
                        
                        	<div class="col-12">
                        		<div class="no-orders">У вас пока нет заказов.</div>
                        	</div>
                        
                        </div>
                            
                        <?php endif; // if ($arResult["ORDERS_LIST"]): ?>
                    
                    </div>
                <?php else: ?>
                    <h3>У вас ещё нет заказов.</h3>
                <?php endif; ?>
    		</div>
    		
    	</div>
    </div>

<?php endif; ?>