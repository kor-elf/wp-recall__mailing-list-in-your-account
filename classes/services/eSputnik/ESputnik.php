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
     * Отписываем контакт от группы
     *
     * @contactId = integer
     * @groupId   = integer
     *
     * return boolean
     */
    public static function unsubscribe($contactId, $groupId)
    {

        /*
        $json_contact_value = new \stdClass();

        $contact = new \stdClass();
        $contact->channels = array(
        	array('type'=>'email', 'value' => 'i@kor-elf.net'),
        );
        $json_contact_value->contact = $contact;
        $json_contact_value->groups = array();	// группы, в которые будет помещен контакт

        $return = self::send('v1/contact/subscribe', $json_contact_value);

        */


/*
        $return = self::send('v1/group/static/' . $groupId . '/contact/' . $contactId);

        print_r($return);
        exit;
*/

        $return = self::send('v1/contact/' . $contactId . '/subscriptions', ['subscriptions' => []]);

        print_r($return);
        exit;


    }



    /**
     * Отправлять запросы к APi сервиса
     *
     * @url  = string
     * @post = array
     *
     * return object
     */
    private static function send($url, $post = [])
    {
        $tokens = Tokens::getToken();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_URL, 'https://esputnik.com/api/' . $url);

        if (!empty($post)) {
            curl_setopt($ch, CURLOPT_POST, 1);
        	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post));
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        }

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
