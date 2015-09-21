var pageXOffset_current;

function horizontalAdjust (sidebarLesson) {
    var margin_left = 800 - window.pageXOffset;
    sidebarLesson.css("margin-left", margin_left);
    pageXOffset_current = window.pageXOffset;
}

function adjust(){
    var sidebarLesson = $("#sidebarLesson");
    var subViewLessons = $("#subViewLessons");
    var lessonBlock = $("#lessonBlock");

    if (sidebarLesson.is(":hidden") && lessonBlock[0].getBoundingClientRect().top < 40) sidebarLesson.show().css("top", "0");

    if (sidebarLesson.is(":visible")){
        if (lessonBlock[0].getBoundingClientRect().top >= 40) sidebarLesson.hide();
        if (subViewLessons[0].getBoundingClientRect().top < sidebarLesson.outerHeight() + 36) {
            if (sidebarLesson.css("position") == "fixed"){
                var bottom = subViewLessons.outerHeight();
                sidebarLesson.css({position: "absolute", top: "", bottom: bottom + "px", marginLeft: "800px"});
            }
        } else {
            if (sidebarLesson.css("position") == "absolute") {
                sidebarLesson.css({position: "fixed", top: "0", bottom: ""});
                horizontalAdjust(sidebarLesson);
            }
            if (window.pageXOffset != pageXOffset_current) horizontalAdjust(sidebarLesson);
        }
    }
}

$(document).ready(function(){
    console.log ("ready");
    $.get(
        '/forum/getPosts.php',
        {topic: idLecture},
        function(result){
            var posts = JSON.parse(result);
            for (var i = 0; i < posts.length; i++){
                $("#discussion").append(
                    "<div><div class='author'><span>" + posts[i]['author'] + "</span> &raquo; " + posts[i]['date'] +
                    "</div><div class='postText'>" + posts[i]['text'] + "</div></div>"
                );
            }
        }
    );
});

$(window).load(adjust);
$(window).scroll(adjust);