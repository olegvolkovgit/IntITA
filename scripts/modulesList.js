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
function hideForm(id, title){
    $form = document.getElementById(id);
    $form.style.display = 'none';
    document.getElementById(title).innerHTML = '';
}

$(document).mouseup(function (e) {
    var container = $('#moduleForm');
    if (container.has(e.target).length === 0){
        container.hide();
    }
});





