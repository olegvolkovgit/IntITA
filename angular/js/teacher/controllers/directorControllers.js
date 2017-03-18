/**
 * Created by adm on 19.07.2016.
 */

angular
    .module('teacherApp')
    .controller('directorUsersTabsCtrl', ['$scope','$state','usersService','lodash',
        function ($scope, $state, usersService, _) {
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
                        if(_.find($scope.rolesCount, ['role', item.route])){
                            item.count=_.find($scope.rolesCount, ['role', item.route]).count;
                        }
                        if('users.'+item.route==$state.current.name) {
                            $scope.active=i;
                        }
                    });
                });
        }]);