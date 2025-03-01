<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");

$USER = $GLOBALS["USER"];

if ($USER->IsAuthorized()) {
    $userName = $USER->GetFullName();
    if (!$userName)
        $userName = $USER->GetLogin();
    
    // Контент для авторизованных пользователей
    ?>
<?$APPLICATION->IncludeComponent(
        "bitrix:system.auth.confirmation", 
        "my", 
        array(
            "CONFIRM_CODE" => "confirm_code",
            "LOGIN" => "login",
            "USER_ID" => "confirm_user_id",
            "COMPONENT_TEMPLATE" => "my"
        ),
        false
    );?>
<?$APPLICATION->IncludeComponent(
        "bitrix:system.auth.form", 
        "my", 
        array(
            "FORGOT_PASSWORD_URL" => "/auth/forget.php",
            "PROFILE_URL" => "/auth/personal.php",
            "REGISTER_URL" => "/auth/registration.php",
            "SHOW_ERRORS" => "N",
            "COMPONENT_TEMPLATE" => "my"
        ),
        false
    );?>
<?
} else {
    // Контент для неавторизованных пользователей
    ?>
<?$APPLICATION->IncludeComponent(
        "bitrix:system.auth.authorize",
        "my-auth-form",
        array(
            "REGISTER_URL" => "/auth/registration.php",
            "FORGOT_PASSWORD_URL" => "/auth/forgot.php",
            "PROFILE_URL" => "/auth/personal.php",
            "SHOW_ERRORS" => "Y"
        ),
        false
    );?>
<?
}
?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>