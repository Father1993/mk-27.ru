<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Удаление фотографий каталога");

// Проверка прав доступа
if (!$USER->IsAdmin()) {
    ShowError("Доступ запрещен. Требуются права администратора.");
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
    die();
}

use Bitrix\Main\Loader;
use Bitrix\Iblock\ElementTable;

Loader::includeModule('iblock');

$IBLOCK_ID = 13; // ID вашего инфоблока
$BATCH_SIZE = 500; // Количество элементов для обработки за один шаг
$startFrom = isset($_GET['startFrom']) ? (int)$_GET['startFrom'] : 0;

// Получаем общее количество элементов
$totalElements = CIBlockElement::GetList(
    array(),
    array("IBLOCK_ID" => $IBLOCK_ID),
    array(),
    false,
    array("ID")
);

if (isset($_POST['start_deletion']) || isset($_GET['startFrom'])) {
    // Получение элементов инфоблока
    $rsElements = CIBlockElement::GetList(
        array("ID" => "ASC"),
        array("IBLOCK_ID" => $IBLOCK_ID),
        false,
        array("nPageSize" => $BATCH_SIZE, "iNumPage" => ($startFrom / $BATCH_SIZE) + 1),
        array("ID")
    );

    $el = new CIBlockElement;
    $processedCount = 0;
    
    // Массив для очистки MORE_PHOTO
    $Del_More_Photos = array(
        0 => array(
            'VALUE' => '',
            'DESCRIPTION' => ''
        )
    );

    while($element = $rsElements->Fetch()) {
        // Очищаем PREVIEW_PICTURE и DETAIL_PICTURE
        $el->Update(
            $element['ID'],
            array(
                'PREVIEW_PICTURE' => array('del' => 'Y'),
                'DETAIL_PICTURE' => array('del' => 'Y')
            )
        );
        
        // Очищаем свойство MORE_PHOTO
        CIBlockElement::SetPropertyValuesEx(
            $element['ID'],
            $IBLOCK_ID,
            array('MORE_PHOTO' => $Del_More_Photos)
        );
        
        $processedCount++;
    }

    $nextStartFrom = $startFrom + $processedCount;
    $progress = min(100, round(($nextStartFrom / $totalElements) * 100, 1));

    if ($processedCount < $BATCH_SIZE || $nextStartFrom >= $totalElements) {
        echo '<div class="alert alert-success">Операция успешно завершена! Все фотографии удалены.</div>';
    } else {
        echo '<div class="alert alert-info">
            Обработано ' . $nextStartFrom . ' из ' . $totalElements . ' элементов (' . $progress . '%)
            <div class="progress mt-2">
                <div class="progress-bar" role="progressbar" style="width: ' . $progress . '%" 
                     aria-valuenow="' . $progress . '" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>';
        ?>
<script>
setTimeout(function() {
  window.location.href = "<?= $APPLICATION->GetCurPage() ?>?startFrom=<?= $nextStartFrom ?>";
}, 1000);
</script>
<?php
    }
} else {
    ?>
<div class="alert alert-warning">
  <strong>Внимание!</strong> Эта операция удалит все фотографии (анонс, детальную и дополнительные)
  у товаров в каталоге с ID=<?= $IBLOCK_ID ?>.<br>
  Всего элементов для обработки: <?= $totalElements ?><br>
  Операция необратима! Убедитесь, что у вас есть резервная копия базы данных.
</div>

<form method="post" onsubmit="return confirm('Вы уверены, что хотите удалить все фотографии?');">
  <button type="submit" name="start_deletion" class="btn btn-danger">
    Начать удаление фотографий
  </button>
</form>
<?php
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>