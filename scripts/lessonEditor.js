/**
 * Created by Ivanna on 22.07.2015.
 */
function saveNewBlock() {
    source = $('#newTextBlock').code.get;
    document.getElementById('newTextBlock').innerHTML = source;
}
function hideForm(id, title) {
    $form = document.getElementById(id);
    $form.style.display = 'none';
    document.getElementById(title).innerHTML = '';
}
function showAddTaskForm(){
    document.getElementById('addTask').style.display = 'block';
    document.getElementById('addBlockForm').style.display = 'none';
    document.getElementById('cancelButton').style.display = 'none';
}
function showAddTestForm(){
    document.getElementById('addTest').style.display = 'block';
    document.getElementById('addBlockForm').style.display = 'none';
    document.getElementById('cancelButton').style.display = 'none';
}
