
$( document ).ajaxComplete(function() {
var isBound = false;
$('input[type=text].dp-widget-event-blur').on('input propertychange paste', function() {
    if(!isBound){
        isBound = true;
        $(this).on('blur', function () {
          $(this).parents('form').submit();
        });
    }
});

$('.dp-widget-event-blur input[type=radio]').on('change', function() {
    $(this).parents('form').submit();
});

$(' input[type=checkbox].dp-widget-event-blur').on('click', function() {
    $(this).parents('form').submit();
});

});