<?php 

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Application;
use Bitrix\Main\Web\Cookie;

// Получение ответа через API
$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();

// Если Ajax, то продолжаем
if ($request->isAjaxRequest())
{
    // Получаем POST через API
    $arValue = $request->getPostList();
    
    // Перебираем полученный POST, стрипим, тримим
    foreach($arValue as $key => $value)
    {
        $post[$key] = trim(strip_tags($value));
    }
    
    $application = Application::getInstance();
    $context = $application->getContext();
    
    $cookie = new Cookie("city", $post["city"], time() + 60*60*24*365);
    // Правильно устанавливаем домен, убираем лишние порты и протоколы
    $host = $context->getServer()->getHttpHost();
    $host = preg_replace('/:\d+$/', '', $host); // Удаляем порт, если он есть
    
    $cookie->setDomain($host);
    $cookie->setHttpOnly(false);
    
    // Устанавливаем Secure в true для HTTPS
    $cookie->setSecure(true);
    
    $context->getResponse()->addCookie($cookie);
    $context->getResponse()->flush("");
    
}

?>