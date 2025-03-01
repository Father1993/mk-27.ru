<?php
namespace Local\Exchange;

use Bitrix\Main\Loader;
use Bitrix\Main\Application;

/**
 * Класс для расширения стандартного компонента обмена с 1С
 */
class CustomSaleExportComponent
{
    /** @var \Local\Exchange\DebugExchangeLogger */
    private $logger;
    
    /** @var string */
    private $type;
    
    /** @var string */
    private $mode;
    
    /** @var array */
    private $params;
    
    /**
     * Конструктор класса
     * 
     * @param \Local\Exchange\DebugExchangeLogger $logger
     * @param string $type Тип обмена (sale)
     * @param string $mode Режим обмена (query, import, info, etc.)
     * @param array $params Дополнительные параметры
     */
    public function __construct($logger, $type, $mode, $params = [])
    {
        $this->logger = $logger;
        $this->type = $type;
        $this->mode = $mode;
        $this->params = $params;
        
        // Подключаем наш кастомный класс экспорта
        require_once(__DIR__ . '/CustomSaleExport.php');
        
        // Устанавливаем логгер для кастомного класса экспорта
        CustomSaleExport::setLogger($logger);
    }
    
    /**
     * Выполняет инициализацию перед запуском компонента
     */
    public function init()
    {
        $this->logger->log('Инициализация кастомного компонента обмена', [
            'type' => $this->type,
            'mode' => $this->mode,
            'params' => $this->params
        ]);
        
        // Проверяем, загружены ли необходимые модули
        $requiredModules = ['sale', 'catalog', 'iblock'];
        foreach ($requiredModules as $module) {
            if (!Loader::includeModule($module)) {
                $this->logger->error("Не удалось подключить модуль {$module}");
                return false;
            }
        }
        
        return true;
    }
    
    /**
     * Запускает выполнение компонента обмена
     * 
     * @return string Результат выполнения
     */
    public function execute()
    {
        // Начинаем буферизацию вывода
        ob_start();
        
        // Выполняем инициализацию
        if (!$this->init()) {
            $result = "failure\nНе удалось инициализировать компонент обмена";
            ob_end_clean();
            return $result;
        }
        
        $this->logger->log('Запуск выполнения компонента обмена', [
            'type' => $this->type,
            'mode' => $this->mode
        ]);
        
        try {
            // Регистрируем обработчики событий перед запуском стандартного компонента
            $this->registerHandlers();
            
            // Запускаем стандартный компонент обмена, но с нашими обработчиками событий
            $GLOBALS['APPLICATION']->IncludeComponent('bitrix:sale.export.1c', '', [
                'SITE_LIST' => $this->params['SITE_LIST'] ?? [],
                'EXPORT_PAYED_ORDERS' => $this->params['EXPORT_PAYED_ORDERS'] ?? 'N',
                'EXPORT_ALLOW_DELIVERY_ORDERS' => $this->params['EXPORT_ALLOW_DELIVERY_ORDERS'] ?? 'N',
                'EXPORT_FINAL_ORDERS' => $this->params['EXPORT_FINAL_ORDERS'] ?? '',
                'FINAL_STATUS_ON_DELIVERY' => $this->params['FINAL_STATUS_ON_DELIVERY'] ?? 'F',
                'REPLACE_CURRENCY' => $this->params['REPLACE_CURRENCY'] ?? '',
                'USE_ZIP' => $this->params['USE_ZIP'] ?? 'Y'
            ]);
            
            // Получаем результат выполнения
            $result = ob_get_contents();
            
            $this->logger->log('Результат выполнения компонента обмена', [
                'result' => $result
            ]);
            
        } catch (\Throwable $e) {
            $this->logger->error('Ошибка при выполнении компонента обмена', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);
            
            $result = "failure\n" . $e->getMessage();
        }
        
        ob_end_clean();
        return $result;
    }
    
    /**
     * Регистрирует обработчики событий для перехвата процесса обмена
     */
    private function registerHandlers()
    {
        // Здесь можно зарегистрировать дополнительные обработчики событий для конкретного режима обмена
        if ($this->mode == 'query') {
            // Режим запроса данных
            $this->logger->log('Регистрация обработчиков для режима запроса данных');
            
            // Тут можно добавить обработчики для режима запроса
        } elseif ($this->mode == 'success') {
            // Режим успешного завершения
            $this->logger->log('Регистрация обработчиков для режима успешного завершения');
            
            // Тут можно добавить обработчики для режима успешного завершения
        } elseif ($this->mode == 'import') {
            // Режим импорта данных
            $this->logger->log('Регистрация обработчиков для режима импорта данных');
            
            // Тут можно добавить обработчики для режима импорта
        } elseif ($this->mode == 'info') {
            // Режим получения информации
            $this->logger->log('Регистрация обработчиков для режима получения информации');
            
            // Тут можно добавить обработчики для режима получения информации
        }
    }
} 