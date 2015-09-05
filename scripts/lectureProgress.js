/**
 * Created by Wizlight on 05.09.2015.
 */
$(document).ready(function(){
    $('#pointer').show();
    var position = $('#pagePressed').position();
    $('#pointer').css('margin-left',position.left+10);
});
$(document).on('mouseenter', '.pageTitle', function (e) {
    var tooltipHtml='<p>'+$(this).attr("title")+'</p>';
    if($(this).is('.pageNoAccess')) {
        tooltipHtml='<p>'+$(this).attr("title")+'<span class="noAccess"> (Закрито!)</span></p>';
    }
    $('#pointer').hide();
    $('#arrowCursor').show();
    var position = $(this).position();
    $('#arrowCursor').css('margin-left',position.left+10);
    $('#arrowCursor').css('margin-top',position.top-12);
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