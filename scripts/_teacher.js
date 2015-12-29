function loadPage(url,role) {
    var userRole = role.toLowerCase();
    $.ajax({
        url: url,
        success: function (data) {
            container = $('#pageContainer');
            container.html(data);
        },
        error: function () {
            alert("Вибачте, але на сайті виникла помилка. " +
            "Спробуйте зайти до кабінету пізніше або зв'яжіться з адміністратором сайту.");
            //location.reload();
        }
    });
}

function fillTrainer(json){
    clearDashboard();
    container.html(json);
}

function fillAuthor(json){
    clearDashboard();
    container.append('Role: ' + json.title + '<br/>')
        .append('Teacher: ' + json.teacher + '</b><br/>');
}

function fillConsultant(json){
    clearDashboard();
    container.append('Role: ' + json.title + '<br/>')
        .append('Teacher: ' + json.teacher + '</b><br/>');
}

function fillLeader(json){
    clearDashboard();
    container.append('Role: ' + json.title + '<br/>')
        .append('Teacher: ' + json.teacher + '</b><br/>');
}

function fillAdmin(json){
    clearDashboard();
    container.append('Role: ' + json.title + '<br/>')
        .append('Teacher: ' + json.teacher + '</b><br/>');
}

function fillAccountant(json){
    clearDashboard();
    container.append('Role: ' + json.title + '<br/>')
        .append('Teacher: ' + json.teacher + '</b><br/>');
}

function getTeacherUserInfo(url){
    $.ajax({
        url: url,
        dataType: "json",
        success: function (json) {
            container = $('#pageContainer');
            container.html('');

            container.append('Name: ' + json.name + '<br/>');
        },
        error: function () {
            alert("Вибачте, але на сайті виникла помилка. " +
            "Спробуйте зайти до кабінету пізніше або зв'яжіться з адміністратором сайту.");
            //location.reload();
        }
    });
}

//function fillDashboard(json){
//    document.getElementById("dashboard").style.display = "block";
//    container.append('Dashboard!<br>')
//        .append('Teacher: ' + json.teacher + '</b><br/>');
//}

function load(url){
    clearDashboard();
    $.ajax({
        url: url,
        success: function (data) {
            container = $('#pageContainer');
            container.html('');
            container.html(data);
        },
        error: function () {
            showDialog();
            //alert("Вибачте, але на сайті виникла помилка. " +
            //"Спробуйте зайти до кабінету пізніше або зв'яжіться з адміністратором сайту.");
            //location.reload();
        }
    });
}

function clearDashboard()
{
    if(document.getElementById("dashboard"))
    document.getElementById("dashboard").style.display = "none";
}
