/*Видаляємо пробіли спочатку і в кінці*/
function trimUpEmail() {
    var em=document.getElementsByClassName('signInEmail')[0];
    em.value=$.trim(em.value);
    }
function trimInEmail() {
    var em=document.getElementsByClassName('signInEmailM')[0];
    em.value=$.trim(em.value);
}
function trimExpEmail() {
    var em=$('.trimEm');
    em.val(em.val());
    var vkLink=$("#StudentReg_vkontakte");
    if(vkLink.val()!=''){
        if(vkLink.val().indexOf('vk.com/')===0){
            vkLink.val('http://'+vkLink.val());
        }
    }
}
function trimNetwork() {
var vkLink=$("#StudentReg_vkontakte");
    if(vkLink.val()!=''){
        if(vkLink.val().indexOf('vk.com/')===0){
            vkLink.val('http://'+vkLink.val());
        }
    }
}
function trimModuleName() {
    var m=document.getElementById('titleUa');
    m.value=$.trim(m.value);

    var m=document.getElementById('titleRu');
    m.value=$.trim(m.value);

    var m=document.getElementById('titleEn');
    m.value=$.trim(m.value);
}
function trimLectureName() {
    var lec=document.getElementById('titleUa');
    lec.value=$.trim(lec.value);

    var lec=document.getElementById('titleRu');
    lec.value=$.trim(lec.value);

    var lec=document.getElementById('titleEn');
    lec.value=$.trim(lec.value);
}
function trimLetterEmail() {
    var letEm=document.getElementsByClassName('letterEmail')[0];
    letEm.value=$.trim(letEm.value);
    var letP=document.getElementsByClassName('letterPhone')[0];
    letP.value=$.trim(letP.value);
    var letA=document.getElementsByClassName('letterAge')[0];
    letA.value=$.trim(letA.value);
    $("div#letterFlash").hide();
}