$("div.stat-block h3").click (function(){
    var p = $(this).parent().children("p");
    if (p.css("display") == "none") {
        p.css("display", "block");
    }else{
        p.css("display", "none");
    }
});

$(document).ready(function(){
    var images = $("img");
    console.log(images);
    for (var i = 0; i < images.length; i++){
        images[i].src = images[i].src.replace("forum/download/file.php?avatar=", 'images/avatars/');
    }
});