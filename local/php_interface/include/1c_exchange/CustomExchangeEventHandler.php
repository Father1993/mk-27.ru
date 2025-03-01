<?php
namespace Local\Exchange;

use Bitrix\Main\Event;
use Bitrix\Main\EventManager;
use Bitrix\Main\Loader;
use Bitrix\Main\Application;
use Bitrix\Main\DB\Connection;
use Bitrix\Sale\Internals\OrderTable;
use Bitrix\Main\Diag\Debug;
use Bitrix\Sale\Internals;

/**
 * Класс для обработки событий обмена с 1С
 */
class CustomExchangeEventHandler
{
    /** @var DebugExchangeLogger */
    protected static $logger;
    
    /** @var string ID запроса */
    protected static $requestId;
    
    /** @var array Кэшированные результаты */
    protected static $cache = [];

    /**
     * Инициализация обработчика событий
     *
     * @param DebugExchangeLogger $logger Объект логгера
     * @param string $requestId ID запроса
     */
    public static function init(DebugExchangeLogger $logger, string $requestId = null)
    {
        self::$logger = $logger;
        self::$requestId = $requestId ?: substr(md5(microtime(true)), 0, 8);
        
        self::registerEventHandlers();
    }

    /**
     * Регистрация всех обработчиков событий
     */
    protected static function registerEventHandlers()
    {
        $eventManager = EventManager::getInstance();
        
        // События каталога
        $eventManager->addEventHandler('catalog', 'OnBeforeProductAdd', [__CLASS__, 'onBeforeProductAdd']);
        $eventManager->addEventHandler('catalog', 'OnProductAdd', [__CLASS__, 'onProductAdd']);
        $eventManager->addEventHandler('catalog', 'OnBeforeProductUpdate', [__CLASS__, 'onBeforeProductUpdate']);
        $eventManager->addEventHandler('catalog', 'OnProductUpdate', [__CLASS__, 'onProductUpdate']);
        
        // События инфоблоков
        $eventManager->addEventHandler('iblock', 'OnBeforeIBlockElementAdd', [__CLASS__, 'onBeforeIBlockElementAdd']);
        $eventManager->addEventHandler('iblock', 'OnAfterIBlockElementAdd', [__CLASS__, 'onAfterIBlockElementAdd']);
        $eventManager->addEventHandler('iblock', 'OnBeforeIBlockElementUpdate', [__CLASS__, 'onBeforeIBlockElementUpdate']);
        $eventManager->addEventHandler('iblock', 'OnAfterIBlockElementUpdate', [__CLASS__, 'onAfterIBlockElementUpdate']);
        $eventManager->addEventHandler('iblock', 'OnBeforeIBlockSectionAdd', [__CLASS__, 'onBeforeIBlockSectionAdd']);
        $eventManager->addEventHandler('iblock', 'OnAfterIBlockSectionAdd', [__CLASS__, 'onAfterIBlockSectionAdd']);
        $eventManager->addEventHandler('iblock', 'OnBeforeIBlockSectionUpdate', [__CLASS__, 'onBeforeIBlockSectionUpdate']);
        $eventManager->addEventHandler('iblock', 'OnAfterIBlockSectionUpdate', [__CLASS__, 'onAfterIBlockSectionUpdate']);
        
        // События торгового каталога
        $eventManager->addEventHandler('catalog', 'OnBeforePriceAdd', [__CLASS__, 'onBeforePriceAdd']);
        $eventManager->addEventHandler('catalog', 'OnPriceAdd', [__CLASS__, 'onPriceAdd']);
        $eventManager->addEventHandler('catalog', 'OnBeforePriceUpdate', [__CLASS__, 'onBeforePriceUpdate']);
        $eventManager->addEventHandler('catalog', 'OnPriceUpdate', [__CLASS__, 'onPriceUpdate']);
        
        // События обмена с 1С
        $eventManager->addEventHandler('sale', 'OnSaleOneCExport', [__CLASS__, 'onSaleOneCExport']);
        $eventManager->addEventHandler('catalog', 'OnSuccessCatalogImport1C', [__CLASS__, 'onSuccessCatalogImport1C']);
        
        // События заказов
        $eventManager->addEventHandler('sale', 'OnBeforeOrderAdd', [__CLASS__, 'onBeforeOrderAdd']);
        $eventManager->addEventHandler('sale', 'OnOrderAdd', [__CLASS__, 'onOrderAdd']);
        $eventManager->addEventHandler('sale', 'OnBeforeOrderUpdate', [__CLASS__, 'onBeforeOrderUpdate']);
        $eventManager->addEventHandler('sale', 'OnOrderUpdate', [__CLASS__, 'onOrderUpdate']);
    }

    /**
     * Получает краткие данные о товаре
     *
     * @param int $productId ID товара
     * @return array
     */
    protected static function getProductShortInfo($productId)
    {
        if (isset(self::$cache['products'][$productId])) {
            return self::$cache['products'][$productId];
        }
        
        if (!Loader::includeModule('iblock') || !Loader::includeModule('catalog')) {
            return ['ID' => $productId];
        }
        
        $product = \CIBlockElement::GetList(
            [],
            ['ID' => $productId],
            false,
            false,
            ['ID', 'NAME', 'CODE', 'IBLOCK_ID', 'XML_ID']
        )->Fetch();
        
        if ($product) {
            self::$cache['products'][$productId] = $product;
            return $product;
        }
        
        return ['ID' => $productId];
    }

    /**
     * Получает краткие данные о разделе
     *
     * @param int $sectionId ID раздела
     * @return array
     */
    protected static function getSectionShortInfo($sectionId)
    {
        if (isset(self::$cache['sections'][$sectionId])) {
            return self::$cache['sections'][$sectionId];
        }
        
        if (!Loader::includeModule('iblock')) {
            return ['ID' => $sectionId];
        }
        
        $section = \CIBlockSection::GetList(
            [],
            ['ID' => $sectionId],
            false,
            ['ID', 'NAME', 'CODE', 'IBLOCK_ID', 'XML_ID']
        )->Fetch();
        
        if ($section) {
            self::$cache['sections'][$sectionId] = $section;
            return $section;
        }
        
        return ['ID' => $sectionId];
    }

    /**
     * Обработчик события перед добавлением товара
     */
    public static function onBeforeProductAdd(&$arFields)
    {
        self::$logger->info('Перед добавлением товара', [
            'fields' => array_intersect_key($arFields, array_flip(['PRODUCT_ID', 'QUANTITY', 'PURCHASING_PRICE']))
        ]);
        return true;
    }

    /**
     * Обработчик события после добавления товара
     */
    public static function onProductAdd($id, $arFields)
    {
        self::$logger->info('Товар добавлен', [
            'id' => $id,
            'product' => self::getProductShortInfo($arFields['PRODUCT_ID'] ?? $id)
        ]);
        return true;
    }

    /**
     * Обработчик события перед обновлением товара
     */
    public static function onBeforeProductUpdate(&$arFields)
    {
        self::$logger->info('Перед обновлением товара', [
            'product_id' => $arFields['PRODUCT_ID'] ?? $arFields['ID'] ?? 0,
            'fields' => array_intersect_key($arFields, array_flip(['QUANTITY', 'PURCHASING_PRICE']))
        ]);
        return true;
    }

    /**
     * Обработчик события после обновления товара
     */
    public static function onProductUpdate($id, $arFields)
    {
        self::$logger->info('Товар обновлен', [
            'id' => $id,
            'product' => self::getProductShortInfo($arFields['PRODUCT_ID'] ?? $id)
        ]);
        return true;
    }

    /**
     * Обработчик события перед добавлением элемента инфоблока
     */
    public static function onBeforeIBlockElementAdd(&$arFields)
    {
        self::$logger->info('Перед добавлением элемента инфоблока', [
            'iblock_id' => $arFields['IBLOCK_ID'],
            'name' => $arFields['NAME'],
            'xml_id' => $arFields['XML_ID'],
            'code' => $arFields['CODE'] ?? null
        ]);
        return true;
    }

    /**
     * Обработчик события после добавления элемента инфоблока
     */
    public static function onAfterIBlockElementAdd($arFields)
    {
        self::$logger->info('Элемент инфоблока добавлен', [
            'id' => $arFields['ID'],
            'result' => $arFields['RESULT'],
            'name' => $arFields['NAME'],
            'xml_id' => $arFields['XML_ID']
        ]);
        return true;
    }

    /**
     * Обработчик события перед обновлением элемента инфоблока
     */
    public static function onBeforeIBlockElementUpdate(&$arFields)
    {
        self::$logger->info('Перед обновлением элемента инфоблока', [
            'id' => $arFields['ID'],
            'name' => $arFields['NAME'] ?? null,
            'xml_id' => $arFields['XML_ID'] ?? null
        ]);
        return true;
    }

    /**
     * Обработчик события после обновления элемента инфоблока
     */
    public static function onAfterIBlockElementUpdate($arFields)
    {
        self::$logger->info('Элемент инфоблока обновлен', [
            'id' => $arFields['ID'],
            'result' => $arFields['RESULT'],
            'name' => $arFields['NAME'] ?? null,
            'xml_id' => $arFields['XML_ID'] ?? null
        ]);
        return true;
    }

    /**
     * Обработчик события перед добавлением раздела инфоблока
     */
    public static function onBeforeIBlockSectionAdd(&$arFields)
    {
        self::$logger->info('Перед добавлением раздела инфоблока', [
            'iblock_id' => $arFields['IBLOCK_ID'],
            'name' => $arFields['NAME'],
            'xml_id' => $arFields['XML_ID'],
            'code' => $arFields['CODE'] ?? null
        ]);
        return true;
    }

    /**
     * Обработчик события после добавления раздела инфоблока
     */
    public static function onAfterIBlockSectionAdd($arFields)
    {
        self::$logger->info('Раздел инфоблока добавлен', [
            'id' => $arFields['ID'],
            'result' => $arFields['RESULT'],
            'name' => $arFields['NAME'],
            'xml_id' => $arFields['XML_ID']
        ]);
        return true;
    }

    /**
     * Обработчик события перед обновлением раздела инфоблока
     */
    public static function onBeforeIBlockSectionUpdate(&$arFields)
    {
        self::$logger->info('Перед обновлением раздела инфоблока', [
            'id' => $arFields['ID'],
            'name' => $arFields['NAME'] ?? null,
            'xml_id' => $arFields['XML_ID'] ?? null
        ]);
        return true;
    }

    /**
     * Обработчик события после обновления раздела инфоблока
     */
    public static function onAfterIBlockSectionUpdate($arFields)
    {
        self::$logger->info('Раздел инфоблока обновлен', [
            'id' => $arFields['ID'],
            'result' => $arFields['RESULT'],
            'name' => $arFields['NAME'] ?? null,
            'xml_id' => $arFields['XML_ID'] ?? null
        ]);
        return true;
    }

    /**
     * Обработчик события перед добавлением цены
     */
    public static function onBeforePriceAdd($arFields)
    {
        self::$logger->info('Перед добавлением цены', [
            'product_id' => $arFields['PRODUCT_ID'],
            'catalog_group_id' => $arFields['CATALOG_GROUP_ID'],
            'price' => $arFields['PRICE'],
            'currency' => $arFields['CURRENCY']
        ]);
        return true;
    }

    /**
     * Обработчик события после добавления цены
     */
    public static function onPriceAdd($id, $arFields)
    {
        self::$logger->info('Цена добавлена', [
            'id' => $id,
            'product' => self::getProductShortInfo($arFields['PRODUCT_ID']),
            'price' => $arFields['PRICE'],
            'currency' => $arFields['CURRENCY']
        ]);
        return true;
    }

    /**
     * Обработчик события перед обновлением цены
     */
    public static function onBeforePriceUpdate($id, &$arFields)
    {
        self::$logger->info('Перед обновлением цены', [
            'id' => $id,
            'product_id' => $arFields['PRODUCT_ID'] ?? null,
            'price' => $arFields['PRICE'] ?? null,
            'currency' => $arFields['CURRENCY'] ?? null
        ]);
        return true;
    }

    /**
     * Обработчик события после обновления цены
     */
    public static function onPriceUpdate($id, $arFields)
    {
        self::$logger->info('Цена обновлена', [
            'id' => $id,
            'product' => isset($arFields['PRODUCT_ID']) ? self::getProductShortInfo($arFields['PRODUCT_ID']) : null,
            'price' => $arFields['PRICE'] ?? null,
            'currency' => $arFields['CURRENCY'] ?? null
        ]);
        return true;
    }

    /**
     * Обработчик события экспорта в 1С
     */
    public static function onSaleOneCExport($arOrder, $mode)
    {
        self::$logger->info('Экспорт заказа в 1С', [
            'order_id' => $arOrder['ID'],
            'xml_id' => $arOrder['XML_ID'],
            'mode' => $mode
        ]);
        return true;
    }

    /**
     * Обработчик события успешного импорта каталога из 1С
     */
    public static function onSuccessCatalogImport1C($arParams, $filename)
    {
        self::$logger->info('Успешный импорт каталога из 1С', [
            'import_type' => $arParams['IMPORT_TYPE'] ?? null,
            'filename' => $filename
        ]);
        return true;
    }

    /**
     * Обработчик события перед добавлением заказа
     */
    public static function onBeforeOrderAdd(&$arFields)
    {
        self::$logger->info('Перед добавлением заказа', [
            'user_id' => $arFields['USER_ID'],
            'price' => $arFields['PRICE'],
            'xml_id' => $arFields['XML_ID'] ?? null
        ]);
        return true;
    }

    /**
     * Обработчик события после добавления заказа
     */
    public static function onOrderAdd($id, $arFields)
    {
        self::$logger->info('Заказ добавлен', [
            'id' => $id,
            'user_id' => $arFields['USER_ID'],
            'price' => $arFields['PRICE'],
            'xml_id' => $arFields['XML_ID'] ?? null
        ]);
        return true;
    }

    /**
     * Обработчик события перед обновлением заказа
     */
    public static function onBeforeOrderUpdate($id, &$arFields)
    {
        self::$logger->info('Перед обновлением заказа', [
            'id' => $id,
            'status_id' => $arFields['STATUS_ID'] ?? null,
            'price' => $arFields['PRICE'] ?? null,
            'xml_id' => $arFields['XML_ID'] ?? null
        ]);
        return true;
    }

    /**
     * Обработчик события после обновления заказа
     */
    public static function onOrderUpdate($id, $arFields)
    {
        self::$logger->info('Заказ обновлен', [
            'id' => $id,
            'status_id' => $arFields['STATUS_ID'] ?? null,
            'price' => $arFields['PRICE'] ?? null,
            'xml_id' => $arFields['XML_ID'] ?? null
        ]);
        return true;
    }
} 