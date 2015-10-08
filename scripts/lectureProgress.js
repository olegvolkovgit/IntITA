/**
 * Created by Wizlight on 05.09.2015.
 */
$(document).ready(function(){
    $('#pointer').show();
    var position = $('#pagePressed').position();
    $('#pointer').css('margin-top',-12);
    $('#pointer').css('margin-left',position.left+10);
});
$(document).on('mouseenter', '.pageTitle', function (e) {
    var tooltipHtml='<p>'+$(this).attr("title")+'</p>';
    if($(this).is('.pageNoAccess')) {
        tooltipHtml='<p class="titleNoAccess">'+$(this).attr("title")+'<span class="noAccess"> ('+partNotAvailable+')</span></p>';
    }
    $('#pointer').hide();
    $('#arrowCursor').show();
    var position = $(this).position();
    $('#arrowCursor').css('margin-top',-12);
    $('#arrowCursor').css('margin-left',position.left+10);
    $('#tooltip').html(tooltipHtml);
    $('#labelBlock').hide();
    $('#tooltip').css('display','inline-block');
});
$(document).on('mouseleave', '.pageTitle', function (e) {
    $('#pointer').show();
    $('#arrowCursor').hide();
    $('#tooltip').hide();
    $('#labelBlock').show();
});