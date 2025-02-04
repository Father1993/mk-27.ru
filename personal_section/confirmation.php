<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Подтверждение регистрации");


$APPLICATION->IncludeComponent("bitrix:system.auth.confirmation","flatext",Array(
		"USER_ID" => "confirm_user_id",
		"CONFIRM_CODE" => "confirm_code",
		"LOGIN" => "login"
	)
);

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>