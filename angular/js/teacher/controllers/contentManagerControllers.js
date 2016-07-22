/**
 * Created by adm on 19.07.2016.
 */
angular
    .module('teacherApp')
    .controller('allAuchtorsCtrl', function ($scope){
        initAuthorsTableCM();
    })
    .controller('allConsultantsCtrl', function ($scope){
        initConsultantsTable();
    })
    .controller('allTeachersConsultantsCtrl', function ($scope){
        initTeacherConsultantsTableCM();
    })
    .controller('statusOfModulesCtrl', function ($scope, $stateParams){
        console.log($stateParams);
        initModulesListTable('0','0');
        initModulesListTable('0','1');
        initModulesListTable('0','2');
        initModulesListTable('0','3');
    })
    .controller('statusOfCoursesCtrl', function ($scope){
        initCoursesListTable(0);
        initCoursesListTable(1);
        initCoursesListTable(2);
        initCoursesListTable(3);
    });