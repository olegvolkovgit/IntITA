/**
 * Created by Wizlight on 10.12.2015.
 */
angular
    .module('lessonApp')
    .service('openDialogsService',
    function () {
        this.openTrueDialog = function () {
            angular.element('#mydialog2').dialog({'width': '540px', 'height': 'auto', 'modal': true, 'autoOpen': false});
            angular.element("#mydialog2").dialog("open");
            angular.element("#mydialog2").parent().css('border', '4px solid #339900');
        };
        this.openLastTrueDialog = function () {
            angular.element('#dialogNextLectureNG').dialog({'width': '540px', 'height': 'auto', 'modal': true, 'autoOpen': false});
            angular.element("#dialogNextLectureNG").dialog("open");
            angular.element("#dialogNextLectureNG").parent().css('border', '4px solid #339900');
        };
        this.openFalseDialog = function () {
            angular.element('#mydialog3').dialog({'width': '540px', 'height': 'auto', 'modal': true, 'autoOpen': false});
            angular.element("#mydialog3").dialog("open");
            angular.element("#mydialog3").parent().css('border', '4px solid #cc0000');

        };
    }
);