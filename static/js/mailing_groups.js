/**
 * Получаем список групп в которых состоит пользователь
 *
 * let rcl = object (От wp-recall)
 */
function getContactInGroups(rcl)
{
    // формируем массив передаваемых данных
       var setData = {
           action : "gas_callback", // коллбек для динамического хука
           ajax_nonce : rcl.nonce // проверочный ключ безопасности
       };

       // ajax post запрос
       jQuery.post({
           url: rcl.ajaxurl,
           dataType: "json",
           data: setData,
           success: function(data) {
               for (groupId in data) {
                   jQuery('#group-mailing-' + data[groupId]).find('a.list-group-mailing__loading')
                   .removeClass('list-group-mailing__loading')
                   .text('Отписаться');
               }

               jQuery('#list-group-mailing').find('a.list-group-mailing__loading')
               .removeClass('list-group-mailing__loading')
               .text('Подписаться');
           },
           complete: function() {

           }
       });

       return false;
}

getContactInGroups(Rcl);
