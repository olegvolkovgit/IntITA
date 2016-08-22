angular
    .module('teacherApp')
    .controller('usersCtrl',usersCtrl)
    .controller('usersTableCtrl',usersTableCtrl)
    .controller('studentsTableCtrl',studentsTableCtrl)
    .controller('teachersTableCtrl',teachersTableCtrl)
    .controller('withoutRolesTableCtrl',withoutRolesTableCtrl)
    .controller('adminsTableCtrl',adminsTableCtrl)
    .controller('accountantsTableCtrl',accountantsTableCtrl)
    .controller('contentManagersTableCtrl',contentManagersTableCtrl)
    .controller('teacherConsultantsTableCtrl',teacherConsultantsTableCtrl)
    .controller('tenantsTableCtrl',tenantsTableCtrl)
    .controller('consultantsTableCtrl',consultantsTableCtrl)
    .controller('trainersTableCtrl',trainersTableCtrl)

function usersTableCtrl ($http, $scope, DTOptionsBuilder, $window, $stateParams){
    $http.get(basePath + "/_teacher/_admin/users/getUsersList").then(function (data) {
        $scope.usersList = data.data["data"];
    });
    $scope.dtOptions = DTOptionsBuilder.newOptions()
        .withPaginationType('simple_numbers')
        .withLanguageSource('//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json')
        .withOption('order', [[2, 'desc']]);

}
function studentsTableCtrl ($http, $scope, DTOptionsBuilder){
    $jq("#startDate").datepicker(lang);
    $jq("#endDate").datepicker(lang);

    $http.get(basePath + "/_teacher/_admin/users/getStudentsList").then(function (data) {
        $scope.studentsList = data.data["data"];
    });
    $scope.dtOptions = DTOptionsBuilder.newOptions()
        .withPaginationType('simple_numbers')
        .withLanguageSource('//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json')
        .withOption('order', [[2, 'desc']]);

    $scope.updateStudentList=function(startDate, endDate){
        var request = basePath + "/_teacher/_admin/users/getStudentsList";
        if (startDate != null && startDate !== "") {
            request += '?startDate=' + startDate;
            if (endDate != null && endDate !== "") {
                request += '&endDate=' + endDate;
            }
        }
        $http.get(request).then(function (data) {
            $scope.studentsList = data.data["data"];
        });
    }
}
function teachersTableCtrl ($http, $scope, DTOptionsBuilder){
    $scope.loadTeachersList=function(){
        $http.get(basePath + "/_teacher/_admin/users/getTeachersList").then(function (data) {
            $scope.teachersList = data.data["data"];
        });
    };
    $scope.loadTeachersList();
    $scope.dtOptions = DTOptionsBuilder.newOptions()
        .withPaginationType('simple_numbers')
        .withLanguageSource('//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json')
        // .withOption('order', [[2, 'desc']]);

    $scope.setTeacherStatus= function(url) {
        bootbox.confirm('Змінити статус викладача?', function (result) {
            if (result) {
                $http({
                    method: 'POST',
                    url: url,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function successCallback(response) {
                    if (response.data == "success") {
                        $scope.loadTeachersList();
                        bootbox.alert("Статус викладача змінено.");
                    } else {
                        bootbox.alert("Операцію не вдалося виконати.");
                    }
                }, function errorCallback() {
                    bootbox.alert("Виникла помилка");
                });
            } else {
                showDialog("Операцію відмінено.");
            }
        });
    }
}
function withoutRolesTableCtrl ($http, $scope, DTOptionsBuilder){
    $http.get(basePath + "/_teacher/_admin/users/getWithoutRolesUsersList").then(function (data) {
        $scope.withoutRolesList = data.data["data"];
    });
    $scope.dtOptions = DTOptionsBuilder.newOptions()
        .withPaginationType('simple_numbers')
        .withLanguageSource('//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json')
        .withOption('order', [[2, 'desc']]);
}
function adminsTableCtrl ($http, $scope, DTOptionsBuilder){
    $scope.loadAdminsList=function(){
        $http.get(basePath + "/_teacher/_admin/users/getAdminsList").then(function (data) {
            $scope.adminsList = data.data["data"];
        });
    };
    $scope.loadAdminsList();
    $scope.cancelRole= function(url, role, user) {
        bootbox.confirm('Скасувати роль?', function (result) {
            if (result) {
                $http({
                    method: 'POST',
                    url: url,
                    data: $jq.param({userId: user, role: role}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function successCallback(response) {
                    $scope.loadAdminsList();
                    bootbox.alert(response.data);
                }, function errorCallback() {
                    bootbox.alert("Користувачу не вдалося відмінити обрану роль. Спробуйте повторити " +
                        "операцію пізніше або напишіть на адресу " + adminEmail);
                });
            } else {
                showDialog("Операцію відмінено.");
            }
        });
    }
    $scope.dtOptions = DTOptionsBuilder.newOptions()
        .withPaginationType('simple_numbers')
        .withLanguageSource('//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json')
}
function accountantsTableCtrl ($http, $scope, DTOptionsBuilder){
    $scope.loadAccountantsList=function(){
        $http.get(basePath + "/_teacher/_admin/users/getAccountantsList").then(function (data) {
            $scope.accountantsList = data.data["data"];
        });
    };
    $scope.loadAccountantsList();
    $scope.cancelRole= function(url, role, user) {
        bootbox.confirm('Скасувати роль?', function (result) {
            if (result) {
                $http({
                    method: 'POST',
                    url: url,
                    data: $jq.param({userId: user, role: role}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function successCallback(response) {
                    $scope.loadAccountantsList();
                    bootbox.alert(response.data);
                }, function errorCallback() {
                    bootbox.alert("Користувачу не вдалося відмінити обрану роль. Спробуйте повторити " +
                        "операцію пізніше або напишіть на адресу " + adminEmail);
                });
            } else {
                showDialog("Операцію відмінено.");
            }
        });
    }
    $scope.dtOptions = DTOptionsBuilder.newOptions()
        .withPaginationType('simple_numbers')
        .withLanguageSource('//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json')
}
function contentManagersTableCtrl ($http, $scope, DTOptionsBuilder){
    $scope.loadContentManagersList=function(){
        $http.get(basePath + "/_teacher/_admin/users/getContentManagersList").then(function (data) {
            $scope.contentManagersList = data.data["data"];
        });
    };
    $scope.loadContentManagersList();
    $scope.cancelRole= function(url, role, user) {
        bootbox.confirm('Скасувати роль?', function (result) {
            if (result) {
                $http({
                    method: 'POST',
                    url: url,
                    data: $jq.param({userId: user, role: role}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function successCallback(response) {
                    $scope.loadContentManagersList();
                    bootbox.alert(response.data);
                }, function errorCallback() {
                    bootbox.alert("Користувачу не вдалося відмінити обрану роль. Спробуйте повторити " +
                        "операцію пізніше або напишіть на адресу " + adminEmail);
                });
            } else {
                showDialog("Операцію відмінено.");
            }
        });
    }
    $scope.dtOptions = DTOptionsBuilder.newOptions()
        .withPaginationType('simple_numbers')
        .withLanguageSource('//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json')
}
function teacherConsultantsTableCtrl ($http, $scope, DTOptionsBuilder){
    $scope.loadTeacherConsultantsList=function(){
        $http.get(basePath + "/_teacher/_admin/users/getTeacherConsultantsList").then(function (data) {
            $scope.teacherConsultantsList = data.data["data"];
        });
    };
    $scope.loadTeacherConsultantsList();
    $scope.cancelRole= function(url, role, user) {
        bootbox.confirm('Скасувати роль?', function (result) {
            if (result) {
                $http({
                    method: 'POST',
                    url: url,
                    data: $jq.param({userId: user, role: role}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function successCallback(response) {
                    $scope.loadTeacherConsultantsList();
                    bootbox.alert(response.data);
                }, function errorCallback() {
                    bootbox.alert("Користувачу не вдалося відмінити обрану роль. Спробуйте повторити " +
                        "операцію пізніше або напишіть на адресу " + adminEmail);
                });
            } else {
                showDialog("Операцію відмінено.");
            }
        });
    };
    $scope.dtOptions = DTOptionsBuilder.newOptions()
        .withPaginationType('simple_numbers')
        .withLanguageSource('//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json')
}
function tenantsTableCtrl ($http, $scope, DTOptionsBuilder){
    $scope.loadTenantsList=function(){
        $http.get(basePath + "/_teacher/_admin/users/getTenantsList").then(function (data) {
            $scope.tenantsList = data.data["data"];
        });
    };
    $scope.loadTenantsList();
    $scope.cancelRole= function(url, role, user) {
        bootbox.confirm('Скасувати роль?', function (result) {
            if (result) {
                $http({
                    method: 'POST',
                    url: url,
                    data: $jq.param({userId: user, role: role}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function successCallback(response) {
                    $scope.loadTenantsList();
                    bootbox.alert(response.data);
                }, function errorCallback() {
                    bootbox.alert("Користувачу не вдалося відмінити обрану роль. Спробуйте повторити " +
                        "операцію пізніше або напишіть на адресу " + adminEmail);
                });
            } else {
                showDialog("Операцію відмінено.");
            }
        });
    };
    $scope.dtOptions = DTOptionsBuilder.newOptions()
        .withPaginationType('simple_numbers')
        .withLanguageSource('//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json')
}
function consultantsTableCtrl ($http, $scope, DTOptionsBuilder){
    $scope.loadConsultantsList=function(){
        $http.get(basePath + "/_teacher/_admin/users/getConsultantsList").then(function (data) {
            $scope.consultantsList = data.data["data"];
        });
    };
    $scope.loadConsultantsList();

    $scope.cancelRole= function(url, role, user) {
        bootbox.confirm('Скасувати роль?', function (result) {
            if (result) {
                $http({
                    method: 'POST',
                    url: url,
                    data: $jq.param({userId: user, role: role}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function successCallback(response) {
                    $scope.loadConsultantsList();
                    bootbox.alert(response.data);
                }, function errorCallback() {
                    bootbox.alert("Користувачу не вдалося відмінити обрану роль. Спробуйте повторити " +
                        "операцію пізніше або напишіть на адресу " + adminEmail);
                });
            } else {
                showDialog("Операцію відмінено.");
            }
        });
    }
    $scope.dtOptions = DTOptionsBuilder.newOptions()
        .withPaginationType('simple_numbers')
        .withLanguageSource('//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json')
}
function trainersTableCtrl ($http, $scope, DTOptionsBuilder){
    $scope.loadTrainersList=function(){
        $http.get(basePath + "/_teacher/_admin/users/getTrainersList").then(function (data) {
            $scope.trainersList = data.data["data"];
        });
    };
    $scope.loadTrainersList();

    $scope.cancelRole= function(url, role, user) {
        bootbox.confirm('Скасувати роль?', function (result) {
            if (result) {
                $http({
                    method: 'POST',
                    url: url,
                    data: $jq.param({userId: user, role: role}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function successCallback(response) {
                    $scope.loadTrainersList();
                    bootbox.alert(response.data);
                }, function errorCallback() {
                    bootbox.alert("Користувачу не вдалося відмінити обрану роль. Спробуйте повторити " +
                        "операцію пізніше або напишіть на адресу " + adminEmail);
                });
            } else {
                showDialog("Операцію відмінено.");
            }
        });
    }
    $scope.dtOptions = DTOptionsBuilder.newOptions()
        .withPaginationType('simple_numbers')
        .withLanguageSource('//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json')
}
function usersCtrl ($http, $scope, DTOptionsBuilder, $window, $stateParams){
    
}
