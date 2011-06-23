
function showWarning(message){
    var box = '<div class="popup_error">'+message+'</div>';
       
    $(box).appendTo('#login_form');

    $('.popup_error').click(function(){
        $(this).fadeOut('slow', function(){
            });
    });
}