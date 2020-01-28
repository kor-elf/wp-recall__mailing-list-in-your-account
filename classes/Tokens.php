<?php
namespace korElf\wpRecall\mailingListInYourAccount;

use korElf\wpRecall\mailingListInYourAccount\vendor\phpseclib\Crypt\Rijndael;
use korElf\wpRecall\mailingListInYourAccount\vendor\phpseclib\Crypt\Random;

class Tokens
{
    /**
     * Обновляем данные токена
     *
     * @token = string
     *
     * return string
     */
    public static function update($token)
    {
        if ($token == '*' || $token == '*:*') {
            return rcl_get_option('addonsMLinYA-token');
        }

        return self::encrypt($token);
    }

    /**
     * Получаем данные токена
     *
     * return string || false
     */
    public static function getToken()
    {
        $token = rcl_get_option('addonsMLinYA-token');
        if (empty($token)) {
            return false;
        }

        return self::decrypt($token);
    }

    /**
    * шифруем данные
    *
    * @property string $text
    *
    * return string
    **/
    private static function encrypt($text)
    {
        $key = self::randomKey();
        $key_iv = self::randomKey();

        self::selectKey($key);
        self::selectKeyIv($key_iv);

        $cipher = new Rijndael(Rijndael::MODE_CBC); // could use Rijndael::MODE_CBC
        // keys are null-padded to the closest valid size
        // longer than the longest key and it's truncated
        $cipher->setKeyLength(128);
        $cipher->setKey(self::$private_key);
        // the IV defaults to all-NULLs if not explicitly defined
        $cipher->setIV(self::$private_iv);

        return $key . '::' . $key_iv . '::' . base64_encode($cipher->encrypt($text));
    }

    /**
    * рассшифровываем данные
    *
    * @property string $text
    *
    * return string
    **/
    private static function decrypt($text)
    {
        $keys = explode('::',$text);
        if (count($keys) > 2) {
            $key = $keys[0];
            $key_iv = $keys[1];
            unset($keys[0],$keys[1]);

            self::selectKey($key);
            self::selectKeyIv($key_iv);

            $plaintext = implode('::',$keys);
            $plaintext = base64_decode($plaintext);

            $cipher = new Rijndael(Rijndael::MODE_CBC); // could use Rijndael::MODE_CBC
            // keys are null-padded to the closest valid size
            // longer than the longest key and it's truncated
            $cipher->setKeyLength(128);
            $cipher->setKey(self::$private_key);
            // the IV defaults to all-NULLs if not explicitly defined
            $cipher->setIV(self::$private_iv);

            $plaintext = $cipher->decrypt($plaintext);
            if (!empty($plaintext)) {
                $text = $plaintext;
            }
        }
        return $text;
    }

    /**
    * выбираем случайный код ключа
    *
    * return integer
    **/
    private static function randomKey()
    {
        $key = mt_rand(1, 4);

        return $key;
    }

    private static $private_key = 0;
    private static $private_iv = 0;

    /**
    * выбираем нужный ключ
    *
    * @property integer $key
    **/
    private static function selectKey($key)
    {
        switch ($key) {
            case '1':
                self::$private_key = 'jL9523pfFMIu0C2g';
            break;
            case '2':
                self::$private_key = 'PydKC309vW63PU2Q';
            break;
            case '3':
                self::$private_key = 'CSr6N05i4PjG1mc9';
            break;
            case '4':
                self::$private_key = 'p151H46S6RAEwYkZ';
            break;
        }
    }
    /**
    * выбираем нужный IV ключ
    *
    * @property integer $key
    **/
    private static function selectKeyIv($key)
    {
        switch ($key) {
            case '1':
                self::$private_iv = '45E5FzML4x96ZxMN';
            break;
            case '2':
                self::$private_iv = 'XyD5Ojsfh95KL198';
            break;
            case '3':
                self::$private_iv = '2p9fthr3n2DZ25Mm';
            break;
            case '4':
                self::$private_iv = 'Njr748lXLNZg292x';
            break;
        }
    }
}
