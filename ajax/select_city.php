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
    
    $cookie = new Cookie("city", $post["city"], time() + 60*60*24*60);
    $cookie->setDomain($context->getServer()->getHttpHost());
    $cookie->setHttpOnly(false);
    $cookie->setSecure(false);
    
    $context->getResponse()->addCookie($cookie);
    $context->getResponse()->flush("");
    
}

?>