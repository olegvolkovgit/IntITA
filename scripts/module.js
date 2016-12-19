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