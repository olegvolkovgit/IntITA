/**
 * Created by Wizlight on 19.08.2015.
 */
/*����� ��� �� ��������� input[file]*/
function selectLogo(){
    var img=$("#logoModule");
    img.trigger('click');
}
/*�������� ����� ����� ���� ��������� �� ��������*/
function getImgName (str){
    if (str.lastIndexOf('\\')){
        var i = str.lastIndexOf('\\')+1;
    }
    else{
        var i = str.lastIndexOf('/')+1;
    }
    var filename = str.slice(i);
    var uploaded = document.getElementById("avatarInfo");
    uploaded.innerHTML = filename;
}
function redirectToProfile() {
    $.cookie('openProfileTab', 5, {'path': "/"});
}
function signFreeModule(url, user, module) {
    data = {
        user: user,
        module: module
    };
    $.post(url, data, function () {
        })
        .done(function (response) {
            bootbox.alert(response, function() {
                location.reload();
            });
        })
        .fail(function () {
            bootbox.alert("На сайті виникла помилка.\n" +
                "Спробуйте перезавантажити сторінку або напишіть нам на адресу " + adminEmail);
        })
        .always(function () {
            },
            "json"
        );
}