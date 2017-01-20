/**------------------recall-------------------------*/
$(document).ready(function() {
    $('.spoiler-body').hide();
    $('.spoiler-title').click(function(){
        $(this).toggleClass('opened').toggleClass('closed').next().slideToggle();
        if($(this).hasClass('opened')) {
            var a=document.getElementById('id1').value;
            $(this).html(a + "\u25B2");
        }
        else {
            var b=document.getElementById('id2').value;
            $(this).html(b + "\u25BC");
        }
    });
});
function hideRecall(spoiler){
    $(spoiler).parent().prev('.spoiler-title').toggleClass('opened').toggleClass('closed').next().slideToggle();
    if($(spoiler).parent().prev('.spoiler-title').hasClass('opened')) {
        var a=document.getElementById('id1').value;
        $(spoiler).parent().prev('.spoiler-title').html(a + "\u25B2");
    }
    else {
        var b=document.getElementById('id2').value;
        $(spoiler).parent().prev('.spoiler-title').html(b + "\u25BC");
    }
}

// celebre
function  diploma_dialog() {

    bootbox.alert({
        message:'<div class="diploma-container">'+
                    '<div class="diploma-logo" >'+
                        '<img src="pictures/logo_diploma_intita.png" alt="logo_diploma_intita">'+
                        '<div class="logo-academy">'+'it academy'+'</div>'+
                    '</div>'+
                    '<h1 class="diploma-header">'+'diploma'+'</h1>'+
                    '<p class="certificate">'+'This Sertifies That:'+'</p>'+
                    '<h2 class="diploma-owner-name">'+'Ihor Morgunov'+'</h2>'+
                    '<p class="student_achievements">'+'has successfully completed the requirements for the'+
                        '<br>'+'<span>'+'certificate program'+'</span>'+
                        '<br>'+'in'+'<span>'+'information technologies'+'</span>'+
                        '<br>'+ 'and meets strong junior level of programmer'+'</p>'+
                    '<p class="course">'+'course:'+'</p>'+
                    '<h2 class="diploma-owner-name">'+'Web developer'+'('+'<span>'+'php'+'</span>'+')'+'</h2>'+
                    '<div class="sign">'+
                        '<ul>'+
                            '<li>'+'CEO: Roman Melnyk'+'</li>'+
                            '<li>'+'Date: December, 27, 2017'+'</li>'+
                        '</ul>'+
                        '<img src="pictures/sign.png" alt="director_sign">'+
                        '<p class="diplom-number">'+'A11 № 000002-001'+'</p>'+
                    '</div>'+
                '</div>',
        size: 'large'
    });
// // do something in the background
   $('.modal-footer > .btn').hide();
    $('.modal-footer').css('border-top', 'none');
    $('.modal-body').css('padding', '0');
    $('.modal-footer').css('padding', '0');
}
// celebre
