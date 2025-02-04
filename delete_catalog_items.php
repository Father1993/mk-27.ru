<?php
// Увеличиваем время выполнения скрипта
set_time_limit(0); // 0 = без ограничений
ini_set('max_execution_time', 0);
ignore_user_abort(true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Удаление товаров и категорий каталога");

// Проверка прав доступа
if (!$USER->IsAdmin()) {
    ShowError("Доступ запрещен. Требуются права администратора.");
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
    die();
}

use Bitrix\Main\Loader;
use Bitrix\Iblock\ElementTable;
use Bitrix\Iblock\SectionTable;

Loader::includeModule('iblock');

$IBLOCK_ID = 13; // ID инфоблока каталога
$BATCH_SIZE = 500; // Возвращаем к 100 для стабильности
$startFrom = isset($_GET['startFrom']) ? (int)$_GET['startFrom'] : 0;
$mode = isset($_GET['mode']) ? $_GET['mode'] : (isset($_POST['mode']) ? $_POST['mode'] : 'elements');

// Получаем общее количество элементов и разделов
$totalElements = CIBlockElement::GetList(
    array(),
    array("IBLOCK_ID" => $IBLOCK_ID),
    array(),
    false,
    array("ID")
);

$totalSections = CIBlockSection::GetList(
    array(),
    array("IBLOCK_ID" => $IBLOCK_ID),
    false,
    array("ID"),
    false
)->SelectedRowsCount();

if (isset($_POST['start_deletion']) || isset($_GET['startFrom'])) {
    if ($mode == 'elements') {
        // Удаление элементов
        $rsElements = CIBlockElement::GetList(
            array("ID" => "ASC"),
            array("IBLOCK_ID" => $IBLOCK_ID),
            false,
            array("nPageSize" => $BATCH_SIZE, "iNumPage" => ($startFrom / $BATCH_SIZE) + 1),
            array("ID")
        );

        $processedCount = 0;
        while($element = $rsElements->Fetch()) {
            CIBlockElement::Delete($element['ID']);
            $processedCount++;
        }

        $nextStartFrom = $startFrom + $processedCount;
        $progress = min(100, round(($nextStartFrom / $totalElements) * 100, 1));

        if ($processedCount < $BATCH_SIZE || $nextStartFrom >= $totalElements) {
            // Переходим к удалению разделов
            echo '<div class="alert alert-success">
                Все товары удалены. Переходим к удалению категорий...
            </div>';
            ?>
<script>
setTimeout(function() {
  window.location.href = "<?= $APPLICATION->GetCurPage() ?>?mode=sections&startFrom=0";
}, 1000);
</script>
<?php
        } else {
            echo '<div class="alert alert-info">
                Удаление товаров: обработано ' . $nextStartFrom . ' из ' . $totalElements . ' элементов (' . $progress . '%)
                <div class="progress mt-2">
                    <div class="progress-bar" role="progressbar" style="width: ' . $progress . '%" 
                         aria-valuenow="' . $progress . '" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>';
            ?>
<script>
setTimeout(function() {
  window.location.href = "<?= $APPLICATION->GetCurPage() ?>?mode=elements&startFrom=<?= $nextStartFrom ?>";
}, 1000);
</script>
<?php
        }
    } else {
        // Удаление разделов
        $rsSections = CIBlockSection::GetList(
            array("LEFT_MARGIN" => "DESC"), // Удаляем с самого нижнего уровня
            array("IBLOCK_ID" => $IBLOCK_ID),
            false,
            array("ID"),
            array("nPageSize" => $BATCH_SIZE, "iNumPage" => ($startFrom / $BATCH_SIZE) + 1)
        );

        $processedCount = 0;
        while($section = $rsSections->Fetch()) {
            CIBlockSection::Delete($section['ID']);
            $processedCount++;
        }

        $nextStartFrom = $startFrom + $processedCount;
        $progress = min(100, round(($nextStartFrom / $totalSections) * 100, 1));

        if ($processedCount < $BATCH_SIZE || $nextStartFrom >= $totalSections) {
            echo '<div class="alert alert-success">
                Операция успешно завершена! Все товары и категории удалены.<br>
                Теперь можно начинать синхронизацию с 1С.
            </div>';
        } else {
            echo '<div class="alert alert-info">
                Удаление категорий: обработано ' . $nextStartFrom . ' из ' . $totalSections . ' разделов (' . $progress . '%)
                <div class="progress mt-2">
                    <div class="progress-bar" role="progressbar" style="width: ' . $progress . '%" 
                         aria-valuenow="' . $progress . '" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>';
            ?>
<script>
setTimeout(function() {
  window.location.href = "<?= $APPLICATION->GetCurPage() ?>?mode=sections&startFrom=<?= $nextStartFrom ?>";
}, 1000);
</script>
<?php
        }
    }
} else {
    ?>
<div class="alert alert-warning">
  <strong>Внимание!</strong> Эта операция удалит все товары и категории из каталога с ID=<?= $IBLOCK_ID ?>.<br>
  Всего элементов для удаления: <?= $totalElements ?><br>
  Всего категорий для удаления: <?= $totalSections ?><br>
  <strong>Операция необратима!</strong> Убедитесь, что:
  <ul>
    <li>У вас есть резервная копия базы данных</li>
    <li>Синхронизация с 1С настроена корректно</li>
    <li>Все необходимые данные сохранены</li>
  </ul>
</div>

<form method="post"
  onsubmit="return confirm('Вы уверены, что хотите удалить все товары и категории? Эта операция необратима!');">
  <input type="hidden" name="mode" value="elements">
  <button type="submit" name="start_deletion" class="btn btn-danger">
    Начать удаление каталога
  </button>
</form>
<?php
}

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>