/**
 * Created by Ivanna on 04.05.2015.
 */
function showForm(){
    $form = document.getElementById('lessonForm');
    $form.style.display = 'block';
}

function enableEdit(){
    document.getElementById('editIco').style.display = 'none';
    document.getElementById('addLessonButton').style.display = 'inline-block';
    $('.grid-view table.items td:first-child').show();
}

function sendForm(){
    $form = document.getElementById('lessonForm');
    $form.style.display = 'none';
}

function unableLecture(idLecture, idModule) {
    var xmlhttp;
    var id = 'unable' + idLecture;
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
            document.getElementById("lectures").innerHTML=xmlhttp.responseText;
        }
    }

    xmlhttp.open("post","/IntITA/module/unableLesson",true);
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlhttp.send("idLecture="+idLecture+"&idModule="+idModule);
}

function downLecture(idLecture) {
    alert("id = "+idLecture +" down");
    var id = 'down' + idLecture;

}

function upLecture(idLecture) {
    alert("id = "+idLecture + " up");
    var id = 'up' + idLecture;

}



