// App Utvikling
$(document).ready(function() {
    // Form submission
    $('form').submit(function() {
      $.post(
          $(this).attr('action'),
          $(this).serialize(),
          function(data){
              $('form .control-group:first').before(data);
              if ($('form .alert-success').length) {
                  $('form input, form select, form textarea').attr('readonly','readonly');
              }
          }
      );

      return false;
    });
});