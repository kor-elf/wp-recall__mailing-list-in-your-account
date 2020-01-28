<?php
namespace korElf\wpRecall\mailingListInYourAccount;

class Pages
{
    /**
     * Добавляем в меню пользователя вкладку "Рассылки"
     */
    public static function userMenuTab()
    {
        $tab_data =	array(
            'id' => 'KE_mailing_groups',
            'name' => 'Рассылки',
            'public' => 0,
            'icon' => 'fa-envelope',
            'output' => 'menu',
            'content' => array(
                array(
                    'callback' => array(
                        'name' => '\korElf\wpRecall\mailingListInYourAccount\PagesCallback::userMenuTab',
                    )
                )
            )
        );

        rcl_tab($tab_data);
    }
}
