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
function showAddTaskForm(taskType, isFirst){
    if(isFirst == 0){
        alert('У цьому занятті вже є підсумковий тест або задача. Щоб додати нову підсумкову задачу, потрібно видалити існуючу задачу чи тест.');
    } else {
        task = taskType;
        document.getElementById('addTask').style.display = 'block';
        document.getElementById('addBlockForm').style.display = 'none';
        document.getElementById('cancelButton').style.display = 'none';
    }
}
function showAddTestForm(testType, isFirst){
    if(isFirst == 0){
        alert('У цьому занятті вже є підсумковий тест або задача. Щоб додати новий підсумковий тест, потрібно видалити існуючу задачу чи тест.');
    } else {
        document.getElementById('testType').value = testType;
        document.getElementById('addTest').style.display = 'block';
        document.getElementById('addBlockForm').style.display = 'none';
        document.getElementById('cancelButton').style.display = 'none';
    }
}

function enableLessonEdit(block){
    editButton = 'editIco' + block;
    //addBlockButton = 'addTextBlock' + block;
    document.getElementById(editButton).style.display = 'none';
    //document.getElementById(addBlockButton).style.display = 'inline-block';
    $.ajax({
        type: "POST",
        url: "/IntITA/lesson/showPagesList",
        data: {'idLecture':idLecture},
        success: function(){
            $.fn.yiiListView.update('lecturePageTabs');
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

function addFormula(){
    $('select').val('10');
    document.getElementById('blockForm').style.display = "none";
    document.getElementById('divAddFormula').style.display =  "block";
    OpenLatexEditor('newFormula','latex','uk_uk', 'true');
}

function cancelAddFormula(){
    document.getElementById('divAddFormula').style.display =  "none";
    location.reload();
}
function fieldValidation(){
    var val = $("#newFormula").val().trim();
    if(val=="\\[\\]"){
        alert('Формула не може бути пуста');
        $("#addFormulaButton").attr('disabled',true);
    }
}
function buttonFormulaEnabled(){
    $("#addFormulaButton").removeAttr('disabled');
}

function addTextBlock(type){
    document.getElementById('addBlock').style.display = 'block';
    document.getElementById('textBlockForm').style.display = 'block';
    document.getElementById('blockType').value = type;
}