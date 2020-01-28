<?php
namespace korElf\wpRecall\mailingListInYourAccount;

class Config
{
    protected static $fileAddon;
    protected static $dirAddon;
    protected static $services = [
        'eSputnik' => [
            'title'  => 'eSputnik.com',
            'tokens' => false
        ],
    ];

    /**
     * Получаем данные от этого дополнения (__FILE__)
     *
     * return string
     */
    public static function getFileAddon()
    {
        return self::$fileAddon;
    }

    /**
     * Обновляем данные от этого плагина (__FILE__)
     *
     * @file = string
     */
    public static function setFileAddon(string $file)
    {
        self::$fileAddon = $file;
    }

    /**
     * Получаем данные от этого дополнения (__DIR__)
     *
     * return string
     */
    public static function getDirAddon()
    {
        return self::$dirAddon;
    }

    /**
     * Обновляем данные от этого плагина (__DIR__)
     *
     * @dir = string
     */
    public static function setDirAddon(string $dir)
    {
        self::$dirAddon = $dir;
    }

    /**
     * Обновляем весь список сервисов.
     *
     * @services = array
     */
    public static function setServices(array $services)
    {
        self::$services = $services;
    }

    /**
     * Добавляем новый сервис.
     *
     * @serviceName  = string
     * @serviceArray = array (title => string, tokens => boolean)
     */
    public static function addServices(string $serviceName, array $serviceArray)
    {
        self::$services[$serviceName] = $serviceArray;
    }

    /**
     * Получаем список сервисов, которые поддерживает дополнение.
     *
     * return array
     */
    public static function getServices()
    {
        return self::$services;
    }

    /**
     * Получаем путь к директории с шаблонами
     *
     * return string
     */
    public static function getDirTemplates()
    {
        return self::getFileAddon() . '/templates/';
    }
}
