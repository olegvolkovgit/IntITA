/**
 * Created by Quicks on 12.11.2015.
 */

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
            url: "/IntIta/plainTask/saveAnswer",
            data: {'idLecture':idLecture,'answer':answer},
            success: function(JSON){
                  alert('Ваша відповідь буде оброблена в найближчий час');

            }
        });
    }

}

