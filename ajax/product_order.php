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
            $addressList = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 36, "PROPERTY_CITY_VALUE" => $post["CITY"]), false, false, Array("ID", "PROPERTY_CITY", "PROPERTY_EMAIL_TO"));
        }
        while ($addressListGet = $addressList->GetNext())
        {
            $post["EMAIL_TO"] = $addressListGet["PROPERTY_EMAIL_TO_VALUE"];
        }
        
        $send = CEvent::Send('PRODUCT_ORDER', "s1", $post);

        $arFields = array(
            "ACTIVE" => "Y",
            "IBLOCK_ID" => 37,
            "NAME" => $post["PRODUCT_NAME"]
        );
        $oElement = new CIBlockElement();
        $idElement = $oElement->Add($arFields);
        
        CIBlockElement::SetPropertyValueCode($idElement, "CITY", $post["CITY"]);
        CIBlockElement::SetPropertyValueCode($idElement, "NAME_FROM", $post["NAME_FROM"]);
        CIBlockElement::SetPropertyValueCode($idElement, "PHONE", $post["PHONE"]);
        CIBlockElement::SetPropertyValueCode($idElement, "PRODUCT_LINK", $post["URL"]);
        CIBlockElement::SetPropertyValueCode($idElement, "EMAIL", $post["EMAIL"]);
        CIBlockElement::SetPropertyValueCode($idElement, "COUNT", $post["COUNT"]);
        CIBlockElement::SetPropertyValueCode($idElement, "PRODUCT_XML_ID", $post["PRODUCT_XML_ID"]);

    }
    
}

?>