/**
 * Created by adm on 16.07.2016.
 */
angular
    .module('adminRouter',['ui.router'])
    .config(function ($stateProvider) {
    $stateProvider
        .state('admin', {
            url: "/admin",
            cache: false,
            controller: function($scope){
                $scope.changePageHeader('Адміністратор');
            },
            templateUrl: basePath+"/_teacher/_admin/admin/index",
        })
        .state('admin/users/addrole/:role', {
            url: "/admin/users/addrole/:role",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath+"/_teacher/_admin/role/renderAddRoleForm/role/"+$stateParams.role;
            }
        })
        .state('admin/addrole', {
            url: "/admin/addrole",
            cache: false,
            templateUrl: basePath+"/_teacher/_admin/role/addRoleForm",
        })
        
        .state('admin/user/:id/addrole', {
            url: "/admin/user/:id/addrole",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath+"/_teacher/_admin/role/addRole/id/"+$stateParams.id;
            }
        })
        .state('admin/teacher/create', {
            url: "/admin/teacher/create",
            cache: false,
            templateUrl: basePath+"/_teacher/_admin/teachers/createForm",
        })
        .state('lecture/:action/:id', {
            url: "/lecture/:action/:id",
            cache: false,
            controller: function ($stateParams, $http, $state, $location) {
                var url = basePath+'/_teacher/_admin/verifyContent/'+$stateParams.action+'/id/' + $stateParams.id;
                bootbox.confirm('Змінити статус лекції?', function (result) {
                    if (result) {
                        $http.post(url).success(function(data) {
                           bootbox.confirm("Операцію успішно виконано.", function () {
                            })
                        }).error(function(data){
                            showDialog("Операцію не вдалося виконати.");
                        })
                    }
                    else {
                        showDialog("Операцію відмінено.");
                    }
                    $location.hash(url).replace();
                    $state.go('admin/verifycontent');
                })
            }
        })
        .state('admin/addcourse', {
            url: "/admin/addcourse",
            cache: false,
            templateUrl: basePath+"/_teacher/_admin/coursemanage/create",
        })
        .state('course/detail/:id', {
            url: "/course/detail/:id",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath+"/_teacher/_admin/coursemanage/view?id="+$stateParams.id;
            }
        })
        .state('course/edit/:id', {
            url: "/course/edit/:id",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath+"/_teacher/_admin/coursemanage/update/id/"+$stateParams.id;
            }
        })
        .state('course/schema/:id', {
            url: "/course/schema/:id",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath+"/_teacher/_admin/coursemanage/schema/idCourse/"+$stateParams.id;
            }
        })
        .state('addLinkedCourse/:course/:lang', {
            url: "/addLinkedCourse/:course/:lang",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath+"/_teacher/_admin/coursemanage/addLinkedCourse/course/"+$stateParams.course+"/lang/"+$stateParams.lang;
            }
        })
        .state('admin/usersemail', {
            url: "/admin/usersemail",
            cache: false,
            templateUrl: basePath+"/_teacher/_admin/users/usersemail",
        })
        .state('admin/emailscategory', {
            url: "/admin/emailscategory",
            cache: false,
            templateUrl: basePath+"/_teacher/_admin/users/emailscategory",
        })
        .state('admin/emailscategorycreate', {
            url: "/admin/emailscategorycreate",
            cache: false,
            templateUrl: basePath+"/_teacher/_admin/users/emailscategorycreate",
        })
        .state('admin/emailscategoryupdate/:id', {
            url: "/admin/emailscategoryupdate/:id",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath+"/_teacher/_admin/users/emailscategoryupdate/id/"+$stateParams.id;
            }
        })
});





