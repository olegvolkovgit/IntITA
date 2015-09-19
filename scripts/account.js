$(window).load(
    function(){
        var ukrMonthTitles = {
            'January':'січня',
            'February':'лютого',
            'March':'березня',
            'April':'квітня',
            'May':'травня',
            'June':'червня',
            'July':'липня',
            'August':'серпня',
            'September':'вересня',
            'October':'жовтня',
            'November':'листопада',
            'December':'грудня'
        };
        month = ukrMonthTitles[document.getElementById('month').innerHTML];
        document.getElementById('month').innerHTML = ukrMonthTitles[document.getElementById('month').innerHTML];
    }
);
function sendData(dat)
{
    window.location.search = dat;
}