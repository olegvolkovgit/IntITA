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

        initModulesListTable($stateParams.idModule,'0');
        initModulesListTable($stateParams.idModule,'1');
        initModulesListTable($stateParams.idModule,'2');
        initModulesListTable($stateParams.idModule,'3');
    })
    .controller('statusOfCoursesCtrl', function ($scope){
        initCoursesListTable(0);
        initCoursesListTable(1);
        initCoursesListTable(2);
        initCoursesListTable(3);
    })
    .controller('moduleDetailCtrl', function ($stateParams){
        initLessonsListTable($stateParams.idModule);
    })
    .controller('lessonDetailCtrl', function ($stateParams){
        initPartsListTable($stateParams.idLesson);
    });