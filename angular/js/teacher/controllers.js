/* Directives */
angular
    .module('teacherApp')
    .controller('teacherCtrl',teacherCtrl);

angular
    .module('teacherApp')
    .controller('messagesCtrl',messagesCtrl);

angular
    .module('teacherApp')
    .controller('consultantCtrl',consultantCtrl);

angular
    .module('teacherApp')
    .controller('mainSliderCtrl',mainSliderCtrl);

angular
    .module('teacherApp')
    .controller('aboutusSliderCtrl',aboutusSliderCtrl);

angular
    .module('teacherApp')
    .controller('addressCtrl',addressCtrl);

angular
    .module('teacherApp')
    .controller('studentCtrl',studentCtrl);

angular
    .module('teacherApp')
    .controller('contentManagerCtrl',contentManagerCtrl);

angular
    .module('teacherApp')
    .controller('verifyContentCtrl',verifyContentCtrl);

angular
    .module('teacherApp')
    .controller('coursemanageCtrl',coursemanageCtrl);

angular
    .module('teacherApp')
    .controller('moduleemanageCtrl',moduleemanageCtrl);

angular
    .module('teacherApp')
    .controller('teachersCtrl',teachersCtrl);

angular
    .module('teacherApp')
    .controller('sharedlinksCtrl',sharedlinksCtrl);
angular
    .module('teacherApp')
    .controller('responseCtrl',responseCtrl);

angular
    .module('teacherApp')
    .controller('graduateCtrl',graduateCtrl);

angular
    .module('teacherApp')
    .controller('freelecturesCtrl',freelecturesCtrl);

angular
    .module('teacherApp')
    .controller('permissionsCtrl',permissionsCtrl);

angular
    .module('teacherApp')
    .controller('payCtrl',payCtrl);

angular
    .module('teacherApp')
    .controller('usersCtrl',usersCtrl);
angular
    .module('teacherApp')
    .controller('levelsCtrl',levelsCtrl)

angular
    .module('teacherApp')
    .controller('configCtrl',configCtrl)

angular
    .module('teacherApp')
    .controller('oldCtrl',oldCtrl)


function teacherCtrl($http, $scope,$compile, $ngBootbox, $location) {

    $scope.fillContainer = function(data)
    {
        container = angular.element(document.querySelector("#pageContainer"));
        container.html('');
        $compile(container.html(data))($scope);
    }

    $scope.ediConsult = function(url)
    {
        var elemId = document.getElementsByName('id');
        var id = elemId[0].value;
        var consult = document.getElementById('consult').value;

        $http({
            method: "POST",
            url:  url,
            data: $jq.param({id:id, consult:consult}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
            cache: false
        }).then(function(data){
            $scope.fillContainer(data.data);
            location.reload();
        });
    }

    $scope.ngLoad = function(url)
    {
        $http({
            method: "POST",
            url:  url,
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
            cache: false
        }).then(function(data){
            $scope.fillContainer(data.data);

        });
    }

    $scope.ngLoadDashboard = function(url)
    {
        $http({
            method: "POST",
            url:  url,
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
            cache: false
        }).then(function(data){
            console.log(url);
            $scope.fillContainer(data.data);
        });
    }

    $scope.loadTeacherPage = function(url,page)
    {
        $http({
            method: "POST",
            url:  url,
            data: $jq.param({page:page}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
            cache: false
        }).then(function(data){
            $scope.fillContainer(data.data);
        });
    }
    $scope.changeView = function(view){
        $location.path(view);
    }

}

function messagesCtrl ($scope){
    $jq(document).ready(function () {
        $jq('#sentMessages, #receivedMessages, #deletedMessages').DataTable({
                language: {
                    "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
                },
                "autoWidth": false
            }
        );
    });
}

function consultantCtrl ($scope, $http) {
        initTodayTeacherConsultationsTable();
        initPlannedTeacherConsultationsTable();
        initPastTeacherConsultationsTable();
        initCancelTeacherConsultationsTable();
}

function mainSliderCtrl ($scope){
        initMainSliderList();
}

function aboutusSliderCtrl ($scope){
       initAboutusSliderList();
}

function addressCtrl ($scope){
    initCountriesList();
    initCitiesList();
}

function studentCtrl ($scope,$location){

}

function contentManagerCtrl ($scope,$location){

    $scope.changeView = function(view){
        console.log("test");
    }
}

function verifyContentCtrl ($scope){
    initVerifiedLectures();
    initWaitLectures();
}

function coursemanageCtrl ($scope){
    initCourses();
}

function moduleemanageCtrl ($scope){
    initModules();
}

function teachersCtrl ($scope){
    initTeachersAdminTable();
}

function sharedlinksCtrl ($scope){
    initShareLinks();
}

function responseCtrl ($scope){
    initTeacherResponsesTable();
}

function graduateCtrl ($scope){
    initGraduatesTable();
}

function freelecturesCtrl ($scope){
    initFreeLectures();
}

function permissionsCtrl ($scope){
    initFreeLectures();
}

function payCtrl ($scope){
    initPayTypeaheads();
}

function usersCtrl ($scope){
        initUsersTable();
        initStudentsList();
        initWithoutRolesUsersTable();
        initAdminsTable();
        initAccountantsTable();
        initTeachersTable();
        initContentManagersTable();
        initTeacherConsultantsTable();
        initTenantsTable();
        initTrainersTable();
        initConsultantsRolesTable();
}

function levelsCtrl ($scope){
    $jq('#levelsTable').DataTable({
            language: {
                "url": "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json"
            }
        }
    );
}

function configCtrl ($scope){
    initConfigTable();
}

function oldCtrl ($scope){
    initConfigTable();
}