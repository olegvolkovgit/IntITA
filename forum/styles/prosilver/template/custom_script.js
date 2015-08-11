$("div.stat-block h3").click (function(){
    var p = $(this).parent().children("p");
    if (p.css("display") == "none") {
        p.css("display", "block");
    }else{
        p.css("display", "none");
    }
});