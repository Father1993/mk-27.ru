<?php

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
{
    die();
}

global $USER;
$arUser = $USER::GetById($USER->getId())->Fetch();

if ($_GET["SECTION"] == "private") $private_active = "class='active'";
if ($_GET["SECTION"] == "orders") $orders_active = "class='active'";
if ($_GET["SECTION"] == "corders") $comorders_active = "class='active'";
if ($_GET["SECTION"] == "finance") $finance_active = "class='active'";
if ($_GET["SECTION"] == "order_profile") $order_profile = "class='active'";
if ($_GET["SECTION"] == "profile") $profile_active = "class='active'";
if ($_GET["SECTION"] == "feedback") $feedback_active = "class='active'";
?>
<div class="legal-left-menu">
    <a href="/personal_section/index.php?SECTION=private" <?=$private_active?>>Профиль пользователя</a>
    <a href="/personal_section/index.php?SECTION=orders" <?=$orders_active?>>История заказов</a>
    <? /*<a href="/personal_section/index.php?SECTION=corders" <?=$comorders_active?>>Текущие заказы</a> */?>
    <? if($arUser["UF_ISURFACE"] == "1") { ?>
        <a href="/personal_section/index.php?SECTION=finance" <?=$finance_active?>>Документы</a>
    <? } ?>
    <a href="/personal_section/index.php?SECTION=order_profile" <?=$order_profile?>>Профили заказов</a>
	<? /*<a href="/personal_section/index.php?SECTION=feedback" <?=$feedback_active?>>Обратная связь</a> */?>
    <a href="
    <?php
    echo $APPLICATION->GetCurPageParam("logout=yes&".bitrix_sessid_get(), [
        "login",
        "logout",
        "register",
        "forgot_password",
        "change_password"]
    );
    ?>
    ">Выйти</a>
</div>