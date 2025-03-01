<?php
namespace Local\Exchange;

use Bitrix\Main\Diag\Debug;
use Bitrix\Main\Config\Option;

/**
 * Класс для детального логирования обмена с 1С
 */
class DebugExchangeLogger
{
    private $logDir;
    private $currentFile;
    private $startTime;
    private $enabled = true;
    private $requestLog = [];
    private $logLevel = 'DEBUG'; // DEBUG, INFO, WARNING, ERROR
    private $memoryUsage = [];
    private $stepTiming = [];
    private $lastStep = '';
    private $requestID = '';
    
    /**
     * Конструктор класса
     * 
     * @param string $requestID Уникальный идентификатор запроса
     */
    public function __construct($requestID = null)
    {
        $this->requestID = $requestID ?: substr(md5(microtime(true)), 0, 8);
        $this->logDir = $_SERVER['DOCUMENT_ROOT'] . '/upload/1c_exchange_logs';
        $this->currentFile = $this->logDir . '/1c_exchange_debug_' . $this->requestID . '.log';
        $this->startTime = microtime(true);
        
        // Создаем директорию для логов, если она не существует
        if (!is_dir($this->logDir)) {
            mkdir($this->logDir, 0775, true);
        }
        
        // Создаем файл лога для текущего запроса
        file_put_contents($this->currentFile, '');
        chmod($this->currentFile, 0664);
        
        // Логируем начальную информацию
        $this->log('Старт логирования запроса', [
            'request_id' => $this->requestID,
            'remote_addr' => $_SERVER['REMOTE_ADDR'],
            'request_uri' => $_SERVER['REQUEST_URI'],
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown'
        ]);
        
        // Сохраняем информацию о начальном использовании памяти
        $this->memoryUsage['start'] = memory_get_usage(true);
    }
    
    /**
     * Проверяет, включено ли логирование
     * 
     * @return bool
     */
    private function isLoggingEnabled()
    {
        // Можно добавить проверку опции модуля
        // $loggingEnabled = Option::get('main', '1c_exchange_debug_enabled', 'Y');
        // return ($loggingEnabled === 'Y');
        
        return $this->enabled;
    }
    
    /**
     * Помечает начало запроса в логе
     * 
     * @param string $requestID Идентификатор запроса
     */
    public function startRequest($requestID)
    {
        if (!$this->isLoggingEnabled()) {
            return;
        }
        
        $this->requestID = $requestID;
        $this->startTime = microtime(true);
        
        $query = $_SERVER['QUERY_STRING'] ?? '';
        $uri = $_SERVER['REQUEST_URI'] ?? '';
        $method = $_SERVER['REQUEST_METHOD'] ?? '';
        
        $this->log('Начало нового запроса', [
            'request_id' => $requestID,
            'method' => $method,
            'uri' => $uri,
            'query' => $query,
            'get' => $_GET,
            'post' => $_POST
        ]);
        
        if (!empty($_FILES)) {
            $this->log('Загружаемые файлы', [
                'files' => array_keys($_FILES)
            ]);
        }
    }
    
    /**
     * Помечает окончание запроса в логе
     * 
     * @param string $requestID Идентификатор запроса
     */
    public function finishRequest($requestID)
    {
        if (!$this->isLoggingEnabled() || $requestID !== $this->requestID) {
            return;
        }
        
        $endTime = microtime(true);
        $executionTime = $endTime - $this->startTime;
        
        $this->log('Окончание запроса', [
            'request_id' => $requestID,
            'execution_time' => round($executionTime, 4),
            'memory_peak' => $this->formatBytes(memory_get_peak_usage(true)),
            'memory_end' => $this->formatBytes(memory_get_usage(true))
        ]);
        
        // Собираем статистику ошибок
        $errorsCount = 0;
        foreach ($this->requestLog as $entry) {
            if ($entry['level'] === 'ERROR') {
                $errorsCount++;
            }
        }
        
        // Добавляем запись в основной лог обмена
        $this->addToMainLog($requestID, $executionTime, $errorsCount);
    }
    
    /**
     * Добавляет запись в основной лог обмена
     * 
     * @param string $requestID Идентификатор запроса
     * @param float $executionTime Время выполнения
     * @param int $errorsCount Количество ошибок
     */
    private function addToMainLog($requestID, $executionTime, $errorsCount)
    {
        $mainLogFile = $this->logDir . '/1c_exchange_main.log';
        $logEntry = [
            'date' => date('Y-m-d H:i:s'),
            'request_id' => $requestID,
            'execution_time' => round($executionTime, 4),
            'memory_usage' => $this->formatBytes(memory_get_peak_usage(true)),
            'errors' => $errorsCount,
            'file' => basename($this->currentFile)
        ];
        
        $logLine = json_encode($logEntry, JSON_UNESCAPED_UNICODE) . "\n";
        file_put_contents($mainLogFile, $logLine, FILE_APPEND);
    }
    
    /**
     * Основной метод для добавления записи в лог
     * 
     * @param string $message Сообщение
     * @param array $data Дополнительные данные
     * @param string $level Уровень логирования (INFO, DEBUG, ERROR, WARNING)
     */
    public function log($message, $data = [], $level = 'INFO')
    {
        if (!$this->isLoggingEnabled()) {
            return;
        }
        
        // Проверяем уровень логирования
        $levels = [
            'DEBUG' => 1,
            'INFO' => 2,
            'WARNING' => 3,
            'ERROR' => 4
        ];
        
        // Если текущий уровень лога ниже настроенного, пропускаем
        if ($levels[$level] < $levels[$this->logLevel]) {
            return;
        }
        
        $entry = [
            'time' => microtime(true),
            'date' => date('Y-m-d H:i:s'),
            'level' => $level,
            'message' => $message,
            'data' => $data,
            'memory' => $this->getMemoryUsage()
        ];
        
        // Добавляем запись в массив для статистики
        $this->requestLog[] = $entry;
        
        // Форматируем запись для файла
        $logLine = sprintf(
            "[%s] [%s] [%s] %s\n",
            $entry['date'],
            $level,
            $entry['memory'],
            $message
        );
        
        // Добавляем данные в формате JSON, если они есть
        if (!empty($data)) {
            $jsonData = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            $logLine .= $jsonData . "\n\n";
        } else {
            $logLine .= "\n";
        }
        
        // Записываем в файл
        file_put_contents($this->currentFile, $logLine, FILE_APPEND);
    }
    
    /**
     * Добавляет запись уровня INFO в лог
     * 
     * @param string $message Сообщение
     * @param array $data Дополнительные данные
     */
    public function info($message, $data = [])
    {
        $this->log($message, $data, 'INFO');
    }
    
    /**
     * Добавляет запись уровня DEBUG в лог
     * 
     * @param string $message Сообщение
     * @param array $data Дополнительные данные
     */
    public function debug($message, $data = [])
    {
        $this->log($message, $data, 'DEBUG');
    }
    
    /**
     * Добавляет запись уровня ERROR в лог
     * 
     * @param string $message Сообщение
     * @param array $data Дополнительные данные
     */
    public function error($message, $data = [])
    {
        $this->log($message, $data, 'ERROR');
    }
    
    /**
     * Добавляет запись уровня WARNING в лог
     * 
     * @param string $message Сообщение
     * @param array $data Дополнительные данные
     */
    public function warning($message, $data = [])
    {
        $this->log($message, $data, 'WARNING');
    }
    
    /**
     * Логирует выполнение SQL-запроса
     */
    public function logQuery($query, $params = [], $executionTime = 0)
    {
        $this->debug('SQL запрос', [
            'query' => $query,
            'params' => $params,
            'execution_time' => $executionTime
        ]);
    }
    
    /**
     * Логирует начало процесса импорта
     */
    public function logImportStart($type, $mode, $filename = '')
    {
        $this->info('Старт импорта', [
            'type' => $type,
            'mode' => $mode,
            'filename' => $filename
        ]);
    }
    
    /**
     * Логирует окончание процесса импорта
     */
    public function logImportFinish($type, $mode, $result = '')
    {
        $this->info('Окончание импорта', [
            'type' => $type,
            'mode' => $mode,
            'result' => $result
        ]);
    }
    
    /**
     * Логирует начало процесса экспорта
     */
    public function logExportStart($type, $mode)
    {
        $this->info('Старт экспорта', [
            'type' => $type,
            'mode' => $mode
        ]);
    }
    
    /**
     * Логирует окончание процесса экспорта
     */
    public function logExportFinish($type, $mode, $result = '')
    {
        $this->info('Окончание экспорта', [
            'type' => $type,
            'mode' => $mode,
            'result' => $result
        ]);
    }
    
    /**
     * Возвращает текущее использование памяти в форматированном виде
     */
    private function getMemoryUsage()
    {
        $memory = memory_get_usage(true);
        return $this->formatBytes($memory);
    }
    
    /**
     * Форматирует байты в читаемый формат
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
     * Возвращает массив со всеми записями лога
     */
    public function getRequestLog()
    {
        return $this->requestLog;
    }
    
    /**
     * Возвращает ID текущего запроса
     */
    public function getRequestID()
    {
        return $this->requestID;
    }
    
    /**
     * Возвращает путь к файлу лога
     */
    public function getLogFilePath()
    {
        return $this->currentFile;
    }
    
    /**
     * Возвращает директорию с логами
     */
    public function getLogDir()
    {
        return $this->logDir;
    }
    
    /**
     * Возвращает статистику по текущему запросу
     */
    public function getStats()
    {
        $endTime = microtime(true);
        $executionTime = $endTime - $this->startTime;
        
        return [
            'execution_time' => round($executionTime, 4),
            'memory_peak' => $this->formatBytes(memory_get_peak_usage(true)),
            'memory_start' => $this->formatBytes($this->memoryUsage['start'] ?? 0),
            'memory_current' => $this->getMemoryUsage()
        ];
    }
    
    /**
     * Сохраняет информацию о запросе в основной лог
     */
    public function saveToMainLog()
    {
        $endTime = microtime(true);
        $executionTime = $endTime - $this->startTime;
        
        // Собираем статистику ошибок
        $errorsCount = 0;
        foreach ($this->requestLog as $entry) {
            if ($entry['level'] === 'ERROR') {
                $errorsCount++;
            }
        }
        
        // Добавляем запись в основной лог обмена
        $this->addToMainLog($this->requestID, $executionTime, $errorsCount);
    }
} 