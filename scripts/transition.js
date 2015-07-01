/**
 * Created by student on 30.05.2015.
 */
$(document).on ('click', 'a[href="/forum"]', function(){
    $.ajax({
        url: "/forum/forumEntrance.php",
        success: function (data) {
            //alert("Прибыли данные: " + data);
            window.location.replace('/forum');
        },
        error: function (error) {
            alert(JSON.stringify(error));
        }
    });
    return false;
});