<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("RELINK");
?>

<?php

$IBLOCK_ID = 13; // 13
$SECTION_ID = 0;

$connection = Bitrix\Main\Application::getConnection();
$sqlHelper = $connection->getSqlHelper();


$sql = "
SELECT
    p.product_id, d.name, p.sku, l.keyword
FROM
    oc_product p
LEFT JOIN oc_seo_url l ON l.query = concat('product_id=',p.product_id)
LEFT JOIN oc_product_description d ON d.product_id = p.product_id
";
//53362 // 125 SDR11
$recordset = $connection->query($sql);
while ($record = $recordset->fetch())
{
    $record["name"] = trim(str_replace(" ", " ", preg_replace('/\s+/', ' ', $record["name"])));
    $record["keyword"] = trim(str_replace(" ", "", preg_replace('/\s+/', '', $record["keyword"])));
    
    //if (isset($record["sku"]) && ($record["sku"] != ""))
    //    $links_by_sku[$record["sku"]] = $record["keyword"];
    //else {
        $links_by_name[$record["name"]] = $record["keyword"];
    //}
}


//pprint ($links_by_sku);
//pprint ($links_by_name);

$arSelect = Array("ID", "NAME", "CODE", "PROPERTY_CML2_ARTICLE");
$arFilter = Array("IBLOCK_ID" => $IBLOCK_ID, "SECTION_ID" => $SECTION_ID, "INCLUDE_SUBSECTIONS" => "Y", "DEPTH_LEVEL" => 5);

$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);

while ($item = $res->GetNext()) {
    

    if (isset($links_by_name[$item["NAME"]])
    &&
    $links_by_name[$item["NAME"]] != ""
    &&
    $links_by_name[$item["NAME"]] != $item["CODE"]) {
        $new_links[$item["ID"]] = $links_by_name[$item["NAME"]];
    } else {
        $not_changes[$item["ID"]]["NAME"] = $item["NAME"];
        $not_changes[$item["ID"]]["CODE"] = $item["CODE"];
        $not_changes[$item["ID"]]["ARTICLE"] = $item["PROPERTY_CML2_ARTICLE_VALUE"];
    }
}

pprint ("Товары: Не изменялись");
//pprint ($not_changes);

//pprint (substr($not_changes["CODE"], -2));
$i = 0;
foreach ($not_changes as $val) {
    $num = (substr($val["CODE"], -2));
    if (!is_numeric($num)) {
        pprint ($val["CODE"]);
        $i++;
    }
}
pprint ($i);
/*
pprint ("Товары: Новые ссылки");
pprint ($new_links);
*/
$el = new CIBlockElement;
foreach ($new_links as $key => $val) {
    //$res = $el->Update($key, Array("CODE"=> $val));
}

     
// CATEGORIES
/*
$sql = "
SELECT
    cd.name, l.keyword
FROM
    oc_category_description cd
LEFT JOIN oc_seo_url l ON l.query = concat('category_id=',cd.category_id)
";

$recordset = $connection->query($sql);
while ($record = $recordset->fetch())
{
    if (!isset($links_categories[$record["name"]])) {
        $links_categories[$record["name"]] = $record["keyword"];
    }
    else {
        $links_categories_2[$record["name"]][] = $record["keyword"];
    }
}

foreach ($links_categories_2 as $key => $val) {
    unset ($links_categories["$key"]);
}

//pprint ($links_categories_2);
//pprint ($links_categories);

$rsParentSection = CIBlockSection::GetByID($SECTION_ID);
if ($arParentSection = $rsParentSection->GetNext())
{
    $arFilter = array('IBLOCK_ID' => $arParentSection['IBLOCK_ID'],'>LEFT_MARGIN' => $arParentSection['LEFT_MARGIN'],'<RIGHT_MARGIN' => $arParentSection['RIGHT_MARGIN'],'>DEPTH_LEVEL' => $arParentSection['DEPTH_LEVEL']); // выберет потомков без учета активности
    $rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'),$arFilter);
    while ($arSect = $rsSect->GetNext())
    {
        
        if (isset($links_categories[$arSect["NAME"]])) {
            $new_links_categories[$arSect["ID"]] = $links_categories[$arSect["NAME"]];
        } else {
            $not_changes_categories[$arSect["ID"]]["NAME"] = $arSect["NAME"];
            $not_changes_categories[$arSect["ID"]]["CODE"] = $arSect["CODE"];
        }
    }
}

pprint ("Категории: Новые ссылки");
pprint ($new_links_categories);

$bs = new CIBlockSection;

foreach ($new_links_categories as $key => $val) {
    $res = $bs->Update($key, array("CODE" => $val));
}

pprint ("Категории: Не изменялись");
pprint ($not_changes_categories);
*/
?>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>