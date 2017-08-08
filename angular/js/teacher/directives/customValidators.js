/**
 * Created by adm on 06.08.2017.
 */
angular
    .module('teacherApp')
    .directive('typeaheadvalidator',function () {
        return {
            require:'ngModel',
            link:function (scope, elm, attrs, ctrl) {

            }
        };
});