/**
 * Created by Ivanna on 11.05.2015.
 */
function wrt(x)
{
    $(".razv").html(x);
}

function xexx()
{
    $('.bgBlue').hide();
}
function courseTypeSpoiler(el) {
    if ($('#typeList').css('display')=='none') {
        $('#trg').text("\u25B2");
    }
    if($('#typeList').css('display')=='block'){
        $('#trg').text("\u25BC");
    }
    $('#typeList').toggle('normal');
    return false;
};