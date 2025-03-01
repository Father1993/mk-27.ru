<?php
namespace Local\Exchange;

use Bitrix\Main\Loader;

/**
 * Кастомный класс для обмена заказами с 1С
 */
class CustomSaleExport extends \CSaleExport
{
    /** @var \Local\Exchange\DebugExchangeLogger */
    private static $logger;
    
    /**
     * Устанавливает логгер
     * 
     * @param \Local\Exchange\DebugExchangeLogger $logger
     */
    public static function setLogger($logger)
    {
        self::$logger = $logger;
    }
    
    /**
     * Переопределенный метод экспорта заказов
     */
    public static function ExportOrders2Xml($arFilter = array(), $nTopCount = 0, $currency = "", $crmMode = false, $time_limit = 0, $version = false, $arOptions = array())
    {
        if (self::$logger) {
            self::$logger->info('Начало экспорта заказов в 1С', [
                'filter' => $arFilter,
                'top_count' => $nTopCount,
                'currency' => $currency,
                'crm_mode' => $crmMode,
                'version' => $version
            ]);
        }
        
        try {
            // Выполняем оригинальный метод экспорта
            $result = parent::ExportOrders2Xml($arFilter, $nTopCount, $currency, $crmMode, $time_limit, $version, $arOptions);
            
            if (self::$logger) {
                self::$logger->info('Окончание экспорта заказов в 1С', [
                    'success' => true
                ]);
            }
            
            return $result;
        } catch (\Exception $e) {
            if (self::$logger) {
                self::$logger->error('Ошибка при экспорте заказов в 1С', [
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTraceAsString()
                ]);
            }
            throw $e;
        }
    }
    
    /**
     * Переопределенный метод вывода XML документа
     */
    public static function OutputXmlDocument($typeDocument, $xmlResult, $document = array())
    {
        if (self::$logger) {
            self::$logger->info('Вывод XML документа', [
                'type' => $typeDocument,
                'document_id' => isset($document['ID']) ? $document['ID'] : null
            ]);
        }
        
        try {
            // Выполняем оригинальный метод
            return parent::OutputXmlDocument($typeDocument, $xmlResult, $document);
        } catch (\Exception $e) {
            if (self::$logger) {
                self::$logger->error('Ошибка при выводе XML документа', [
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTraceAsString()
                ]);
            }
            throw $e;
        }
    }
    
    /**
     * Переопределенный метод получения заказов
     */
    public static function GetList($arOrder = array("ID" => "ASC"), $arFilter = array(), $arGroupBy = false, $arNavStartParams = false, $arSelectFields = array())
    {
        if (self::$logger) {
            self::$logger->info('Получение списка заказов', [
                'order' => $arOrder,
                'filter' => $arFilter,
                'group_by' => $arGroupBy,
                'nav_params' => $arNavStartParams,
                'select' => $arSelectFields
            ]);
        }
        
        try {
            // Выполняем оригинальный метод
            $result = parent::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams, $arSelectFields);
            
            return $result;
        } catch (\Exception $e) {
            if (self::$logger) {
                self::$logger->error('Ошибка при получении списка заказов', [
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTraceAsString()
                ]);
            }
            throw $e;
        }
    }
    
    /**
     * Метод для выгрузки данных заказа
     * Не переопределяет родительский метод, а вызывается из компонента
     */
    public static function ExportOrder($arOrder, $xmlResult, $arOptions = array())
    {
        if (self::$logger) {
            self::$logger->info('Выгрузка данных заказа', [
                'order_id' => $arOrder['ID'],
                'xml_id' => $arOrder['XML_ID'] ?? '',
                'options' => $arOptions
            ]);
        }
        
        try {
            // Проверяем метод в родительском классе
            if (method_exists(get_parent_class(), 'ExportOrder')) {
                // Попытка вызова метода через вызов родительского метода
                $result = call_user_func_array(['parent', 'ExportOrder'], [$arOrder, $xmlResult, $arOptions]);
                return $result;
            } else {
                // Возможная реализация метода, если он отсутствует в родительском классе
                if (self::$logger) {
                    self::$logger->warning('Метод ExportOrder не найден в родительском классе, используем стандартную логику');
                }
                // Здесь можно добавить базовую реализацию метода
                return false;
            }
        } catch (\Exception $e) {
            if (self::$logger) {
                self::$logger->error('Ошибка при выгрузке данных заказа', [
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTraceAsString(),
                    'order_id' => $arOrder['ID']
                ]);
            }
            throw $e;
        }
    }
    
    /**
     * Метод для формирования XML контрагента
     * Не переопределяет родительский метод, а вызывается из компонента
     */
    public static function ExportContragent($arOrder, $xmlResult, $bExportFromCrm = false, $bChange = false, $sourceVersion = false, $arOptions = array())
    {
        if (self::$logger) {
            self::$logger->info('Формирование XML контрагента', [
                'order_id' => $arOrder['ID'],
                'export_from_crm' => $bExportFromCrm,
                'change' => $bChange,
                'source_version' => $sourceVersion
            ]);
        }
        
        try {
            // Проверяем метод в родительском классе
            if (method_exists(get_parent_class(), 'ExportContragent')) {
                // Попытка вызова метода через вызов родительского метода
                $result = call_user_func_array(['parent', 'ExportContragent'], [$arOrder, $xmlResult, $bExportFromCrm, $bChange, $sourceVersion, $arOptions]);
                return $result;
            } else {
                // Возможная реализация метода, если он отсутствует в родительском классе
                if (self::$logger) {
                    self::$logger->warning('Метод ExportContragent не найден в родительском классе, используем стандартную логику');
                }
                // Здесь можно добавить базовую реализацию метода
                return false;
            }
        } catch (\Exception $e) {
            if (self::$logger) {
                self::$logger->error('Ошибка при формировании XML контрагента', [
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTraceAsString(),
                    'order_id' => $arOrder['ID']
                ]);
            }
            throw $e;
        }
    }
    
    /**
     * Метод для формирования XML товаров заказа
     * Не переопределяет родительский метод, а вызывается из компонента
     */
    public static function ExportBasketItems($arOrder, $xmlResult, $arOptions = array())
    {
        if (self::$logger) {
            self::$logger->info('Формирование XML товаров заказа', [
                'order_id' => $arOrder['ID'],
                'options' => $arOptions
            ]);
        }
        
        try {
            // Проверяем метод в родительском классе
            if (method_exists(get_parent_class(), 'ExportBasketItems')) {
                // Попытка вызова метода через вызов родительского метода
                $result = call_user_func_array(['parent', 'ExportBasketItems'], [$arOrder, $xmlResult, $arOptions]);
                return $result;
            } else {
                // Возможная реализация метода, если он отсутствует в родительском классе
                if (self::$logger) {
                    self::$logger->warning('Метод ExportBasketItems не найден в родительском классе, используем стандартную логику');
                }
                // Здесь можно добавить базовую реализацию метода
                return false;
            }
        } catch (\Exception $e) {
            if (self::$logger) {
                self::$logger->error('Ошибка при формировании XML товаров заказа', [
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                    'trace' => $e->getTraceAsString(),
                    'order_id' => $arOrder['ID']
                ]);
            }
            throw $e;
        }
    }
} 