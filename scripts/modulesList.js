/**
 * Created by Ivanna on 09.05.2015.
 */
/**
 * Created by Ivanna on 04.05.2015.
 */
$('.grid-view table.items td:first-child').hide();

function showForm(){
    $form = document.getElementById('moduleForm');
    $form.style.display = 'block';
}

function enableEdit(){
    document.getElementById('editIco').style.display = 'none';
    document.getElementById('addModule').style.display = 'inline-block';
    $('.grid-view table.items td:first-child').show();
}
function hideForm(id, title1, title2, title3){
    $form = document.getElementById(id);
    $form.style.display = 'none';
    document.getElementById(title1).innerHTML = '';
    document.getElementById(title2).innerHTML = '';
    document.getElementById(title3).innerHTML = '';
}

$("a").click(function (){
    var container = $('#moduleForm');
    container.hide();
});





