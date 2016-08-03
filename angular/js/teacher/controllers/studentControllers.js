/**
 * Created by adm on 26.07.2016.
 */
angular
    .module('teacherApp')
    .controller('studentModulesCtrl', function ($scope){
            initTodayConsultationsTable();
            initPlannedConsultationsTable();
            initPastConsultationsTable();
            initCancelConsultationsTable();
    })
    .controller('studentFinancesCtrl', function ($scope){
        initPayCoursesList();
        initPayModulesTable();
        initAgreementsTable();
    });