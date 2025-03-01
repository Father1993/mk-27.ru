<?php
/**
 * Инициализация системы обмена с 1C
 * 
 * Данный файл подключается через init.php и инициализирует все необходимые
 * компоненты для отладки и мониторинга обмена с 1С
 */

// Создаем директорию для хранения логов, если она не существует
$logDir = $_SERVER['DOCUMENT_ROOT'] . '/upload/1c_exchange_logs';
if (!is_dir($logDir)) {
    mkdir($logDir, 0775, true);
}

// Основной файл лога
$mainLogFile = $logDir . '/1c_exchange_main.log';
if (!file_exists($mainLogFile)) {
    file_put_contents($mainLogFile, '');
    chmod($mainLogFile, 0664);
}

// Загружаем автоматически все необходимые классы
$classesToLoad = [
    'DebugExchangeLogger.php',
    'CustomExchangeEventHandler.php',
    'LogViewer.php'
];

foreach ($classesToLoad as $className) {
    $classPath = __DIR__ . '/1c_exchange/' . $className;
    if (file_exists($classPath)) {
        require_once($classPath);
    }
}

// Получаем текущий запрос для определения, идёт ли взаимодействие с 1С
$currentRequest = \Bitrix\Main\Context::getCurrent()->getRequest();
$requestURI = $currentRequest->getRequestUri();

// Инициализируем и регистрируем обработчики, если идет обмен с 1С
if (strpos($requestURI, '1c_exchange') !== false || 
    strpos($requestURI, 'mode=import') !== false || 
    strpos($requestURI, 'mode=query') !== false ||
    strpos($requestURI, 'mode=checkauth') !== false ||
    strpos($requestURI, 'mode=init') !== false ||
    strpos($requestURI, 'mode=file') !== false ||
    strpos($requestURI, 'mode=import') !== false) {
    
    // Инициализируем логгер для обмена
    $requestId = substr(md5(microtime(true)), 0, 8);
    $logger = new \Local\Exchange\DebugExchangeLogger($requestId);
    
    // Инициализируем обработчик событий
    \Local\Exchange\CustomExchangeEventHandler::init($logger, $requestId);
    
    // Логируем начало обработки запроса
    $logger->info('Инициализация обмена с 1С', [
        'request_uri' => $requestURI,
        'method' => $currentRequest->getRequestMethod(),
        'get_params' => $currentRequest->getQueryList()->toArray(),
        'post_params' => $currentRequest->getPostList()->toArray(),
        'server' => [
            'REMOTE_ADDR' => $_SERVER['REMOTE_ADDR'],
            'HTTP_USER_AGENT' => $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown',
        ]
    ]);
}

// Добавляем пункт в административное меню для просмотра логов обмена
AddEventHandler('main', 'OnBuildGlobalMenu', function (&$adminMenu, &$moduleMenu) {
    global $USER;
    
    if (!$USER->IsAdmin()) {
        return;
    }
    
    $moduleMenu[] = [
        'parent_menu' => 'global_menu_settings',
        'section' => 'exchange_1c_logs',
        'sort' => 1000,
        'url' => '1c_exchange_log_viewer.php?lang=' . LANGUAGE_ID,
        'text' => 'Логи обмена с 1С',
        'title' => 'Просмотр логов обмена с 1С',
        'icon' => 'exchange_log_menu_icon',
        'page_icon' => 'exchange_log_page_icon',
        'items_id' => 'menu_exchange_1c_logs',
        'items' => [
            [
                'text' => 'Просмотр логов',
                'url' => '1c_exchange_log_viewer.php?lang=' . LANGUAGE_ID,
                'more_url' => ['1c_exchange_log_viewer.php'],
                'title' => 'Просмотр логов обмена с 1С',
            ],
        ]
    ];
});

// Добавление стилей для иконок меню
AddEventHandler('main', 'OnBeforeProlog', function() {
    if (strpos($_SERVER['REQUEST_URI'], '/bitrix/admin/') !== false) {
        $GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/admin/exchange_1c_log_viewer.css');
        if (!file_exists($_SERVER['DOCUMENT_ROOT'] . '/bitrix/admin/exchange_1c_log_viewer.css')) {
            $css = <<<CSS
.exchange_log_menu_icon {
    background: url('/bitrix/images/main/system/file_dialog_icon.png') 99% 4px no-repeat;
}
.exchange_log_page_icon {
    background: url('/bitrix/images/main/system/file_dialog_icon.png') 99% 4px no-repeat;
}
CSS;
            file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/bitrix/admin/exchange_1c_log_viewer.css', $css);
        }
    }
}); 