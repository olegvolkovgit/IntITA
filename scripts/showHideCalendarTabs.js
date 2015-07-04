/**
 * Created by Wizlight on 24.04.2015.
 */
/*при клику на ссылку открывается календарь*/
function showCalendar(teacherId){
    var container=$(".timeBlock").children("div");
    container.hide();
    var infblock=$(".consinf").children("div");
    infblock.hide();
    var calendarId='#dateTimePicker'+teacherId;
        $(calendarId).focus();
}
/*при выборе даты открывается блок с выбором время*/
function showTime(teacherId) {
    var dateday='dateconsajax'+teacherId;
    var calendarId='dateTimePicker'+teacherId;
    var butId='#hiddenAjaxButton'+teacherId;
    var  timeId='#timeConsultation'+teacherId;
    document.getElementById(dateday).value = document.getElementById(calendarId).value;
    $(butId).click();
    function second_passed() {
        $(timeId).css('display', 'block');
    }
    setTimeout(second_passed,400);
}
/*при нажатии на кнопку назад - открывается календарь*/
function goBack(teacherId) {
    var timeId='#timeConsultation'+teacherId;
    var calendarId='#dateTimePicker'+teacherId;
    $(timeId).css('display', 'none');
    $(calendarId).focus();
}
/*при нажатии на кнопку даты в окне время - открывается календарь*/
function chooseDate(teacherId) {
    var timeId='#timeConsultation'+teacherId;
    var calendarId='#dateTimePicker'+teacherId;
    $(timeId).css('display', 'none');
    $(calendarId).focus();
}
/*при нажатии на кнопку далее - блок время закрывается, открывается информативное окно c переданными ему интервалами консультаций*/
function goNext(teacherId) {
    var timeId='#timeConsultation'+teacherId;
    var gridId='timeGrid'+teacherId;
    var textId='consInfText'+teacherId;
    var constext='constext'+teacherId;
    var calendarId='dateTimePicker'+teacherId;
    var dateconsId='datecons'+teacherId;
    var timeconsId='timecons'+teacherId;
    var infoId='#consultationInfo'+teacherId;
    if (parseTable(gridId).length !== 0) {
        var str = parseTable(gridId);
        $(timeId).css('display', 'none');
        var textinfo = document.getElementById(textId).value;
        var context = document.getElementById(constext);
        var dateinfo = document.getElementById(calendarId).value + ' о ' + str.join(', ');
        context.innerHTML = dateinfo + textinfo;
        document.getElementById(dateconsId).value = document.getElementById(calendarId).value;
        document.getElementById(timeconsId).value = str;
        $(infoId).css('display', 'block');
    }
}
/*при клику на кнопку информационного окна о консультации оно закрывается*/
$('#consultationButton').click(function() {
    document.getElementById('consultationInfo').style.display="none";
});
/*закрываем окно*/
function goOut(teacherId) {
    var timeId='#timeConsultation'+teacherId;
    var container = $(timeId);
    container.hide();
}
/*закрываем окно*/
function exit() {
    var infblock=$(".consinf").children("div");
    infblock.hide();
}