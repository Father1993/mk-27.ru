<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus("404 Not Found");
@define("ERROR_404","Y");
define("HIDE_SIDEBAR", true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->SetTitle("Страница не найдена");?>

<div class="container error-404">
	
	<h1>Страница не найдена</h1>
	
	<h2>404</h2>
	
	<a href="/" class="">Продолжить</a>
	
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>