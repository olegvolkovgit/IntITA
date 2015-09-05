/**
 * Created by Wizlight on 05.09.2015.
 */
$(document).ready(function(){
    $('#pointer').show();
    $('#pointer').offset({top:$('#pagePressed').offset().top-23, left:$('#pagePressed').offset().left+10});
});
$(document).on('mouseenter', '.pageTitle', function (e) {
    var tooltipHtml='<p>'+$(this).attr("title")+'</p>';
    if($(this).is('.pageNoAccess')) {
        tooltipHtml='<p>'+$(this).attr("title")+'<span class="noAccess"> (Закрито! Ви не пройшли попередні кроки)</span></p>';
    }
    $('#pointer').hide();
    $('#arrowCursor').show();
    $('#arrowCursor').offset({top:$(this).offset().top-23, left:$(this).offset().left+10});
    $('#tooltip').html(tooltipHtml);
    $('#tooltip').show();
    $('#labelBlock').hide();
});
$(document).on('mouseleave', '.pageTitle', function (e) {
    $('#pointer').show();
    $('#arrowCursor').hide();
    $('#tooltip').hide();
    $('#labelBlock').show();
});