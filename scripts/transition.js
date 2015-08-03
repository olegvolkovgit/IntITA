/**
 * Created by student on 30.05.2015.
 */
$(document).on('click', 'a[href="/forum"]', function(){
    $.ajax({
        url: "/forum/forumEntrance.php",
        success: function (data) {
            window.open('/forum/index.php?transition=true', '_blank');
        },
        error: function (error) {
            alert(JSON.stringify(error));
        }
    });
    return false;
});