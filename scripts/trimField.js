/*Видаляємо пробіли спочатку і в кінці*/
function trimUpEmail() {
    em=document.getElementsByClassName('signInEmail')[0];
    em.value=$.trim(em.value);
    }
function trimInEmail() {
    em=document.getElementsByClassName('signInEmailM')[0];
    em.value=$.trim(em.value);
}
function trimExpEmail() {
    em=document.getElementById('trimEm');
    em.value=$.trim(em.value);

    f=document.getElementById('trimF');
    f.value=$.trim(f.value);
    g=document.getElementById('trimG');
    g.value=$.trim(g.value);
    l=document.getElementById('trimL');
    l.value=$.trim(l.value);
    v=document.getElementById('trimV');
    v.value=$.trim(v.value);
    t=document.getElementById('trimT');
    t.value=$.trim(t.value);
}
function trimNetwork() {
    f=document.getElementById('trimF');
    f.value=$.trim(f.value);
    g=document.getElementById('trimG');
    g.value=$.trim(g.value);
    l=document.getElementById('trimL');
    l.value=$.trim(l.value);
    v=document.getElementById('trimV');
    v.value=$.trim(v.value);
    t=document.getElementById('trimT');
    t.value=$.trim(t.value);
}
function trimModuleName() {
    m=document.getElementById('newModuleName');
    m.value=$.trim(m.value);
}
function trimLectureName() {
    lec=document.getElementById('newLectureName');
    lec.value=$.trim(lec.value);
}
function trimLetterEmail() {
    var letEm=document.getElementsByClassName('letterEmail')[0];
    letEm.value=$.trim(letEm.value);
    var letP=document.getElementsByClassName('letterPhone')[0];
    letP.value=$.trim(letP.value);
    var letA=document.getElementsByClassName('letterAge')[0];
    letA.value=$.trim(letA.value);
}