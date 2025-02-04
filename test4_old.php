<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("ТЕСТ ЧЕТЫРЕ");
?>


<?php 

// GetList
if(CModule::IncludeModule("iblock"))
{
    $res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 13, "ID" => $post["id"], "ACTIVE" => "N"), false, false, Array("ID", "ACTIVE"));
}

while ($arItem = $res->fetch())
{
    
    pprint ($arItem);
}


?>

<?php 

/*

 - «С этим товаром покупают». Нужна доработка стандартной выгрузки 1С-Битрикс.
На строне 1С к категориям добавлено свойство "сопутствующий товар", где указывают сопутствующие категории.
Нужно модифицировать стандантный компенент импрота, получать данные, записывать в доп. свойство разделов или товаров.
И на основании этих данных выводить товары на детальной странице товара.

 - Печать в типографии.
Требуется генерировать PDF изображения для печати в типографии (примеры дизайна запрашивать у них) на основании выбранных товарных позиций (любых с сайта).
Получить дизайн, согласовать, написать программу.

 - Изменить поиск.
Требуется разместить поисковое поле в шапке сайта, без перехода на отдельную страницу.

 - Передача информации о действиях клиентов в Яндекс через JS API.
https://yandex.ru/promo/metrica/ecom

 - Подключить отчеты группы «Звонки» в Яндекс метрике.

- Страница "О нас".
Сделать "Конфетку".

 - Маркетплейс Яндекс.Маркет.
Что уже сделано и работает:
Ежедневно, после выгрузки, запускается файл recalculation_menu.php (раньше использовался только для меню, можно переименовать, но не забыть изменить имя файла в cron).
Который приводит все новые картинки к формату 900 x 1200, при необходимости обрабатывает через нейросеть (увеличивает картинки с улучшением качества).
2 формата. .webp в детальной картинке (на сайт) и .jpeg в анонсовой картинке (для маркетплейсов).
Для всех разделов меню 1 и 2 уровня вручную прописаны ID категории Яндекса.
Посмотреть список разделов можно в файле categories_text.php.
Также во время выполнения recalculation_menu.php идёт присвоение ID категории Яндекса для всех категорий (не только 1-2 уровня). И для всех товаров в этих категориях.
Далее формируется фид через 1С-Битрикс - "Маркет для продавцов".
Пока в него выгружается только 1 категория для тестов.
Ещё стоит учитывать, что для маркетплейсов используем отдельные цены из выгрузки. Округлённые до единицы.
Что не сделано:
Далее требуется пройти модерацию от Яндекса.
Пример ошибки: в названии товара нельзя указывать слово "Акция".
В данный момент сделали новое поле в 1С, "Наименование для сайта".

 - Маркетплейс Авито.
Для Авито требуется больше связок:
Категория Авито
Avito GoodsSubType
Avito PlumbingType
Для разделов и товаров.
Обработки есть в recalculation_menu.php, но в данный момент закомментированы.

 - Личный кабинет для юридических лиц.
Требуется авторизация на сайте для юридических лиц.
Регистрация по ИНН. Желательно подтягивать из интернета другие данные о компании по ИНН, если возможно.
Должны быть видны остатки про выставлении счета. 
Формировать счет на оплату и договор купли-продажи, на основании данных клиента.
Использовать оптовые цены.
Также необходимо отслеживать статусы заказов, передавать их на почту клиентам и отображать в личном кабинете.

 - Создать статью о компании на Википедии.

 - При получении писем с доменных email-адресов не отображается аватарка.



---







*/

?>

<?php 
/*
global $USER;
if (!$USER) $USER = new CUser();
if ($USER->isAdmin() && $USER->GetID() == 1)
{
    if(CModule::IncludeModule("iblock"))
    {
        $res = CIBlockElement::GetList(Array(), Array("IBLOCK_ID" => 13, "INCLUDE_SUBSECTIONS" => "Y"), false, false, Array("ID", "IBLOCK_ID", "NAME", "DETAIL_PICTURE", "PREVIEW_PICTURE", "PROPERTY_PHOTO_EXTERNAL_ID"));
    }
    while ($item = $res->fetch())
    {
        $arItems[$item["ID"]]["FILE"] = CFile::GetByID($item["DETAIL_PICTURE"])->arResult[0];
        $arItems[$item["ID"]]["PREVIEW_FILE"] = CFile::GetByID($item["PREVIEW_PICTURE"])->arResult[0];
        $arItems[$item["ID"]]["PROPERTY_PHOTO_EXTERNAL_ID"] = $item["PROPERTY_PHOTO_EXTERNAL_ID_VALUE"];
        $arItems[$item["ID"]]["IBLOCK_ID"] = $item["IBLOCK_ID"];
        $arItems[$item["ID"]]["NAME"] = $item["NAME"];
    }
    
    $n = 0;
    $i = 0;
    $k = 0;
    
    pprint (count($arItems));
    
    foreach ($arItems as $key => $val) {
        $width = 900;
        $height = 1200;
        
        $n++;
        
        if (!empty($val["FILE"])) {
            
            if (($val["FILE"]["WIDTH"] != $width) || ($val["FILE"]["HEIGHT"] != $height)) {
                $i++;
                
                $min_resolution = min([$val["FILE"]["WIDTH"], $val["FILE"]["HEIGHT"]]);

                if     ($min_resolution < 300) $scale = 8;
                elseif ($min_resolution < 400) $scale = 4;
                elseif ($min_resolution < 600) $scale = 3;
                elseif ($min_resolution < 900) $scale = 2;
                else                           $scale = 1;

                $path = $_SERVER["DOCUMENT_ROOT"] . $val["FILE"]["SRC"];
                
                if ($scale > 1) {
                    $k++;
                    $result = system("python/venv/bin/python3 python/resize.py '$path' '$scale'");
                }
                
                $im = imagecreatetruecolor($width, $height);
                $back = imagecolorallocate($im, 255, 255, 255);
                imagefilledrectangle($im, 0, 0, $width, $height, $back);
                
                if (exif_imagetype($path) == 1)  $src = imageCreateFromGif($path);
                if (exif_imagetype($path) == 2)  $src = imageCreateFromJpeg($path);
                if (exif_imagetype($path) == 3)  $src = imageCreateFromPng($path);
                if (exif_imagetype($path) == 18) $src = imageCreateFromWebp($path);
                
                list($width_orig, $height_orig) = getimagesize($path);
                
                $ratio_orig = $width_orig / $height_orig;
                
                if ($width / $height > $ratio_orig) {
                    $width = $height * $ratio_orig;
                } else {
                    $height = $width / $ratio_orig;
                }
                
                $im_x = ((900 - $width) / 2);
                $im_y = ((1200 - $height) / 2);
                
                imagecopyresampled($im, $src, $im_x, $im_y, 0, 0, $width, $height, $width_orig, $height_orig);
                
                imagewebp($im, $_SERVER["DOCUMENT_ROOT"] . "/upload/temp.webp");
                imagedestroy($im);
                
                $file = CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"] . "/upload/temp.webp");
                
                $el = new CIBlockElement;
                $el->Update($key, array("DETAIL_PICTURE" => $file));
                if (empty($val["PROPERTY_PHOTO_EXTERNAL_ID"])) {
                    CIBlockElement::SetPropertyValuesEx($key, $val["IBLOCK_ID"], array("PHOTO_EXTERNAL_ID" => $val["FILE"]["EXTERNAL_ID"]));
                }
                
                $im = imagecreatefromwebp($_SERVER["DOCUMENT_ROOT"] . "/upload/temp.webp");
                imagejpeg($im, $_SERVER["DOCUMENT_ROOT"] . "/upload/temp.jpeg", 100);
                imagedestroy($im);
                
                $file = CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"] . "/upload/temp.jpeg");
                
                $el = new CIBlockElement;
                $el->Update($key, array("PREVIEW_PICTURE" => $file));
                
                pprint ($val);
                
            }
            
        }
        
        if ((!$val["PREVIEW_FILE"]) || (($val["PREVIEW_FILE"]["WIDTH"] != $width) || ($val["PREVIEW_FILE"]["HEIGHT"] != $height))) {
            if ($val["FILE"]) {
                
                $im = imagecreatefromwebp($_SERVER["DOCUMENT_ROOT"] . $val["FILE"]["SRC"]);
                imagejpeg($im, $_SERVER["DOCUMENT_ROOT"] . "/upload/temp.jpeg", 100);
                imagedestroy($im);
                
                $file = CFile::MakeFileArray($_SERVER["DOCUMENT_ROOT"] . "/upload/temp.jpeg");
                
                $el = new CIBlockElement;
                $el->Update($key, array("PREVIEW_PICTURE" => $file));
            }
        }
        
        if ($k >= 3) break;
        if ($i >= 3) break;
        
        
    }
    
    pprint ("n: " . $n);
    pprint ("i: " . $i);
    pprint ("k: " . $k);
    
}
*/
?>


<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>