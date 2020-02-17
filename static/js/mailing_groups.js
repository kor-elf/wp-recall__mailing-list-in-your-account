/**
 * Получаем список групп в которых состоит пользователь
 *
 * let rcl = object (От wp-recall)
 */
function getContactInGroupsKorElf(rcl)
{
    // формируем массив передаваемых данных
       var setData = {
           action : "get_contact_in_groups", // коллбек для динамического хука
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
                   .addClass('unsubscribe')
                   .text('Отписаться');
               }

               jQuery('#list-group-mailing').find('a.list-group-mailing__loading')
               .removeClass('list-group-mailing__loading')
               .addClass('subscribe')
               .text('Подписаться');
           },
           complete: function() {

           }
       });

       return false;
}

getContactInGroupsKorElf(Rcl);

jQuery(function($){

    /**
     * Отправляем запрос, что бы отписаться от данной группы
     */
    $('#list-group-mailing').on('click', 'a.unsubscribe', function(){
        let load  = 'list-group-mailing__loading',
            _this = $(this);

        if (!_this.is('.' + load)) {
            _this.addClass(load);
        }

        // формируем массив передаваемых данных
           var setData = {
               action : "send_unsubscribe_contact_in_group", // коллбек для динамического хука
               ajax_nonce : Rcl.nonce, // проверочный ключ безопасности
               group_id : _this.data('id')
           };

           // ajax post запрос
           jQuery.post({
               url: Rcl.ajaxurl,
               dataType: "json",
               data: setData,
               success: function(data) {
                   _this.removeClass(load);
               },
               complete: function() {

               }
           });

        return false;
    });

    /**
     * Отправляем запрос, что бы подписаться в данную группу
     */
    $('#list-group-mailing').on('click', 'a.subscribe', function(){
        console.log(123);
    });

});
