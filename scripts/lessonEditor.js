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
function showAddTaskForm(taskType){
        task = taskType;
        document.getElementById('addTask').style.display = 'block';
        document.getElementById('addBlockForm').style.display = 'none';
        document.getElementById('cancelButton').style.display = 'none';
}

function showAddTestForm(testType){
        document.getElementById('testType').value = testType;
        document.getElementById('addTest').style.display = 'block';
        document.getElementById('addBlockForm').style.display = 'none';
        document.getElementById('cancelButton').style.display = 'none';
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

function addFormula(){
    document.getElementById('divAddFormula').style.display =  "block";
    OpenLatexEditor('newFormula','latex','uk_uk', 'true');
}

function cancelAddFormula(){
    document.getElementById('divAddFormula').style.display =  "none";
    location.reload();
}

function cancelAddVideo(){
    document.getElementById('divAddVideo').style.display =  "none";
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

function addVideo(){
    document.getElementById('divAddVideo').style.display =  "block";
    document.getElementById('addVideoStart').style.display = "none";
}

function deletePage(lecture, page, course){
    if (confirm('Ви впевнені, що хочете видалити сторінку ' + page + '?')) {
        $.ajax({
            type: "POST",
            url: "/lesson/deletePage",
            data: {'idLecture':lecture, 'pageOrder':page, 'idCourse':course},
            success: function(){
                $('div[name="lecturePage"]').html(response);
                return false;
            }
        });
    }
    location.reload();
}

function upPage(idLecture, pageOrder, course){
    $.ajax({
        type: "POST",
        url: "/lesson/upPage",
        data: {'idLecture':idLecture, 'pageOrder':pageOrder, 'idCourse':course},
        success: function(){
            $('div[name="lecturePage"]').html(response);
            return false;
        }
    });
}

function downPage(idLecture, pageOrder, course){
    $.ajax({
        type: "POST",
        url: "/lesson/downPage",
        data: {'idLecture':idLecture, 'pageOrder':pageOrder, 'idCourse':course},
        success: function(){
            $('div[name="lecturePage"]').html(response);
            return false;
        }
    });
}