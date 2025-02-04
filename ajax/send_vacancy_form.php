<?php

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");

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
    
    if (!$post["ANTIBOT"]) // Антибот
    {

        // Получаем email_to из инфоблока "Адреса и Email для откликов на вакансии" в зависимости от города
        if(CModule::IncludeModule("iblock"))
        {
            $addressList = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 28, "PROPERTY_CITY_VALUE" => $post["CITY"]), false, false, Array("ID", "PROPERTY_CITY", "PROPERTY_EMAIL_TO"));
        }
        while ($addressListGet = $addressList->GetNext())
        {
            $post["EMAIL_TO"] = $addressListGet["PROPERTY_EMAIL_TO_VALUE"];
        }
        
        $send = CEvent::Send('JOB_POSTING', "s1", $post);

        $arFields = array(
            "ACTIVE" => "Y",
            "IBLOCK_ID" => 20,
            "NAME" => $post["VACANCY"]
        );
        $oElement = new CIBlockElement();
        $idElement = $oElement->Add($arFields);
        
        CIBlockElement::SetPropertyValueCode($idElement, "CITY", $post["CITY"]);
        CIBlockElement::SetPropertyValueCode($idElement, "NAME", $post["NAME"]);
        CIBlockElement::SetPropertyValueCode($idElement, "PHONE", $post["PHONE"]);
        CIBlockElement::SetPropertyValueCode($idElement, "EMAIL", $post["EMAIL"]);

    }
    
}

?>