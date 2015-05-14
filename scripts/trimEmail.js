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
}