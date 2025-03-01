<?php
namespace Local\Exchange;

/**
 * Класс для просмотра логов обмена с 1С
 */
class LogViewer
{
    private $logDir;
    private $logFiles = [];
    
    /**
     * Конструктор класса
     */
    public function __construct()
    {
        $this->logDir = $_SERVER["DOCUMENT_ROOT"] . '/upload/1c_exchange_logs';
    }
    
    /**
     * Получает список всех лог-файлов
     */
    public function getLogFiles()
    {
        $this->logFiles = [];
        
        if (is_dir($this->logDir)) {
            $files = scandir($this->logDir);
            
            foreach ($files as $file) {
                if ($file === '.' || $file === '..' || $file === '1c_exchange_main.log') {
                    continue;
                }
                
                if (strpos($file, '1c_exchange_debug_') === 0) {
                    $filePath = $this->logDir . '/' . $file;
                    $fileInfo = pathinfo($filePath);
                    $fileSize = filesize($filePath);
                    $fileTime = filemtime($filePath);
                    
                    $this->logFiles[] = [
                        'name' => $file,
                        'path' => $filePath,
                        'size' => $this->formatBytes($fileSize),
                        'date' => date('Y-m-d H:i:s', $fileTime),
                        'timestamp' => $fileTime
                    ];
                }
            }
            
            // Сортировка файлов по дате (сначала новые)
            usort($this->logFiles, function($a, $b) {
                return $b['timestamp'] - $a['timestamp'];
            });
        }
        
        return $this->logFiles;
    }
    
    /**
     * Получает содержимое основного лог-файла с общей информацией
     */
    public function getMainLog()
    {
        $mainLogFile = $this->logDir . '/1c_exchange_main.log';
        $entries = [];
        
        if (file_exists($mainLogFile)) {
            $content = file_get_contents($mainLogFile);
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
     * Получает содержимое конкретного лог-файла
     */
    public function getLogContent($fileName)
    {
        $filePath = $this->logDir . '/' . $fileName;
        $content = '';
        
        if (file_exists($filePath)) {
            $content = file_get_contents($filePath);
        }
        
        return $content;
    }
    
    /**
     * Анализирует лог-файл и возвращает структурированные данные
     */
    public function parseLogFile($fileName)
    {
        $filePath = $this->logDir . '/' . $fileName;
        $entries = [];
        
        if (file_exists($filePath)) {
            $content = file_get_contents($filePath);
            $pattern = '/\[(.*?)\] \[(.*?)\] \[(.*?)\] (.*?)(\n\{.*?\}\n\n|\n\n)/s';
            
            if (preg_match_all($pattern, $content, $matches, PREG_SET_ORDER)) {
                foreach ($matches as $match) {
                    $date = $match[1];
                    $level = $match[2];
                    $memory = $match[3];
                    $message = $match[4];
                    
                    // Пытаемся извлечь данные JSON
                    $data = [];
                    if (isset($match[5]) && !empty($match[5])) {
                        $jsonStr = trim($match[5]);
                        if (!empty($jsonStr)) {
                            $data = json_decode($jsonStr, true) ?: [];
                        }
                    }
                    
                    $entries[] = [
                        'date' => $date,
                        'level' => $level,
                        'memory' => $memory,
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
        if (is_dir($this->logDir)) {
            $files = scandir($this->logDir);
            
            foreach ($files as $file) {
                if ($file === '.' || $file === '..') {
                    continue;
                }
                
                $filePath = $this->logDir . '/' . $file;
                if (is_file($filePath)) {
                    unlink($filePath);
                }
            }
            
            return true;
        }
        
        return false;
    }
    
    /**
     * Удаляет конкретный лог-файл
     */
    public function deleteLog($fileName)
    {
        $filePath = $this->logDir . '/' . $fileName;
        
        if (file_exists($filePath) && is_file($filePath)) {
            return unlink($filePath);
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
} 