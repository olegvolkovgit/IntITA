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
    /*reset old link*/
    $("#StudentReg_facebook").val('');
    $("#StudentReg_googleplus").val('');
    $("#StudentReg_linkedin").val('');
    $("#StudentReg_vkontakte").val('');
    $("#StudentReg_twitter").val('');
    /*full link of network*/
    var fbLink=$("#tempFBLink").val();
    if(fbLink!='')
        $("#StudentReg_facebook").val($.trim('https://www.facebook.com/'+fbLink));

    var gpLink=$("#tempGPLink").val();
    if(gpLink!='')
        $("#StudentReg_googleplus").val($.trim('https://plus.google.com/'+gpLink));

    var liLink=$("#tempLILink").val();
    if(liLink!='')
        $("#StudentReg_linkedin").val($.trim('https://www.linkedin.com/'+liLink));

    var vkLink=$("#tempVKLink").val();
    if(vkLink!='')
        $("#StudentReg_vkontakte").val($.trim('http://vk.com/'+vkLink));

    var twLink=$("#tempTWLink").val();
    if(twLink!='')
        $("#StudentReg_twitter").val($.trim('https://twitter.com/'+twLink));
}
function trimNetwork() {
    /*reset old link*/
    $("#StudentReg_facebook").val('');
    $("#StudentReg_googleplus").val('');
    $("#StudentReg_linkedin").val('');
    $("#StudentReg_vkontakte").val('');
    $("#StudentReg_twitter").val('');
    /*full link of network*/
    var fbLink=$("#tempFBLink").val();
    if(fbLink!='')
        $("#StudentReg_facebook").val($.trim('https://www.facebook.com/'+fbLink));

    var gpLink=$("#tempGPLink").val();
    if(gpLink!='')
        $("#StudentReg_googleplus").val($.trim('https://plus.google.com/'+gpLink));

    var liLink=$("#tempLILink").val();
    if(liLink!='')
        $("#StudentReg_linkedin").val($.trim('https://www.linkedin.com/'+liLink));

    var vkLink=$("#tempVKLink").val();
    if(vkLink!='')
        $("#StudentReg_vkontakte").val($.trim('http://vk.com/'+vkLink));

    var twLink=$("#tempTWLink").val();
    if(twLink!='')
        $("#StudentReg_twitter").val($.trim('https://twitter.com/'+twLink));
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