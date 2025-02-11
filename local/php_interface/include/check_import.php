<?php
// Функция проверки статуса импорта
function checkImportStatus()
{
    // Определяем директорию для логов
    $logDir = $_SERVER["DOCUMENT_ROOT"]."/ADEV";
    
    // Создаем директорию если её нет
    if (!file_exists($logDir)) {
        mkdir($logDir, 0777, true);
    }
    
    $logFile = $logDir."/after_log.txt";
    $errorFile = $logDir."/import_errors.txt";
    
    if (file_exists($logFile)) {
        $log = file_get_contents($logFile);
        if (strpos($log, "Ошибка") !== false) {
            $errors = "Дата: " . date('Y-m-d H:i:s') . "\n";
            $errors .= "Найдены ошибки в процессе импорта:\n";
            $errors .= $log;
            $errors .= "-------------------\n";
            file_put_contents($errorFile, $errors, FILE_APPEND);
            
            // Отправка уведомления администратору
            CEvent::Send(
                "IMPORT_1C_ERROR",
                SITE_ID,
                array(
                    "ERROR_TEXT" => $errors
                )
            );
        }
    }
}

// Запускаем проверку после каждого импорта
AddEventHandler("catalog", "OnSuccessCatalogImport1C", "checkImportStatus");ffffffffffffffffffffffffffffffffffffff