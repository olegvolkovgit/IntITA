/**
 * Created by Ivanna on 04.05.2015.
 */
function showForm(){
    $form = document.getElementById('lessonForm');
    $form.style.display = 'block';
}

function enableEdit(){
    document.getElementById('editIco').style.display = 'none';
    document.getElementById('addLessonButton').style.display = 'inline-block';
    $('.grid-view table.items td:first-child').show();
}

function hideForm(id, title){
    $form = document.getElementById(id);
    $form.style.display = 'none';
    document.getElementById(title).innerText = '';
}



