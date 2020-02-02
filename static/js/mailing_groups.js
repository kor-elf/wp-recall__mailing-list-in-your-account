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
               console.log(data);
           },
           complete: function() {

           }
       });

       return false;
}

getContactInGroups(Rcl);
