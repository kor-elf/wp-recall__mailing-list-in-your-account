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
        rcl_enqueue_style('rcl-chat', rcl_addon_url('static/css/mailing_groups.css', Config::getFileAddon()));
    	rcl_enqueue_script('rcl-chat', rcl_addon_url('static/js/mailing_groups.js', Config::getFileAddon()));

        $groups = ESputnik::getGroups();


        /*
        $current_user = wp_get_current_user();
        $groups = ESputnik::getSearchContact($current_user->user_email);
        echo '<pre>';
        print_r($groups);
        print_r($current_user->first_name);
        print_r($current_user->last_name);
        print_r($current_user->display_name);
        print_r($current_user->user_nicename);

        exit;
        */

        $content = rcl_get_include_template('user_menu_tab.php', Config::getDirTemplates(), [
            'groups' => $groups
        ]);




        return $content;
    }
}
