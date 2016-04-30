/**
 * Created by Ivanna on 22.07.2015.
 */
task = 'plain';

function saveNewBlock() {
    source = $('#newTextBlock').code.get;
    document.getElementById('newTextBlock').innerHTML = source;
    document.getElementById('addBlockForm').style.visibility = "visible";
}
function hideForm(id, title) {
    $form = document.getElementById(id);
    $form.style.display = 'none';
    document.getElementById(title).innerHTML = '';
}
function hideFormCKE(id) {
    $form = document.getElementById(id);
    $form.style.display = 'none';
}
function showAddTaskForm(taskType){
    task = taskType;
    document.getElementById('addTask').style.display = 'block';
    document.getElementById('addBlockForm').style.display = 'none';
    document.getElementById('cancelButton').style.display = 'none';
    document.getElementById('buttonsPanel').style.display = 'none';
}
function showAddTaskFormCKE(taskType){
    task = taskType;
    document.getElementById('addTask').style.display = 'block';
    document.getElementById('cancelButton').style.display = 'none';
    document.getElementById('buttonsPanel').style.display = 'none';
}

function showAddSkipTaskForm(){
    document.getElementById('addSkipTask').style.display = 'block';
    document.getElementById('addBlockForm').style.display = 'none';
    document.getElementById('cancelButton').style.display = 'none';
    document.getElementById('buttonsPanel').style.display = 'none';
}
function showAddSkipTaskFormCKE(){
    document.getElementById('addSkipTask').style.display = 'block';
    document.getElementById('cancelButton').style.display = 'none';
    document.getElementById('buttonsPanel').style.display = 'none';
}

function showAddTestForm(testType){
        document.getElementById('testType').value = testType;
        document.getElementById('addTest').style.display = 'block';
        document.getElementById('addBlockForm').style.display = 'none';
        document.getElementById('cancelButton').style.display = 'none';
    document.getElementById('buttonsPanel').style.display = 'none';
}
function showAddTestFormCKE(testType){
    document.getElementById('testType').value = testType;
    document.getElementById('addTest').style.display = 'block';
    document.getElementById('cancelButton').style.display = 'none';
    document.getElementById('buttonsPanel').style.display = 'none';
}
function showAddPlainTaskForm(testType){
    document.getElementById('testType').value = testType;
    document.getElementById('addPlainTask').style.display = 'block';
    document.getElementById('addBlockForm').style.display = 'none';
    document.getElementById('cancelButton').style.display = 'none';
    document.getElementById('buttonsPanel').style.display = 'none';
}
function showAddPlainTaskFormCKE(testType){
    document.getElementById('plainTaskType').value = testType;
    document.getElementById('addPlainTask').style.display = 'block';
    document.getElementById('cancelButton').style.display = 'none';
    document.getElementById('buttonsPanel').style.display = 'none';
}

function enableLessonEdit(block, course){
    editButton = 'editIco' + block;
    document.getElementById(editButton).style.display = 'none';
    $.ajax({
        type: "POST",
        url: "/lesson/showPagesList",
        data: {'idLecture':idLecture, 'idCourse':course},
        success: function(response){
            $('div[name="lecturePage"]').html(response);
                return false;
        }
    });
}
function enableLessonPreview(lecture, course, editPage){
    if(editPage===0) {
        location.href = document.location.href;
    } else if($("div").is('.pagesList')) {
        location.href = window.location.href.slice(0,window.location.href.indexOf('\?')) + '?page=' + editPage + '&editPage=' + editPage;
    } else{
        location.href = window.location.href.slice(0,window.location.href.indexOf('\?')) + '?page=' + editPage;
    }
}

function showPageEdit(lecture, pageOrder){
    $.ajax({
        type: "POST",
        url: "/lesson/showPageEditor",
        data: {'idLecture':lecture, 'pageOrder':pageOrder},
        success: function(response){
            $('div[name="lecturePage"]').html(response);
            return false;
        }
    });
}

function showForm(){
    document.getElementById('textBlockForm').style.display = 'block';
}

function showBlockForm(){
    document.getElementById('blockForm').style.display = 'block';
}

function addFormula(type){
    document.getElementById('addBlock').style.display = 'block';
    document.getElementById('textBlockForm').style.display = 'block';
    document.getElementById('blockForm').style.display = 'block';
    document.getElementById('blockType').value = type;
    $('#addBlock').find('.redactor-editor').attr('data-target','insert');

    EqEditor.embed('toolbar','','full','uk-uk');
    EqEditor.add(new EqTextArea('equation', 'formulaContainer'),false);
    //OpenLatexEditor('formulaContainer','latex','uk_uk', true);
}

function cancelAddFormula(){
    document.getElementById('divAddFormula').style.display =  "none";
    location.reload();
}

function cancelAddVideo(){
    document.getElementById('divAddVideo').style.display =  "none";
    document.getElementById('addVideoStart').style.display = "block";
}

function fieldValidation(){
    var val = $("#newFormula").val().trim();
    if(val=="\\[\\]"){
        alert('Формула не може бути пуста');
        $("#addFormulaButton").attr('disabled',true);
    }
}

function addTextBlock(type){
    document.getElementById('addBlock').style.display = 'block';
    document.getElementById('textBlockForm').style.display = 'block';
    document.getElementById('blockForm').style.display = 'block';
    document.getElementById('blockType').value = type;
    $('#addBlock').find('.redactor-editor').attr('data-target','insert');
    document.getElementById('formulaContainer').focus();
}

function addVideoInput(){
    document.getElementById('divAddVideo').style.display =  "block";
    document.getElementById('addVideoStart').style.display = "none";
}

$(document).ready(function(){
    document.getElementById('addBlock').style.display = 'none';
});

