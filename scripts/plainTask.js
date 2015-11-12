/**
 * Created by Quicks on 12.11.2015.
 */

function unablePlainTask(pageId){
    if (confirm('Ви впевнені, що хочете видалити задачу?')) {
        $.ajax({
            type: "POST",
            url: "/plainTask/unablePlainTask",
            data: {'pageId':pageId},
            success: function(){
                $('div[name="lecturePage"]').html(response);
                return false;
            }
        });
    }
    location.reload();
}

function sendPlainTaskAnswer(idLecture)
{
    var answer = $('[name=answer]').val();
    if(answer.trim() == '')
    {
        alert('Спочатку дайте відповідь');
    }
    else
    {
        $.ajax({
            type: "POST",
            url: "/plainTask/saveAnswer",
            data: {'idLecture':idLecture,'answer':answer},
            success: function(JSON){
                  alert('Ваша відповідь буде оброблена в найближчий час');

            }
        });
    }

}