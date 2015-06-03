function trimUpEmail() {
    var em=document.getElementsByClassName('signInEmail')[0];
    em.value=$.trim(em.value);
    }
function trimInEmail() {
    var em=document.getElementsByClassName('signInEmailM')[0];
    em.value=$.trim(em.value);
}
function trimExpEmail() {
    var em=document.getElementById('trimEm');
    em.value=$.trim(em.value);

    var f=document.getElementById('trimF');
    f.value=$.trim(f.value);
    var g=document.getElementById('trimG');
    g.value=$.trim(g.value);
    var l=document.getElementById('trimL');
    l.value=$.trim(l.value);
    var v=document.getElementById('trimV');
    v.value=$.trim(v.value);
    var t=document.getElementById('trimT');
    t.value=$.trim(t.value);
}
function trimNetwork() {
    var f=document.getElementById('trimF');
    f.value=$.trim(f.value);
    var g=document.getElementById('trimG');
    g.value=$.trim(g.value);
    var l=document.getElementById('trimL');
    l.value=$.trim(l.value);
    var v=document.getElementById('trimV');
    v.value=$.trim(v.value);
    var t=document.getElementById('trimT');
    t.value=$.trim(t.value);
}