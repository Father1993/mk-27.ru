<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php"); ?>
<?php 

if ($_GET["code"] == "fa6a09a5396ec03b7a19bf09f6a49b94") {
    
    $filter_xml_id = $_GET["xml_id"];
    
    if(CModule::IncludeModule("iblock"))
    {
        $res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 13, "XML_ID" => $filter_xml_id), false, false, Array("ID", "XML_ID", "DETAIL_PICTURE"));
    }
    while ($arItem = $res->fetch())
    {
        $arResult[$arItem["ID"]]["XML_ID"] =  $arItem["XML_ID"];
        $arResult[$arItem["ID"]]["IMAGE_LINK"] =  "https://mk-27.ru" . CFile::GetPath($arItem["DETAIL_PICTURE"]);
    }
    
    $arResult = array_values($arResult); // Сбрасываем ключи массива
    $arResult = json_encode($arResult, JSON_UNESCAPED_UNICODE); // Кодируем в JSON
    
    echo $arResult;
    
}

?>