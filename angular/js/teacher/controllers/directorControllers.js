/**
 * Created by adm on 19.07.2016.
 */

angular
    .module('teacherApp')
    .controller('directorUsersTabsCtrl', directorUsersTabsCtrl)
    .controller('organizationTableCtrl', organizationTableCtrl)
    .controller('organizationCtrl', organizationCtrl)

function directorUsersTabsCtrl ($scope, $state, usersService, lodash) {
        $scope.changePageHeader('Користувачі');

        $scope.tabs = [
            { title: "Зареєстровані користувачі", route: "registeredUsers"},
            { title: "Заблоковані користувачі", route: "blockedUsers"},
            { title: "Користувачі без ролі", route: "withoutRole"},
            { title: "Студенти", route: "students"},
            { title: "Офлайн студенти", route: "offlineStudents"},
            { title: "Директора", route: "directors"},
            { title: "Аудитори", route: "auditors"},
            { title: "Суперадміни", route: "superAdmins"},
            { title: "Співробітники", route: "coworkers"},
            { title: "Адміністратори", route: "admins"},
            { title: "Супервайзери", route: "supervisors"},
            { title: "Бухгалтери", route: "accountants"},
            { title: "Контент менеджери", route: "contentManagers"},
            { title: "Тренери", route: "trainers"},
            { title: "Автори контенту", route: "contentAuthors"},
            { title: "Викладачі", route: "teacherConsultants"},
            { title: "Консультанти", route: "tenants"},
        ];

        usersService
            .usersCount()
            .$promise
            .then(function (data) {
                $scope.rolesCount=data;
                $scope.tabs.forEach(function(item, i) {
                    if(lodash.find($scope.rolesCount, ['role', item.route])){
                        item.count=lodash.find($scope.rolesCount, ['role', item.route]).count;
                    }
                    if('users.'+item.route==$state.current.name) {
                        $scope.active=i;
                    }
                });
            });
}

function organizationTableCtrl ($scope, organizationService, NgTableParams){
    $scope.changePageHeader('Організації');

    $scope.organizationsTableParams = new NgTableParams({}, {
        getData: function (params) {
            return organizationService
                .organizationsList(params.url())
                .$promise
                .then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
        }
    });
}

function organizationCtrl ($scope, organizationService){
    $scope.changePageHeader('Організація');

    // $scope.loadGroupData=function(){
    //     organizationService.organizationData({'id':$stateParams.id}).$promise
    //         .then(function successCallback(response) {
    //             $scope.organization=response;
    //         }, function errorCallback() {
    //             bootbox.alert("Отримати дані групи не вдалося");
    //         });
    // };
    $scope.sendFormOrganization= function (scenario) {
        if(scenario=='new') $scope.createOrganization();
        else $scope.updateOrganization();
    };
    $scope.createOrganization= function () {
        organizationService.create($scope.organization).$promise.then(function (data) {
            if (data.message === 'OK') {
                bootbox.alert('Організацію успішно створено',function () {
                    $state.reload();
                });
            } else {
                bootbox.alert('Під час створення організації виникла помилка');
            }
        });
    };
    $scope.updateOrganization= function () {
        organizationService.update($scope.organization).$promise.then(function (data) {
            if (data.message === 'OK') {
                bootbox.alert('Організацію успішно оновлено',function () {
                    $state.reload();
                });
            } else {
                bootbox.alert('Під час оновлення організації виникла помилка');
            }
        });
    };
}