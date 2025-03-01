<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\UI\Extension;
use Bitrix\Main\Page\Asset;
use Bitrix\Main\Application;
use Bitrix\Main\Web\Uri;
use Bitrix\Main\Context;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Diag\Debug;

try {
    if (!CModule::IncludeModule('main')) {
        throw new \Bitrix\Main\LoaderException('Module main is not installed');
    }

    $asset = Asset::getInstance();
    $application = Application::getInstance();
    $context = $application->getContext();
    $request = $context->getRequest();
    $server = $context->getServer();
    $documentRoot = $application->getDocumentRoot();

    // Базовые мета-теги
    $asset->addString('<meta charset="' . SITE_CHARSET . '">');
    $asset->addString('<meta name="viewport" content="width=device-width, initial-scale=1.0">');
    $asset->addString('<meta http-equiv="X-UA-Compatible" content="IE=edge">');
    $asset->addString('<meta name="theme-color" content="#ffffff">');
    $asset->addString('<meta name="msapplication-TileColor" content="#ffffff">');

    // Open Graph
    $curUri = new Uri($request->getRequestUri());
    $protocol = $request->isHttps() ? 'https' : 'http';
    $fullUrl = $protocol . '://' . $server->getServerName() . $curUri->getUri();
    
    $asset->addString('<meta property="og:type" content="website">');
    $asset->addString('<meta property="og:url" content="' . htmlspecialcharsbx($fullUrl) . '">');
    $asset->addString('<meta property="og:site_name" content="' . htmlspecialcharsbx(Option::get('main', 'site_name', 'Метиз Комплект')) . '">');

    // Favicon через константы Bitrix
    $templatePath = getLocalPath('templates/.default');
    $favicons = [
        64 => ['type' => 'png', 'rel' => 'shortcut icon'],
        180 => ['type' => 'apple-touch-icon-precomposed'],
        152 => ['type' => 'apple-touch-icon-precomposed'],
        144 => ['type' => 'apple-touch-icon-precomposed'],
        120 => ['type' => 'apple-touch-icon-precomposed'],
        114 => ['type' => 'apple-touch-icon-precomposed'],
        76 => ['type' => 'apple-touch-icon-precomposed'],
        72 => ['type' => 'apple-touch-icon-precomposed'],
        57 => ['type' => 'apple-touch-icon-precomposed']
    ];

    foreach ($favicons as $size => $params) {
        $rel = $params['type'] === 'png' ? $params['rel'] : $params['type'];
        $asset->addString(sprintf(
            '<link rel="%s" %s href="%s/assets/images/favicons/%d.png">',
            $rel,
            $params['type'] !== 'png' ? sprintf('sizes="%dx%d"', $size, $size) : 'type="image/png"',
            SITE_TEMPLATE_PATH,
            $size
        ));
    }

    // Основные стили
    $styles = [
        // Внешние стили
        ['src' => 'https://fonts.googleapis.com/css2?family=PT+Sans:wght@400;700&display=swap', 'external' => true],
        ['src' => 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css', 'external' => true],
        
        // Системные стили
        ['src' => '/bitrix/css/main/font-awesome.css'],
        
        // Плагины
        ['src' => SITE_TEMPLATE_PATH . '/assets/plugins/fancybox/fancybox.css'],
        ['src' => SITE_TEMPLATE_PATH . '/assets/plugins/owl_carousel/owl.carousel.min.css'],
        ['src' => SITE_TEMPLATE_PATH . '/assets/plugins/owl_carousel/owl.theme.default.min.css'],
        
        // Основные стили сайта
        ['src' => SITE_TEMPLATE_PATH . '/assets/fonts/fonts.css'],
        ['src' => SITE_TEMPLATE_PATH . '/assets/css/header.css'],
        ['src' => SITE_TEMPLATE_PATH . '/assets/css/main.css'],
        ['src' => SITE_TEMPLATE_PATH . '/template_styles.css'],
    ];

    // Основные скрипты
    $scripts = [
        // jQuery и плагины (без defer для jQuery и зависимых плагинов)
        ['src' => SITE_TEMPLATE_PATH . '/assets/plugins/jquery-3.6.0.min.js', 'defer' => false],
        ['src' => SITE_TEMPLATE_PATH . '/assets/plugins/jquery.mask.min.js', 'defer' => false],
        ['src' => SITE_TEMPLATE_PATH . '/assets/plugins/jquery.validate.min.js', 'defer' => false],
        
        // Остальные плагины (с defer)
        ['src' => SITE_TEMPLATE_PATH . '/assets/plugins/fancybox/fancybox.umd.js', 'defer' => true],
        ['src' => SITE_TEMPLATE_PATH . '/assets/plugins/owl_carousel/owl.carousel.min.js', 'defer' => true],
        
        // Основные скрипты сайта
        ['src' => SITE_TEMPLATE_PATH . '/assets/plugins/api.js', 'defer' => true],
        ['src' => SITE_TEMPLATE_PATH . '/script.js', 'defer' => true],
    ];

    // Подключаем UI Bootstrap
    Extension::load(['ui.bootstrap4']);

    // Подключаем стили
    foreach ($styles as $style) {
        if (!empty($style['external'])) {
            $asset->addCss($style['src']);
            continue;
        }
        
        $localPath = $documentRoot . $style['src'];
        if (file_exists($localPath)) {
            $asset->addCss($style['src']);
        } else {
            AddMessage2Log('Style file not found: ' . $style['src'], 'assets');
        }
    }

    // Подключаем скрипты
    foreach ($scripts as $script) {
        $localPath = !empty($script['external']) ? $script['src'] : $documentRoot . $script['src'];
        if (!empty($script['external']) || file_exists($localPath)) {
            $asset->addJs($script['src'], $script['defer'] ?? true);
        } else {
            AddMessage2Log('Script file not found: ' . $script['src'], 'assets');
        }
    }

    // Условное подключение 2GIS
    global $page;
    if (in_array($page, ['vakansii', 'contacts'])) {
        $asset->addJs('https://maps.api.2gis.ru/2.0/loader.js', true);
    }

    // Подключаем аналитику
    $analyticsFile = __DIR__ . '/analytics.php';
    if (file_exists($analyticsFile)) {
        $analytics = include($analyticsFile);
        if (is_array($analytics)) {
            foreach ($analytics as $code) {
                if (!empty($code)) {
                    $asset->addString($code);
                }
            }
        } else {
            AddMessage2Log('Invalid analytics data returned from analytics.php', 'assets');
        }
    } else {
        AddMessage2Log('Analytics file not found: ' . $analyticsFile, 'assets');
    }

    // JivoSite для неадминистраторов
    global $USER;
    if (!($USER instanceof CUser)) {
        $USER = new CUser();
    }
    
    if (!$USER->IsAdmin() && !in_array($USER->GetID(), [1, 5016])) {
        $asset->addString('<script src="//code.jivo.ru/widget/bPEQ6aHDNW" async></script>');
    }

} catch (\Bitrix\Main\SystemException $e) {
    AddMessage2Log($e->getMessage(), 'assets');
    if ($GLOBALS['DBDebug']) {
        Debug::writeToFile($e->getMessage(), date('Y-m-d H:i:s'), '/local/logs/assets_error.log');
    }
} 