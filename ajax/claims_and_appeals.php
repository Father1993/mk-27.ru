<?php

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");

use \Bitrix\Main\Application;

// Получение ответа через API
$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();

// Если Ajax, то продолжаем
if ($request->isAjaxRequest())
{
    // Получаем POST через API
    $arValue = $request->getPostList();
    
    // Получаем FILES через API
    $files = $request->getFileList()->toArray();
    
    // Перебираем полученный POST, стрипим, тримим
    foreach($arValue as $key => $value)
    {
        $post[$key] = trim(strip_tags($value));
    }

    if (!$post["ANTIBOT"]) // Антибот
    {
        $arFields = array(
            "ACTIVE" => "Y",
            "IBLOCK_ID" => 21,
            "NAME" => $post["FIO"]
        );
        $oElement = new CIBlockElement();
        $idElement = $oElement->Add($arFields);
        
        CIBlockElement::SetPropertyValueCode($idElement, "PHONE", $post["PHONE"]);
        CIBlockElement::SetPropertyValueCode($idElement, "EMAIL", $post["EMAIL"]);
        CIBlockElement::SetPropertyValueCode($idElement, "DOC_NUMBER", $post["DOC_NUMBER"]);
        CIBlockElement::SetPropertyValueCode($idElement, "DOC_DATE", $post["DOC_DATE"]);
        CIBlockElement::SetPropertyValueCode($idElement, "PLACE_OF_COLLECTION", $post["PLACE_OF_COLLECTION"]);
        CIBlockElement::SetPropertyValueCode($idElement, "TEXT", $post["TEXT"]);
        CIBlockElement::SetPropertyValueCode($idElement, "FILES", $files);

        if(CModule::IncludeModule("iblock"))
        {
            $res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 21, "ID" => $idElement), false, false, Array("PROPERTY_FILES"));
        }
        while ($item = $res->fetch())
        {
            $files_to_email[] = CFile::GetByID($item["PROPERTY_FILES_VALUE"])->arResult[0];
        }

        if ($files_to_email){
            $post["HTML_FILE_LINKS"] = "Файлы: <br>";
            foreach ($files_to_email as $val) {
                $post["HTML_FILE_LINKS"] .= "<a href='https://mk-27.ru/".$val["SRC"]."'>".$val["ORIGINAL_NAME"]."</a><br>";
            }
        }
        
        $send = CEvent::Send("CLAIMS_AND_APPEALS", "s1", $post);
        
    }
}

?>