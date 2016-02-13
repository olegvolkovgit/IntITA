/**
 * Created by anton on 11.02.16.
 */

/**
 * Initialises students table
 */
function initStudentsList() {
    return $jq('#studentsTable').DataTable( {
        "ajax": {
            "url": "/_teacher/_admin/users/getStudentsList",
            "dataSrc": "data"
        },
        "columns": [
            null,
            { className: "center" },
            { className: "center" }],

        "createdRow": function ( row, data, index ) {
            $jq(row).addClass('gradeX');
            console.log($jq(row).attr('class'));
        },

        language: {
            "url": "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
        }
    } );
};


/**
 * Updates table data
 * @param startDate
 * @param endDate
 */
function updateStudentList(startDate, endDate) {
    var request = "/_teacher/_admin/users/getStudentsList";
    if (startDate != null && startDate !== "") {
        request += '?startDate=' + startDate;
        if (endDate != null && endDate !== "") {
            request += '&endDate=' + endDate;
        }
    }

    $jq('#studentsTable').DataTable().ajax.url(request).load();
}


// language data for datapicker
var lang = {
    closeText: 'Закрити',
    prevText: '&#x3C;Попередній',
    nextText: 'Наступний&#x3E;',
    currentText: 'Сьогодні',
    monthNames: ['Січень','Лютий','Березень','Квітень','Травень','Червень', 'Липень','Серпень','Вересень','Жовтень','Листопад','Грудень'],
    monthNamesShort: ['Січ','Лют','Бер','Кві','Тра','Чер',
        'Лип','Сер','Вер','Жов','Лис','Гру'],
    dayNames: ['неділя','понеділок','вівторок','середа','четвер','п\'ятниця','субота'],
    dayNamesShort: ['нед','пон','вів','сер','чет','п\'ят','сбт'],
    dayNamesMin: ['Нд','Пн','Вт','Ср','Чт','Пт','Сб'],
    weekHeader: 'Тиждень',
    dateFormat: 'dd.mm.yy',
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: ''};
