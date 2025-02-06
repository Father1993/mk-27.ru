<?php
// Функция проверки статуса импорта
function checkImportStatus()
{
    $logFile = $_SERVER["DOCUMENT_ROOT"]."/local/logs/import_1c.log";
    $errorFile = $_SERVER["DOCUMENT_ROOT"]."/local/logs/import_1c_errors.log";
    
    if (file_exists($logFile)) {
        $log = file_get_contents($logFile);
        if (strpos($log, "Ошибка") !== false) {
            $errors = "Найдены ошибки в процессе импорта:\n";
            $errors .= $log;
            file_put_contents($errorFile, $errors);
            
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
AddEventHandler("catalog", "OnSuccessCatalogImport1C", "checkImportStatus");