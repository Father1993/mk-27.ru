<?php
namespace Local\Exchange;

/**
 * Класс для просмотра логов обмена с 1С
 */
class LogViewer
{
    private $logDir;
    private $detailedLogFile;
    private $mainLogFile;
    
    /**
     * Конструктор класса
     */
    public function __construct()
    {
        $this->logDir = $_SERVER["DOCUMENT_ROOT"] . '/upload/1c_exchange_logs';
        $this->detailedLogFile = $this->logDir . '/1c_exchange_detailed.log';
        $this->mainLogFile = $this->logDir . '/1c_exchange_main.log';
    }
    
    /**
     * Получает список всех лог-файлов
     * 
     * Для совместимости с предыдущей версией возвращает список записей из основного лога
     * как если бы это были отдельные файлы
     */
    public function getLogFiles()
    {
        $logFiles = [];
        
        // Проверяем существование основного лога
        if (file_exists($this->mainLogFile)) {
            $mainLogEntries = $this->getMainLog();
            
            foreach ($mainLogEntries as $entry) {
                $logFiles[] = [
                    'name' => 'request_' . $entry['request_id'] . '.log',
                    'path' => $this->detailedLogFile,
                    'size' => $this->formatBytes(filesize($this->detailedLogFile)),
                    'date' => $entry['date'],
                    'timestamp' => strtotime($entry['date']),
                    'request_id' => $entry['request_id'],
                    'type' => $entry['type'] ?? '',
                    'mode' => $entry['mode'] ?? '',
                    'errors' => $entry['errors'] ?? 0
                ];
            }
        }
        
        return $logFiles;
    }
    
    /**
     * Получает содержимое основного лог-файла с общей информацией
     */
    public function getMainLog()
    {
        $entries = [];
        
        if (file_exists($this->mainLogFile)) {
            $content = file_get_contents($this->mainLogFile);
            $lines = explode("\n", $content);
            
            foreach ($lines as $line) {
                if (empty($line)) {
                    continue;
                }
                
                $entry = json_decode($line, true);
                if ($entry) {
                    $entries[] = $entry;
                }
            }
            
            // Сортировка записей по дате (сначала новые)
            usort($entries, function($a, $b) {
                $dateA = strtotime($a['date']);
                $dateB = strtotime($b['date']);
                return $dateB - $dateA;
            });
        }
        
        return $entries;
    }
    
    /**
     * Получает содержимое лога для конкретного запроса
     * 
     * @param string $requestId ID запроса
     * @return string
     */
    public function getRequestLog($requestId)
    {
        $content = '';
        
        if (file_exists($this->detailedLogFile)) {
            $fullContent = file_get_contents($this->detailedLogFile);
            
            // Ищем начало запроса
            $startMarker = "НОВЫЙ ЗАПРОС: " . $requestId;
            $endMarker = "КОНЕЦ ЗАПРОСА: " . $requestId;
            
            $startPos = strpos($fullContent, $startMarker);
            if ($startPos !== false) {
                // Находим позицию начала запроса (начало строки с маркером)
                $lineStart = strrpos(substr($fullContent, 0, $startPos), "\n");
                if ($lineStart === false) {
                    $lineStart = 0;
                }
                
                // Находим конец запроса
                $endPos = strpos($fullContent, $endMarker, $startPos);
                if ($endPos !== false) {
                    // Находим конец блока (конец строки с маркером окончания)
                    $lineEnd = strpos($fullContent, "\n", $endPos);
                    if ($lineEnd === false) {
                        $lineEnd = strlen($fullContent);
                    } else {
                        // Включаем разделитель окончания запроса
                        $lineEnd = strpos($fullContent, "\n\n", $lineEnd) + 2;
                        if ($lineEnd === false || $lineEnd === 1) {
                            $lineEnd = strlen($fullContent);
                        }
                    }
                    
                    // Извлекаем содержимое запроса
                    $content = substr($fullContent, $lineStart, $lineEnd - $lineStart);
                }
            }
        }
        
        return $content;
    }
    
    /**
     * Получает содержимое конкретного лог-файла
     * 
     * Для совместимости с предыдущей версией
     */
    public function getLogContent($fileName)
    {
        // Извлекаем ID запроса из имени файла
        if (preg_match('/request_([a-f0-9]+)\.log/', $fileName, $matches)) {
            $requestId = $matches[1];
            return $this->getRequestLog($requestId);
        }
        
        // Для старых файлов или если не удалось извлечь ID
        if (file_exists($this->detailedLogFile)) {
            return file_get_contents($this->detailedLogFile);
        }
        
        return '';
    }
    
    /**
     * Анализирует лог-файл и возвращает структурированные данные
     */
    public function parseLogFile($fileName)
    {
        $entries = [];
        $content = $this->getLogContent($fileName);
        
        if (!empty($content)) {
            $pattern = '/\[(.*?)\] \[(.*?)\] \[(.*?)\] \[(.*?)\] (.*?)(\n\{.*?\}\n\n|\n\n)/s';
            
            if (preg_match_all($pattern, $content, $matches, PREG_SET_ORDER)) {
                foreach ($matches as $match) {
                    $date = $match[1];
                    $level = $match[2];
                    $memory = $match[3];
                    $requestId = $match[4];
                    $message = $match[5];
                    
                    // Пытаемся извлечь данные JSON
                    $data = [];
                    if (isset($match[6]) && !empty($match[6])) {
                        $jsonStr = trim($match[6]);
                        if (!empty($jsonStr)) {
                            $data = json_decode($jsonStr, true) ?: [];
                        }
                    }
                    
                    $entries[] = [
                        'date' => $date,
                        'level' => $level,
                        'memory' => $memory,
                        'request_id' => $requestId,
                        'message' => $message,
                        'data' => $data
                    ];
                }
            }
        }
        
        return $entries;
    }
    
    /**
     * Очищает все лог-файлы
     */
    public function clearLogs()
    {
        $result = true;
        
        // Очищаем основной лог
        if (file_exists($this->mainLogFile)) {
            $result = $result && file_put_contents($this->mainLogFile, '') !== false;
        }
        
        // Очищаем детальный лог
        if (file_exists($this->detailedLogFile)) {
            $result = $result && file_put_contents($this->detailedLogFile, '') !== false;
        }
        
        return $result;
    }
    
    /**
     * Удаляет записи конкретного запроса из лога
     * 
     * @param string $requestId ID запроса
     * @return bool
     */
    public function deleteRequestLog($requestId)
    {
        // Для текущей реализации с единым файлом лога
        // мы не можем удалить отдельный запрос без перезаписи всего файла
        // Поэтому просто возвращаем false
        return false;
    }
    
    /**
     * Удаляет конкретный лог-файл
     * 
     * Для совместимости с предыдущей версией
     */
    public function deleteLog($fileName)
    {
        // Извлекаем ID запроса из имени файла
        if (preg_match('/request_([a-f0-9]+)\.log/', $fileName, $matches)) {
            $requestId = $matches[1];
            return $this->deleteRequestLog($requestId);
        }
        
        return false;
    }
    
    /**
     * Форматирует размер файла в читаемый вид
     */
    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        
        $bytes /= pow(1024, $pow);
        
        return round($bytes, $precision) . ' ' . $units[$pow];
    }
    
    /**
     * Возвращает путь к директории с логами
     */
    public function getLogDir()
    {
        return $this->logDir;
    }
    
    /**
     * Возвращает путь к детальному лог-файлу
     */
    public function getDetailedLogFile()
    {
        return $this->detailedLogFile;
    }
    
    /**
     * Возвращает путь к основному лог-файлу
     */
    public function getMainLogFile()
    {
        return $this->mainLogFile;
    }
} 