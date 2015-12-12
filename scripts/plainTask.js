/**
 * Created by Quicks on 12.11.2015.
 */

function sendPlainTaskAnswer(idBlock)
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
            url: "/IntITA/plainTask/saveAnswer",
            data: {'idBlock':idBlock,'answer':answer},
            success: function(){
                  alert('Ваша відповідь буде оброблена в найближчий час');

            }
        });
    }

}

