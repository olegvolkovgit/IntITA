function loadPage(url) {
    $.ajax({
        url: url,
        dataType: "json",
        success: function (json) {
            container = $('#pageContainer');
            container.html('');

            switch(json.title){
                case 'trainer':
                    fillTrainer(json);
                    break;
                case 'consultant':
                    fillConsultant(json);
                    break;
                case 'author':
                    fillAuthor(json);
                    break;
                case 'leader':
                    fillLeader(json);
                    break;
                case 'accountant':
                    fillAccountant(json);
                    break;
                case 'admin':
                    fillAdmin(json);
                    break;
                case 'dashboard':
                    fillDashboard(json);
            }
        },
        error: function () {
            alert("Вибачте, але на сайті виникла помилка. " +
            "Спробуйте зайти до кабінету пізніше або зв'яжіться з адміністратором сайту.");
            location.reload();
        }
    });
}

function fillTrainer(json){
    container.append('Role: ' + json.title + '<br/>')
        .append('Teacher: ' + json.teacher + '</b><br/><br/><br/>');
    var params = json.params;
    params.forEach(function(param, i, params) {
        container.append(i + ".Student: " + param.id + "<br>");
    });
}

function fillAuthor(json){
    container.append('Role: ' + json.title + '<br/>')
        .append('Teacher: ' + json.teacher + '</b><br/>');
}

function fillConsultant(json){
    container.append('Role: ' + json.title + '<br/>')
        .append('Teacher: ' + json.teacher + '</b><br/>');
}

function fillLeader(json){
    container.append('Role: ' + json.title + '<br/>')
        .append('Teacher: ' + json.teacher + '</b><br/>');
}

function fillAdmin(json){
    container.append('Role: ' + json.title + '<br/>')
        .append('Teacher: ' + json.teacher + '</b><br/>');
}

function fillAccountant(json){
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
            //
            //switch(json.title){
            //    case 'trainer':
            //        fillTrainer(json);
            //        break;
            //    case 'consultant':
            //        fillConsultant(json);
            //        break;
            //    case 'author':
            //        fillAuthor(json);
            //        break;
            //    case 'leader':
            //        fillLeader(json);
            //        break;
            //    case 'accountant':
            //        fillAccountant(json);
            //        break;
            //    case 'admin':
            //        fillAdmin(json);
            //        break;
            //}
        },
        error: function () {
            alert("Вибачте, але на сайті виникла помилка. " +
            "Спробуйте зайти до кабінету пізніше або зв'яжіться з адміністратором сайту.");
            //location.reload();
        }
    });
}

function fillDashboard(json){
    container.append('Dashboard!<br>')
        .append('Teacher: ' + json.teacher + '</b><br/>');
}