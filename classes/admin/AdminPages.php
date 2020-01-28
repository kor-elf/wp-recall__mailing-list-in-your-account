<?php
namespace korElf\wpRecall\mailingListInYourAccount\admin;

use korElf\wpRecall\mailingListInYourAccount\Config;
use korElf\wpRecall\mailingListInYourAccount\Tokens;

class AdminPages
{
    /**
     * Страница настроек дополнения в плагине wpRecall
     *
     * @content = string
     *
     * return string
     */
    public static function wpRecallOptions($content)
    {
        $opt = new \Rcl_Options(Config::getFileAddon());

        $servicesArr = Config::getServices();

        $values    = [0 => __('Не выбрано')];
        $childrens = [];

        foreach ($servicesArr as $serviceKey => $serviceArr) {
            $values[$serviceKey] = __($serviceArr['title']);

            if (!empty($serviceArr['tokens'])) {
                $childrens[$serviceKey] = [
                    [
                        'type'  => 'password',
                        'title' => __('Токен от аккаунта'),
                        'slug'  => 'addonsMLinYA-password'
                    ]
                ];
            } else {
                $childrens[$serviceKey] = [
                    [
                        'type'  => 'password',
                        'title' => __('Логин от аккаунта'),
                        'slug'  => 'addonsMLinYA-login'
                    ],
                    [
                        'type'  => 'password',
                        'title' => __('Пароль от аккаунта'),
                        'slug'  => 'addonsMLinYA-password'
                    ],
                ];
            }

        }

        $content .= $opt->options(
            __('Настройки рассылки'),
            [
                $opt->options_box(
                    __('Настройки рассылки','wp-recall'),
                    [
                        [
                            'type'      => 'select',
                            'title'     => __('Выберите сервис'),
                            'slug'      => 'addonsMLinYA-service',
                            'values'    => $values,
                            'childrens' => $childrens,
                        ],
                        [
                            'type'      => 'hidden',
                            'slug'      => 'addonsMLinYA-save',
                            'default'   => '1',
                        ]
                    ]
                )
            ]
        );

        return $content;
    }

    /**
     * Перед обновлением настроек
     *
     * @value     = array || string
     */
    public static function beforeUpdateOption($value)
    {

        if (!is_array($value) || !isset($value['addonsMLinYA-save']) || !isset($value['addonsMLinYA-service'])) {
            return $value;
        }

        $servicesArr = Config::getServices();
        unset($value['addonsMLinYA-save']);
        if (isset($servicesArr[$value['addonsMLinYA-service']])) {

            $service = $servicesArr[$value['addonsMLinYA-service']];

            $token   = '';

            if (empty($service['tokens']) && !empty($value['addonsMLinYA-login'])) {

                $token .= $value['addonsMLinYA-login'] . ':';

                $value['addonsMLinYA-login'] = '*';

            } else if(isset($value['addonsMLinYA-login'])) {
                unset($value['addonsMLinYA-login']);
            }

            if (!empty($value['addonsMLinYA-password'])) {
                $token .= $value['addonsMLinYA-password'];
                $value['addonsMLinYA-password'] = '*';
            }

            if (!empty($token)) {
                $value['addonsMLinYA-token'] = Tokens::update($token);
            }

        } else {
            unset($value['addonsMLinYA-token'], $value['addonsMLinYA-login'], $value['addonsMLinYA-password']);
        }

        return $value;
    }
}
