$(function(){
  $('#login_link').click(function(){
    $('#login').slideToggle('slow');
    $('#login_message').hide();
  });

  function showWarning(message){
    var box = '<div class="popup_error">'+message+'</div>';
    $(box).appendTo('#login_message');
    $('#login_message').show();
    $('.popup_error').fadeOut(10000);
  }

  $("#login_form").submit(function() {
    $('#progress').show();
    $.post('login', {
      username:$('#username').val(), 
      password:$('#password').val()
    },
    function(data){
      $('#progress').hide();
      if(data.is_logged_in === true){
        window.location = ''+data.role;
      }else{
        showWarning(data.message);
      }
    });
    return false;
  });
                
  $('#loader').remove();
});