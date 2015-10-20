/*Видаляємо пробіли спочатку і в кінці*/
function trimUpEmail() {
    var em=$('.signInEmail');
    em.val($.trim(em.val()));
    }
function trimInEmail() {
    var em=$('.signInEmailM');
    em.val($.trim(em.val()));
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
    var letEm=$('.letterEmail');
    letEm.val($.trim(letEm.val()));
    var letP=$('.letterPhone');
    letP.val($.trim(letP.val()));
    var letA=$('.letterAge');
    letA.val($.trim(letA.val()));
    $("div#letterFlash").hide();
}
function hideServerValidationMes(el) {
    if($(el).next('.errorMessage').is(":visible"))
        $(el).next('.errorMessage').hide();
}
function hidePassServerValidationMes(el) {
    if($(el).parent().next('.errorMessage').is(":visible"))
        $(el).parent().next('.errorMessage').hide();
}
function hideSignServerValidationMes(el) {
    if($(el).next('.errorMessage').is(":visible"))
        $(el).next('.errorMessage').hide();
    if($('#mydialog #StudentReg_password_em_').is(":visible"))
        $('#mydialog #StudentReg_password_em_').hide();
}