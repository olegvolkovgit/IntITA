/**
 * Created by Wizlight on 10.12.2015.
 */
angular
    .module('lessonApp')
    .service('openDialogsService',
    function () {
        this.openTrueDialog = function () {
            $('#mydialog2').dialog({'width': '540px', 'height': 'auto', 'modal': true, 'autoOpen': false});
            $("#mydialog2").dialog("open");
            $("#mydialog2").parent().css('border', '4px solid #339900');
        };
        this.openLastTrueDialog = function () {
            $('#dialogNextLectureNG').dialog({'width': '540px', 'height': 'auto', 'modal': true, 'autoOpen': false});
            $("#dialogNextLectureNG").dialog("open");
            $("#dialogNextLectureNG").parent().css('border', '4px solid #339900');
        };
        this.openFalseDialog = function () {
            $('#mydialog3').dialog({'width': '540px', 'height': 'auto', 'modal': true, 'autoOpen': false});
            $("#mydialog3").dialog("open");
            $("#mydialog3").parent().css('border', '4px solid #cc0000');
        };
        this.openInformDialog = function () {
            $('#informDialog').dialog({'width': '540px', 'height': 'auto', 'modal': true, 'autoOpen': false});
            $("#informDialog").dialog("open");
            $("#informDialog").parent().css('border', '4px solid #339900');
        };
    }
);