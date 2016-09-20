/**
 * Created by Wizlight on 10.12.2015.
 */
angular
    .module('lessonApp')
    .service('openDialogsService',
    function () {
        this.openTrueDialog = function () {
            var dialogWidth=getDialogWidth();
            $('#mydialog2').dialog({'width': dialogWidth, 'height': 'auto', 'modal': true, 'autoOpen': false});
            $("#mydialog2").dialog("open");
            $("#mydialog2").parent().css('border', '4px solid #339900');
        };
        this.openLastTrueDialog = function () {
            var dialogWidth=getDialogWidth();
            $('#dialogNextLectureNG').dialog({'width': dialogWidth, 'height': 'auto', 'modal': true, 'autoOpen': false});
            $("#dialogNextLectureNG").dialog("open");
            $("#dialogNextLectureNG").parent().css('border', '4px solid #339900');
        };
        this.openFalseDialog = function () {
            var dialogWidth=getDialogWidth();
            $('#mydialog3').dialog({'width': dialogWidth, 'height': 'auto', 'modal': true, 'autoOpen': false});
            $("#mydialog3").dialog("open");
            $("#mydialog3").parent().css('border', '4px solid #cc0000');
        };
        this.openInformDialog = function () {
            var dialogWidth=getDialogWidth();
            $('#informDialog').dialog({'width': dialogWidth, 'height': 'auto', 'modal': true, 'autoOpen': false});
            $("#informDialog").dialog("open");
            $("#informDialog").parent().css('border', '4px solid #339900');
        };
    }
);

function getDialogWidth() {
    var width=$('#lessonBlock').width()*0.45;
    if(width<320){
        var dialogWidth=310+'px';
    }else{
        var dialogWidth=width+'px';
    }
    return dialogWidth;
}