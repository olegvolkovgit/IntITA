/**
 * Created by Wizlight on 06.09.2015.
 */
/**-------Спойлер змісту і іншого контента--------*/
function chapterSpoiler(el,showWord, hideWord) {
    var nameSpoiler = $(el).children("span:first").text();

    if (nameSpoiler == showWord) {
        $(el).children("span:first").text(hideWord);
        $(el).children("span:last").text("\u25B2");
    } else if (nameSpoiler == hideWord) {
        $(el).children("span:first").text(showWord);
        $(el).children("span:last").text("\u25BC");
    }
    $(el).next('.spoilerBody').toggle('normal');
    return false;
};