<?php 
/*
AddEventHandler("main", "OnBeforeUserRegister", "OnBeforeUserRegisterFunction");
function OnBeforeUserRegisterFunction(&$arFields)
{
    // Перед регистрацией говорим, что email тот же, что и логин;
    $arFields["EMAIL"] = $arFields["LOGIN"];
    
    // А если введен TITLE, то это бот;
    if ($arFields["TITLE"])
    {
        return false;
    }
}
*/

?>