<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Тест обработки изображений");
?>

<h2>Тест обработки изображений с помощью Python</h2>

<?php
// Проверяем, был ли отправлен файл
if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    // Путь для сохранения загруженного изображения
    $upload_dir = $_SERVER["DOCUMENT_ROOT"] . "/upload/test_images/";
    
    // Создаем директорию, если она не существует
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }
    
    // Генерируем уникальное имя файла
    $filename = uniqid() . "_" . $_FILES['image']['name'];
    $filepath = $upload_dir . $filename;
    
    // Сохраняем загруженное изображение
    if(move_uploaded_file($_FILES['image']['tmp_name'], $filepath)) {
        echo "<p>Изображение успешно загружено.</p>";
        
        // Получаем размеры изображения до обработки
        list($width_before, $height_before) = getimagesize($filepath);
        echo "<p>Размеры до обработки: {$width_before}x{$height_before}</p>";
        
        // Выбранный масштаб
        $scale = $_POST['scale'];
        
        // Запускаем Python-скрипт для обработки изображения
        $python_path = $_SERVER["DOCUMENT_ROOT"] . "/python/venv/bin/python3";
        $script_path = $_SERVER["DOCUMENT_ROOT"] . "/python/resize.py";
        
        $command = escapeshellcmd("$python_path $script_path '$filepath' '$scale'");
        $output = [];
        $return_var = 0;
        
        echo "<p>Выполняем команду: $command</p>";
        
        exec($command, $output, $return_var);
        
        if($return_var === 0) {
            echo "<p>Изображение успешно обработано.</p>";
            
            // Получаем размеры изображения после обработки
            list($width_after, $height_after) = getimagesize($filepath);
            echo "<p>Размеры после обработки: {$width_after}x{$height_after}</p>";
            
            // Выводим изображение
            $web_path = "/upload/test_images/" . $filename;
            echo "<div style='margin-top: 20px;'>";
            echo "<h3>Результат обработки:</h3>";
            echo "<img src='$web_path' style='max-width: 100%; height: auto;'>";
            echo "</div>";
        } else {
            echo "<p>Ошибка при обработке изображения. Код возврата: $return_var</p>";
            echo "<p>Вывод команды:</p>";
            echo "<pre>" . implode("\n", $output) . "</pre>";
        }
    } else {
        echo "<p>Ошибка при загрузке изображения.</p>";
    }
}
?>

<form method="post" enctype="multipart/form-data" style="margin-top: 20px;">
  <div style="margin-bottom: 10px;">
    <label for="image">Выберите изображение:</label>
    <input type="file" name="image" id="image" required>
  </div>

  <div style="margin-bottom: 10px;">
    <label for="scale">Выберите масштаб:</label>
    <select name="scale" id="scale">
      <option value="2">2x (FSRCNN_x2)</option>
      <option value="3">3x (FSRCNN_x3)</option>
      <option value="4">4x (FSRCNN_x4)</option>
      <option value="8">8x (LapSRN_x8)</option>
    </select>
  </div>

  <button type="submit">Обработать изображение</button>
</form>

<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>