/**
 * Created by Ivanna on 09.05.2015.
 */
/**
 * Created by Ivanna on 04.05.2015.
 */
function showForm(){
    $form = document.getElementById('moduleForm');
    $form.style.display = 'block';
}

function enableEdit(){
    document.getElementById('editIco').style.display = 'none';
    document.getElementById('addModuleButton').style.display = 'inline-block';
    $('.grid-view table.items td:first-child').show();
}

function hideForm(id, title){
    $form = document.getElementById(id);
    $form.style.display = 'none';
    document.getElementById(title).innerHTML = '';
}





