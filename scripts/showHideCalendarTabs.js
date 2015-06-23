/**
 * Created by Wizlight on 24.04.2015.
 */
/*при клику на ссылку открывается календарь*/
function showCalendar(teacherId){
    var container=$(".timeBlock").children("div");
    container.hide();
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
    var calendarId='dateTimePicker'+teacherId;
    var dateconsId='datecons'+teacherId;
    var timeconsId='timecons'+teacherId;
    var infoId='#consultationInfo'+teacherId;
    if (parseTable(gridId).length !== 0) {
        $(timeId).css('display', 'none');
        var textinfo = document.getElementById(textId);
        var dateinfo = document.getElementById(calendarId).value + ' о ' + parseTable(gridId);
        textinfo.innerHTML = dateinfo + textinfo.innerHTML;
        document.getElementById(dateconsId).value = document.getElementById(calendarId).value;
        document.getElementById(timeconsId).value = parseTable(gridId);
        $(infoId).css('display', 'block');
    }
}
/*при клику на кнопку информационного окна о консультации оно закрывается*/
$('#consultationButton').click(function() {
    document.getElementById('consultationInfo').style.display="none";
});
function goOut(teacherId) {
    var timeId='#timeConsultation'+teacherId;
    var container = $(timeId);
    container.hide();
}