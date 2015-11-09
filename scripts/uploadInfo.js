/*Виводить назву файла який загружаємо на аватарку*/
function getName (str){
 if (str.lastIndexOf('\\')){
        var i = str.lastIndexOf('\\')+1;
    }
    else{
        var i = str.lastIndexOf('/')+1;
    }
    var filename = str.slice(i);
    var uploaded = document.getElementById("avatarInfo");
    uploaded.innerHTML = filename;
    $('[data-target="avatar"]').parent().parent().hide();
}