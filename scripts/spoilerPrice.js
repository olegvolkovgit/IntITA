/**
 Спойлер змісту і іншого контента. Визов readmore
 */
$('article').readmore({
    maxHeight: 360,
    moreLink: '<span><span class="spoiler">Всі викладачі</span> <span class="spoilerTriangle"> &#9660;</span></span>',
    lessLink: '<span><span class="spoiler">Згорнути</span> <span class="spoilerTriangle"> &#9650;</span></span>'
});
$('#spoilerPay').readmore({
    sectionCSS: 'display: block; width: 99%;',
    maxHeight: 20,
    moreLink: '<span><span class="spoiler">Всі схеми проплат</span> <span class="spoilerTriangle"> &#9660;</span></span>',
    lessLink: '<span><span class="spoiler">Згорнути</span> <span class="spoilerTriangle"> &#9650;</span></span>'
});
