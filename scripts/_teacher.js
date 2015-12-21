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
            alert("Вибачте, але на сайті виникла помилка. " +
            "Спробуйте зайти до кабінету пізніше або зв'яжіться з адміністратором сайту.");
            //location.reload();
        }
    });
}

function send(url, user, receivers){
    clearDashboard();

    var jsonData = {
        "user" : user,
        "subject" : document.getElementById("subject"),
        "text" : document.getElementById("text"),
        receivers: receivers
    };

    $.ajax({
        url: url,
        data: jsonData,
        success: function (data) {
            container = $('#pageContainer');

            container.html('');
            container.html(data);
        },
        error: function () {
            alert("Вибачте, але на сайті виникла помилка. " +
            "Спробуйте зайти до кабінету пізніше або зв'яжіться з адміністратором сайту.");
            //location.reload();
        }
    });
}

function clearDashboard()
{
    if(document.getElementById("dashboard"))
    document.getElementById("dashboard").style.display = "none";
}
