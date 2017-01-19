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
    // celebre


    // $(document).mouseup(function (e) {
    //     var container = $(".text-center");
    //     if (container.has(e.target).length === 0){
    //         container.hide();
    //     }
    // });

        $(document).mouseup(function (e){ // событие клика по веб-документу
            var div = $(".text-center"); // тут указываем ID элемента
            if (!div.is(e.target) // если клик был не по нашему блоку
                && div.has(e.target).length === 0) { // и не по его дочерним элементам
                div.hide(); // скрываем его
            }
        });
        // $(document).click(function(event) {
        //     if ($(event.target).closest('.text-center').length) return;
        //     $("p").hide("slow");
        //     event.stopPropagation();
        // });
    // celebre
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

    var dialog = bootbox.dialog({
        message: '<p class="text-center">Please wait while we do something...</p>',
        closeButton: false
    });
// // do something in the background
    //dialog.modal('hide');
}
// celebre