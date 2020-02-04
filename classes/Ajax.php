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

        $current_user = wp_get_current_user();
        if (!empty($current_user)) {
            // Потом надо будет реализовать через один метод!!!

            // Ищим контакты у которых указана почта пользователя, что бы узнать его ID от сервиса
            $contacts = ESputnik::getSearchContacts($current_user->user_email);

            if (!empty($contacts)) {

                foreach ($contacts as $contactKey => $contactObject) {

                    // Ищим контакт по ID, что бы узнать к каким группам пользователь подписан
                    $contact = ESputnik::getContact($contactObject->id);
                    if (!empty($contact) && !empty($contact->groups)) {

                        foreach ($contact->groups as $groupKey => $groupObject) {
                            $data[$groupObject->id] = 1;
                        }

                    }

                }

            }

        }

        echo json_encode($data);

        wp_die();
    }
}
