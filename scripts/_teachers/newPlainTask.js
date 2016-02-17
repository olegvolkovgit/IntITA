/**
 * Created by Quicks on 10.12.2015.
 */

function changeConsult(id,url)
{
    $jq.ajax({
        url: url,
        type: "POST",
        data : {id: id},
        success: function (data) {
            fillContainer(data);
        }
    });
}

function removeConsult(id,url)
{
    bootbox.confirm('Ви впевнені що хочете видалити консультанта?', function(result) {
        if (result != null) {
            $jq.ajax({
                url: url,
                type: "POST",
                data : {id: id},
                success: function (data) {
                    load(basePath + "/_teacher/teacher/manageConsult");
                }
            });
        }
    });
};

function showPlainTaskWithoutTrainer(url)
{
    $jq.ajax({
        url: url,
        success: function(data) {
            fillContainer(data);
        }
    })
}

function chooseTrainer(id,url)
{
    $jq.ajax({
        url: url,
        data : {id: id},
            success: function (data) {
                fillContainer(data);
            }
    });
}

function sendForm(url)
{
    var consult = $jq('#consult').val();
    var idPlainTask = $jq('#idPlainTask').val();

    $jq.ajax({
        url: url,
        type: "POST",
        data : { 'consult': consult,'idPlainTask' : idPlainTask},
        success: function (data) {
            fillContainer(data);
            location.reload();
        }
    })
}

function showPlainTaskAnswer(url,idTeacher)
{
    $jq.ajax({
        url: url,
        type: "POST",
        data : { 'idTeacher': idTeacher},
        success: function (data) {
            fillContainer(data);
            $jq("#pageTitle").html("Задачі до перевірки");
        }
    })
}

function showPlainTask(url,plainTaskId)
{
    $jq.ajax({
        url: url,
        type: "POST",
        data : { 'idPlainTask': plainTaskId},
        success: function (data) {
            fillContainer(data);
        }
    });
}

function markPlainTask(url)
{
    var id = $jq('#plainTaskId').val();
    var mark = $jq('#mark').val();
    var comment = $jq('[name = comment]').val();
    var userId = $jq('#userId').val();
    $jq.ajax({
        url: url,
        type: "POST",
        data : { 'idPlainTask': id,'mark' : mark,'comment' : comment,'userId' : userId},
        success : function () {
            showDialog('Ваша оцінка записана в базу');
        },
        error : function()
        {
            showDialog();
        },
        complete: function()
        {
            location.reload();
        }
    });

}

function addTrainer(url)
{
    var id = document.getElementById('user').value;
    var trainerId = $jq("select option:selected").val();
    $jq.ajax({
        url: url,
        type: "POST",
        data : { 'userId': id, 'trainerId' : trainerId},
        success: function (data) {
            location.reload();
        }
    });
}

function removeTrainer(url)
{
    if(confirm('Ви впевнені що хочете видалити тренера?'))
    {
        $jq.ajax({
            url: url,
            success: function (data) {
                location.reload();
            }
        })
    }
}

function fillContainer(data)
{
    container = $jq('#pageContainer');
    container.html('');
    container.html(data);
}

function loadUserWithoutTrainer(url)
{
    $jq.ajax({
        url: url,
        type: "POST",
        success: function (data) {
            fillContainer(data);
        }
    })
}
