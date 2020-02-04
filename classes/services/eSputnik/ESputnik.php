<?php
namespace korElf\wpRecall\mailingListInYourAccount\services\eSputnik;

use korElf\wpRecall\mailingListInYourAccount\services\ServiceInterface;
use korElf\wpRecall\mailingListInYourAccount\services\BaseService;
use korElf\wpRecall\mailingListInYourAccount\Tokens;

class ESputnik extends BaseService implements ServiceInterface
{

    /**
     * Получение группы рассылок
     *
     * return object
     */
    public static function getGroups()
    {
        $return = self::send('v1/groups');

        return $return;
    }

    /**
     * Поиск контактов по e-mail
     *
     * $email = string
     *
     * return object
     */
    public static function getSearchContacts($email)
    {
        $return = self::send('v1/contacts?startindex=1&maxrows=10&email=' . $email);

        return $return;
    }

    /**
     *  Получаем по id контакт
     *
     * $id = integer
     *
     * return object
     */
    public static function getContact($id)
    {
        $return = self::send('v1/contact/' . $id);

        return $return;
    }





    /**
     * Отправлять запросы к APi сервиса
     *
     * @url = string
     *
     * return object
     */
    private static function send($url)
    {
        $tokens = Tokens::getToken();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_URL, 'https://esputnik.com/api/' . $url);
        curl_setopt($ch, CURLOPT_USERPWD, $tokens);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSLVERSION, 6);
        $output = curl_exec($ch);
        curl_close($ch);

        if (empty($output)) {
            return false;
        }

        return json_decode($output);
    }
}
