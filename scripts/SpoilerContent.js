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
    $('.modal').click(function(){
        dialog.modal('hide');
    });

    document.body.onclick = function (e) {
        e = e || event;
        target = e.target || e.srcElement;
        if (target.className != "text-center") {
            dialog.modal('hide');
        }
    }
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