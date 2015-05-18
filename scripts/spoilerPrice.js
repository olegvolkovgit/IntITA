/**
 Функція визначає висоту n блоків вчителів
 */
function heightspoiler(n) {
    var height=0;
    for (var i = 0; i < n; i++) {
        var id='teacher'+i;
        height=height+document.getElementById(id).offsetHeight;
    }
    return height;
}
/**
 Спойлер змісту і іншого контента. Визов readmore
 */
$('article').readmore({
    maxHeight: heightspoiler(3),
    moreLink: '<span><span class="spoiler">Всі викладачі</span> <span class="spoilerTriangle"> &#9660;</span></span>',
    lessLink: '<span><span class="spoiler">Згорнути</span> <span class="spoilerTriangle"> &#9650;</span></span>'
    });
$('#spoilerPay').readmore({
    sectionCSS: 'display: block; width: 99%;',
    maxHeight: 20,
    moreLink: '<span><span class="spoiler">Всі схеми проплат</span> <span class="spoilerTriangle"> &#9660;</span></span>',
    lessLink: '<span><span class="spoiler">Згорнути</span> <span class="spoilerTriangle"> &#9650;</span></span>'
    });