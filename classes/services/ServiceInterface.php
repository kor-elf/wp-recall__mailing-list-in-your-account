<?php
namespace korElf\wpRecall\mailingListInYourAccount\services;

interface ServiceInterface
{

    /**
     * Получение группы рассылок
     *
     * return array
     */
    public static function getGroups();

    /**
     * Поиск контактов по e-mail
     *
     * $email = string
     *
     * return object
     */
    public static function getSearchContact($email);
    
}
