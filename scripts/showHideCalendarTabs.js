/**
 * Created by Wizlight on 24.04.2015.
 */
/*при клику на ссылку открывается календарь*/
$('#consultationCalendar').click(function() {
    $('#dateTimePicker').focus();
});
/*при выборе даты открывается блок с выбором время*/
$("#dateTimePicker").change(function (){
    //document.getElementById('datecons').value = document.getElementById('dateTimePicker').value;
    document.getElementById('timeDate').innerHTML= document.getElementById('dateTimePicker').value;
    $("#timeConsultation").css('display', 'block');
});
/*при нажатии на кнопку назад - открывается календарь*/
$("#consultationBack").click(function (){
    $("#timeConsultation").css('display', 'none');
    $('#dateTimePicker').focus();
});
/*при нажатии на кнопку даты в окне время - открывается календарь*/
$("#timeDate").click(function (){
    $("#timeConsultation").css('display', 'none');
    $('#dateTimePicker').focus();
});
/*при нажатии на кнопку далее - блок время закрывается, открывается информативное окно c переданными ему интервалами консультаций*/
$("#consultationNext").click(function (){
    if(parseTable('timeGrid').length!== 0){
        $("#timeConsultation").css('display', 'none');
        var textinfo = document.getElementById('consInfText');
        var dateinfo = document.getElementById('dateTimePicker').value +' року'+ parseTable('timeGrid');
        textinfo.innerHTML = dateinfo + textinfo.innerHTML;
        document.getElementById('datecons').value =document.getElementById('dateTimePicker').value;
        document.getElementById('timecons').value =parseTable('timeGrid');
        $("#consultationInfo").css('display', 'block');
    }
});
/*при клику на кнопку информационного окна о консультации оно закрывается*/
$('#consultationButton').click(function() {
    document.getElementById('consultationInfo').style.display="none";
});
/*закрывает окно при клику вне окна*/
$(document).mouseup(function (e) {
    var container = $("#timeConsultation");
    if (container.has(e.target).length === 0){
        container.hide();
    }
});