<?php
namespace korElf\wpRecall\mailingListInYourAccount;

/**
 * Автоподключение классов дополнения
 */
final class Autoload
{
    /**
     * Подключаем наши классы
     *
     * @name = string
     *
     */
	public static function loadPackages($name)
	{
        if (strpos($name, 'korElf\wpRecall\mailingListInYourAccount\\') === false) {
            return null;
        }

        $root = (__DIR__) . '/classes/';

        $path = str_replace(['\\', 'korElf/wpRecall/mailingListInYourAccount/'], ['/', ''], $name);
        $path = $root . $path . '.php';

        require_once($path);
	}
}

spl_autoload_register(['korElf\wpRecall\mailingListInYourAccount\Autoload', 'loadPackages']);
