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
        
        // Определяем минимальное разрешение для выбора масштаба (как в recalculation_menu.php)
        $min_resolution = min([$width_before, $height_before]);
        
        echo "<p>Минимальное разрешение: {$min_resolution}</p>";
        
        // Автоматически определяем масштаб по размеру изображения (как в recalculation_menu.php)
        if ($min_resolution <= 300) $auto_scale = 8;
        elseif ($min_resolution <= 400) $auto_scale = 4;
        elseif ($min_resolution <= 600) $auto_scale = 3;
        elseif ($min_resolution < 900) $auto_scale = 2;
        else $auto_scale = 1;
        
        echo "<p>Автоматически определенный масштаб: {$auto_scale}x</p>";
        
        // Используем выбранный пользователем масштаб для тестирования
        $scale_to_use = $_POST['scale'];
        echo "<p>Используемый масштаб для теста: {$scale_to_use}x</p>";
        
        // Запускаем Python-скрипт для обработки изображения точно так же, как в recalculation_menu.php
        $path = $filepath; // В recalculation_menu.php используется переменная $path
        
        // Сохраняем текущую директорию
        $current_dir = getcwd();
        
        // Переходим в корневую директорию сайта
        chdir($_SERVER["DOCUMENT_ROOT"]);
        
        // Формируем команду точно так же, как в recalculation_menu.php
        $command = "python/venv/bin/python3 python/resize.py '$path' '$scale_to_use'";
        
        echo "<p>Выполняем команду: $command</p>";
        
        // Выполняем команду и получаем результат
        $output = [];
        $return_var = 0;
        
        // Используем exec для получения вывода и кода возврата
        exec($command, $output, $return_var);
        
        // Возвращаемся в исходную директорию
        chdir($current_dir);
        
        if($return_var === 0) {
            echo "<p style='color: green; font-weight: bold;'>Изображение успешно обработано.</p>";
            
            if (!empty($output)) {
                echo "<p>Вывод команды:</p>";
                echo "<pre>" . implode("\n", $output) . "</pre>";
            }
            
            // Получаем размеры изображения после обработки
            list($width_after, $height_after) = getimagesize($filepath);
            echo "<p>Размеры после обработки: {$width_after}x{$height_after}</p>";
            
            // Выводим изображение
            $web_path = "/upload/test_images/" . $filename;
            echo "<div style='margin-top: 20px;'>";
            echo "<h3>Результат обработки:</h3>";
            echo "<img src='$web_path' style='max-width: 100%; height: auto;'>";
            echo "</div>";
            
            // Проверяем, что размеры изменились в соответствии с масштабом
            $expected_width = $width_before * $scale_to_use;
            $expected_height = $height_before * $scale_to_use;
            
            echo "<p>Ожидаемые размеры (при масштабе {$scale_to_use}x): {$expected_width}x{$expected_height}</p>";
            
            if (abs($width_after - $expected_width) <= 2 && abs($height_after - $expected_height) <= 2) {
                echo "<p style='color: green; font-weight: bold;'>Размеры соответствуют ожидаемым! Python-скрипт работает корректно.</p>";
            } else {
                echo "<p style='color: orange; font-weight: bold;'>Размеры не соответствуют ожидаемым. Возможно, используется другой масштаб или алгоритм.</p>";
            }
        } else {
            echo "<p style='color: red; font-weight: bold;'>Ошибка при обработке изображения. Код возврата: $return_var</p>";
            
            if (!empty($output)) {
                echo "<p>Вывод команды:</p>";
                echo "<pre>" . implode("\n", $output) . "</pre>";
            }
            
            // Проверяем наличие лог-файла
            $log_file = $_SERVER["DOCUMENT_ROOT"] . "/python/resize_debug.log";
            if(file_exists($log_file)) {
                echo "<p>Содержимое лог-файла (если есть):</p>";
                echo "<pre>" . file_get_contents($log_file) . "</pre>";
            }
            
            // Проверяем права доступа
            echo "<p>Проверка прав доступа:</p>";
            echo "<pre>";
            echo "Права на файл изображения: " . substr(sprintf('%o', fileperms($filepath)), -4) . "\n";
            echo "ID владельца файла изображения: " . fileowner($filepath) . "\n";
            echo "Права на директорию python: " . substr(sprintf('%o', fileperms($_SERVER["DOCUMENT_ROOT"] . "/python")), -4) . "\n";
            echo "Права на скрипт resize.py: " . substr(sprintf('%o', fileperms($_SERVER["DOCUMENT_ROOT"] . "/python/resize.py")), -4) . "\n";
            echo "Права на директорию model: " . substr(sprintf('%o', fileperms($_SERVER["DOCUMENT_ROOT"] . "/python/model")), -4) . "\n";
            
            // Проверяем наличие моделей
            echo "\nПроверка наличия моделей:\n";
            if(file_exists($_SERVER["DOCUMENT_ROOT"] . "/python/model/FSRCNN_x2.pb")) {
                echo "Модель FSRCNN_x2.pb найдена\n";
            } else {
                echo "Модель FSRCNN_x2.pb НЕ найдена\n";
            }
            
            if(file_exists($_SERVER["DOCUMENT_ROOT"] . "/python/model/FSRCNN_x3.pb")) {
                echo "Модель FSRCNN_x3.pb найдена\n";
            } else {
                echo "Модель FSRCNN_x3.pb НЕ найдена\n";
            }
            
            if(file_exists($_SERVER["DOCUMENT_ROOT"] . "/python/model/FSRCNN_x4.pb")) {
                echo "Модель FSRCNN_x4.pb найдена\n";
            } else {
                echo "Модель FSRCNN_x4.pb НЕ найдена\n";
            }
            
            if(file_exists($_SERVER["DOCUMENT_ROOT"] . "/python/model/LapSRN_x8.pb")) {
                echo "Модель LapSRN_x8.pb найдена\n";
            } else {
                echo "Модель LapSRN_x8.pb НЕ найдена\n";
            }
            echo "</pre>";
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

<div style="margin-top: 30px;">
  <h3>Информация о системе:</h3>
  <pre>
<?php
echo "Текущая директория: " . getcwd() . "\n";
echo "Корневая директория сайта: " . $_SERVER["DOCUMENT_ROOT"] . "\n";
echo "PHP версия: " . phpversion() . "\n";

// Проверяем наличие Python
system("which python3", $python_exists);
if ($python_exists === 0) {
    echo "Python3 найден: ";
    system("python3 --version");
} else {
    echo "Python3 не найден\n";
}

// Проверяем наличие виртуального окружения
if (file_exists($_SERVER["DOCUMENT_ROOT"] . "/python/venv/bin/python3")) {
    echo "Виртуальное окружение найдено\n";
    echo "Содержимое директории python:\n";
    system("ls -la " . $_SERVER["DOCUMENT_ROOT"] . "/python");
    
    echo "\nСодержимое директории model:\n";
    system("ls -la " . $_SERVER["DOCUMENT_ROOT"] . "/python/model");
} else {
    echo "Виртуальное окружение не найдено\n";
}

// Проверяем текущий скрипт resize.py
echo "\nСодержимое скрипта resize.py:\n";
$resize_script = file_get_contents($_SERVER["DOCUMENT_ROOT"] . "/python/resize.py");
echo htmlspecialchars($resize_script);
?>
  </pre>
</div>

<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>