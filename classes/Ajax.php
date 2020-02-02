<?php
namespace korElf\wpRecall\mailingListInYourAccount;

use korElf\wpRecall\mailingListInYourAccount\Config;
use korElf\wpRecall\mailingListInYourAccount\services\eSputnik\ESputnik;

class Ajax
{
    /**
     * Получаем список групп в которых состоит пользователь
     */
    public static function getContactInGroups()
    {
        // проверка nonce
        rcl_verify_ajax_nonce();

        $data = [];


        echo json_encode($data);        
        wp_die();
    }
}
