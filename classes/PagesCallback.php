<?php
namespace korElf\wpRecall\mailingListInYourAccount;

use korElf\wpRecall\mailingListInYourAccount\Config;
use korElf\wpRecall\mailingListInYourAccount\services\eSputnik\ESputnik;

class PagesCallback
{
    /**
     * Выводим данные вкладки "Рассылки" от пользователя
     *
     * @userId = integer
     *
     * return string
     */
    public static function userMenuTab($userId)
    {
        /*
        $current_user = wp_get_current_user();
        $tokens       = Tokens::getToken();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_URL, 'https://esputnik.com/api/v2/version');
        curl_setopt($ch,CURLOPT_USERPWD, $tokens);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_SSLVERSION, 6);
        $output = curl_exec($ch);
        echo($output);
        curl_close($ch);

        //print_r($current_user->user_email);
        */

        echo 555;
        $groups = ESputnik::getGroups();
        echo '<pre>';
        print_r($groups);
        exit;

        $content = rcl_get_include_template('user_menu_tab.php', Config::getDirTemplates(), [

        ]);


        return $content;
    }
}
