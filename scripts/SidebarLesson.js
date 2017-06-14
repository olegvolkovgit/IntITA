// var topic_id;
// var forum_id;
// $(document).ready(function(){
//     $.get(
//         '/forum/getPosts.php',
//         {topic: idLecture},
//         function(result){
//             var information = JSON.parse(result);
//             if (information) {
//                 topic_id = information['topic_id'];
//                 forum_id = information['forum_id'];
//                 var posts = information['posts'];
//                 $("#discussionHeader").show();
//                 $("#discussion").show();
//                 //adjust();
//                 for (var i = 0; i < posts.length; i++){
//                     var post_text = posts[i]['text'];
//                     if (post_text.indexOf('src="./images/smilies') >= 0)
//                         post_text = post_text.replace(/.\/images\/smilies/g, '/forum/images/smilies');
//                     $("#discussion").append(
//                         "<div class='post'><div class='author'><span>" + posts[i]['author'] + "</span> &raquo; " + posts[i]['date'] +
//                         "</div><div class='postText'>" + post_text + "</div></div>"
//                     );
//                     $("blockquote + br").remove();
//                     $("blockquote").prev("br").remove();
//                     $("div.codebox p").remove();
//                 }
//             }
//         }
//     );
// });
//
// function scroll_discussion () {
//     var discussion = $("#discussion");
//     var current_scroll = discussion.scrollTop();
//     if (current_scroll >= discussion[0].scrollHeight - discussion[0].clientHeight) {
//         discussion.scrollTop(0);
//     }else{
//         discussion.animate({scrollTop: current_scroll + 150}, 500);
//     }
// }
// setInterval (scroll_discussion, 5000);
//
// $(document).on ("click", "#discussion a", function (){
//     window.open(this.href, "_blank");
//     return false;
// });
//
// $(document).on ("click", "#discussion", function(){
//     window.open("/forum/viewtopic.php?f=" + forum_id + "&t=" + topic_id, "_blank");
// });