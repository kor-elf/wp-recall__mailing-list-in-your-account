<?php
if (!defined('ABSPATH')) die('No direct access allowed');

include_once((__DIR__) . '/Autoload.php');

/**
 * Добавляем настройки для этого дополнения
 */
\korElf\wpRecall\mailingListInYourAccount\Config::setFileAddon(__FILE__);
\korElf\wpRecall\mailingListInYourAccount\Config::setDirAddon(__DIR__);

if (is_admin()) {
    add_filter('admin_options_wprecall', '\korElf\wpRecall\mailingListInYourAccount\admin\AdminPages::wpRecallOptions');

    // Наверное удалю
    add_filter('pre_update_option', '\korElf\wpRecall\mailingListInYourAccount\admin\AdminPages::beforeUpdateOption', 10, 1);

}

add_filter('init', '\korElf\wpRecall\mailingListInYourAccount\Pages::userMenuTab');

if (defined('DOING_AJAX') && DOING_AJAX) {
    // Только авторизованные

    // Получаем список групп в которых состоит пользователь
    add_action('wp_ajax_get_contact_in_groups', '\korElf\wpRecall\mailingListInYourAccount\Ajax::getContactInGroups');

    // Отправляем запрос на отписку в данной группе
    add_action('wp_ajax_send_unsubscribe_contact_in_group', '\korElf\wpRecall\mailingListInYourAccount\Ajax::sendUnsubscribeContactInGroup');
}

/*
add_filter( 'pre_update_option', 'filter_function_name_8399', 10, 3 );
function filter_function_name_8399( $value, $option, $old_value ){
	// filter...
print_r($value);
	return $value;
}
*/



/*
add_action('init','add_tab_my_contactform');
function add_tab_my_contactform(){

    $tab_data =	array(
        'id'=>'KE_mailing_groups',
        'name'=>'Рассылки',
        'public'=>0,//делаем вкладку приватной
        'icon'=>'fa-envelope',//указываем иконку
        'output'=>'menu',//указываем область вывода
        'content'=>array(
            array( //массив данных первой дочерней вкладки
                'callback' => array(
                    'name'=>'my_contactform_recall_block',//функция формирующая контент
                )
            )
        )
    );

    rcl_tab($tab_data);

}

function my_contactform_recall_block($user_lk){
    print_r($user_lk);
    exit;
    $content = '<h3>Наша контактная форма:</h3>';
    $content .= do_shortcode('[contact-form-7 id="52" title="Контактная форма 1"]');
    return $content;
}











add_filter('admin_options_wprecall','my_addon_options');
function my_addon_options($content){

    $opt = new Rcl_Options(__FILE__);

    $content .= $opt->options(
        __('Общий заголовок блока опций'),
        array(
            $opt->options_box(
                __('Заголовок первого блока','wp-recall'),
                array(
                    //массив первой опции
                    //массив второй опции
                    //массив третье опции
                )
            ),
            $opt->options_box(
                __('Заголовок второго блока','wp-recall'),
                array(
                    //массив первой опции
                    //массив второй опции
                    //массив третье опции
                )
            )
        )
    );

    return $content;
}
*/
