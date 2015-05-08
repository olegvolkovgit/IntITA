///*Парольне око*/ title="Показати/сховати пароль"
$(function(){
    $(".passEye").append('<span class="eye" ></span>');
 
    $(".passEye .eye").click(function() {
        $(this).toggleClass('openEye');
        var passVal = $(this).prev().prop('type');
        if ( passVal === 'password' ) 
        {
            $(this).prev().prop('type', 'text');  
        }else { 
                $(this).prev().prop('type', 'password'); 
              }
    });
});