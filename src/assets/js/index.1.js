$(document).ready(function() {
  $( document ).trigger('ajaxComplete');
});

$( document ).ajaxComplete(function() {

$('.dp-widget-event-blur').on('focusout', function() {
  $($(this).attr('data-form-selector')).submit();
});
});
