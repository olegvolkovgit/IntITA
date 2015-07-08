/**
 * Created by student on 30.05.2015.
 */
$(document).on ('click', 'a[href="/IntITA/forum"]', function(){
    $.ajax({
        url: "/IntITA/forum/forumEntrance.php",
        success: function (data) {
            //alert("Прибыли данные: " + data);
            window.location.replace('/IntITA/forum', '_blank');
        },
        error: function (error) {
            alert(JSON.stringify(error));
        }
    });
    return false;
});