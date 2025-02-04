<?php 

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
{
    die();
}

if ($_GET["SECTION"] == "private") $private_active = "class='active'";
if ($_GET["SECTION"] == "orders") $orders_active = "class='active'";
if ($_GET["SECTION"] == "profile") $profile_active = "class='active'";
?>

<a href="/personal_section/index.php?SECTION=private" <?=$private_active?>>Профиль пользователя</a><br>
<a href="/personal_section/index.php?SECTION=orders" <?=$orders_active?>>Список заказов</a><br>
<a href="/personal_section/index.php?SECTION=profile" <?=$profile_active?>>Профили заказов</a><br>
<br>
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