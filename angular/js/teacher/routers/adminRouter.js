/**
 * Created by adm on 16.07.2016.
 */
angular
    .module('adminRouter', ['ui.router'])
    .config(function ($stateProvider, $urlRouterProvider, $locationProvider) {
        $stateProvider
            .state('admin', {
                url: "/admin",
                cache: false,
                templateUrl: basePath + "/_teacher/_admin/admin/index",
            })
            .state('admin/carousel', {
                url: "/admin/carousel",
                cache: false,
                templateUrl: basePath + "/_teacher/_admin/carousel/index",
            })
            .state('admin/carousel/view/id/:id', {
                url: "/admin/carousel/view/id/:id",
                cache: false,
                controller: "mainSliderTableCtrl",
                templateUrl: function ($stateParams) {
                    return basePath + "/_teacher/_admin/carousel/view/?id=" + $stateParams.id;
                }
            })
            .state('admin/carousel/update/id/:id', {
                url: "/admin/carousel/update/id/:id",
                cache: false,
                templateUrl: function ($stateParams) {
                    return basePath + "/_teacher/_admin/carousel/update/?id=" + $stateParams.id;
                }
            })
            .state('admin/aboutusSlider', {
                url: "/admin/aboutusSlider",
                cache: false,
                templateUrl: basePath + "/_teacher/_admin/aboutusSlider/index",
            })
            .state('admin/aboutusSlider/view/id/:id', {
                url: "/admin/aboutusSlider/view/id/:id",
                cache: false,
                controller: "aboutUsSliderTableCtrl",
                templateUrl: function ($stateParams) {
                    return basePath + "/_teacher/_admin/aboutusSlider/view/?id=" + $stateParams.id;
                }
            })
            .state('admin/aboutusSlider/update/id/:id', {
                url: "/admin/aboutusSlider/update/id/:id",
                cache: false,
                templateUrl: function ($stateParams) {
                    return basePath + "/_teacher/_admin/aboutusSlider/update/?id=" + $stateParams.id;
                }
            })
            .state('admin/address', {
                url: "/admin/address",
                cache: false,
                templateUrl: basePath + "/_teacher/_admin/address/index",
            })
            .state('admin/verifycontent', {
                url: "/admin/verifycontent",
                cache: false,
                templateUrl: basePath + "/_teacher/_admin/verifyContent/index",
            })
            .state('admin/coursemanage', {
                url: "/admin/coursemanage",
                cache: false,
                templateUrl: basePath + "/_teacher/_admin/coursemanage/index",
            })
            .state('admin/teachers', {
                url: "/admin/teachers",
                cache: false,
                templateUrl: basePath + "/_teacher/_admin/teachers/index",
            })
            .state('admin/freelectures', {
                url: "/admin/freelectures",
                cache: false,
                templateUrl: basePath + "/_teacher/_admin/freeLectures/index",
            })
            .state('admin/permissions', {
                url: "/admin/permissions",
                cache: false,
                templateUrl: basePath + "/_teacher/_admin/permissions/index",
            })
            .state('admin/pay', {
                url: "/admin/pay",
                cache: false,
                templateUrl: basePath + "/_teacher/_admin/pay/index",
            })
            .state('admin/cancel', {
                url: "/admin/cancel",
                cache: false,
                templateUrl: basePath + "/_teacher/_admin/pay/cancelCourseModule",
            })

        .state('admin/users', {
            url: "/admin/users",
            cache: false,
            templateUrl: basePath+"/_teacher/_admin/users/index",
        })
        .state('admin/users/addrole/:role', {
            url: "/admin/users/addrole/:role",
            cache: false,
            controller:"addRoleCtrl",
            templateUrl: function ($stateParams) {
                return basePath+"/_teacher/_admin/users/renderAddRoleForm/role/"+$stateParams.role;
            }
        })
        .state('admin/users/user/:id', {
            url: "/admin/users/user/:id",
            cache: false,
            controller:"usersCtrl",
            templateUrl: function ($stateParams) {
                return basePath+"/_teacher/user/index?id="+$stateParams.id;
            }
        })
        .state('admin/users/user/:id/addtrainer', {
            url: "/admin/users/user/:id/addtrainer",
            cache: false,
            controller:"usersCtrl",
            templateUrl: function ($stateParams) {
                return basePath+"/_teacher/_admin/users/addTrainer/id/"+$stateParams.id;
            }
        })
        .state('admin/users/user/:id/changetrainer', {
            url: "/admin/users/user/:id/changetrainer",
            cache: false,
            controller:"usersCtrl",
            templateUrl: function ($stateParams) {
                return basePath+"/_teacher/_admin/users/changeTrainer/id/"+$stateParams.id;
            }
        })
        .state('admin/users/user/:id/addrole', {
            url: "/admin/users/user/:id/addrole",
            cache: false,
            controller:"usersCtrl",
            templateUrl: function ($stateParams) {
                return basePath+"/_teacher/user/addRole/id/"+$stateParams.id;
            }
        })
        .state('admin/users/user/:id/agreement/:type/:idCourse', {
            url: "/admin/users/user/:id/agreement/:type/:idCourse",
            cache: false,
            controller:"usersCtrl",
            templateUrl: function ($stateParams) {
                return basePath+"/_teacher/user/agreement/user/"+$stateParams.id+'/param/'+$stateParams.idCourse+'/type/'+$stateParams.type;
            }
        })
        
        .state('admin/users/teacher/:id', {
            url: "/admin/users/teacher/:id",
            cache: false,
            controller:"teachersCtrl",
            templateUrl: function ($stateParams) {
                return basePath+"/_teacher/_admin/teachers/showTeacher?id="+$stateParams.id;
            }
        })
        .state('admin/users/teacher/update/:id', {
            url: "/admin/users/teacher/update/:id",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath+"/_teacher/_admin/teachers/update/?id="+$stateParams.id;
            }
        })
        .state('admin/teacher/create', {
            url: "/admin/teacher/create",
            cache: false,
            templateUrl: basePath+"/_teacher/_admin/teachers/create",
        })
        .state('admin/teacher/addTeacherRol/:id', {
            url: "/admin/teacher/addTeacherRole/:id",
            cache: false,
            controller: "teachersCtrl",
            templateUrl: function ($stateParams) {
                return basePath+"/_teacher/_admin/teachers/addTeacherRole/?id="+$stateParams.id;
            }
        })
        .state('admin/teacher/:id/editRole/role/:role', {
            url: "/admin/teacher/:id/editRole/role/:role",
            cache: false,
            controller: "editTeacherRoleCtrl",
            templateUrl: function ($stateParams) {
                return basePath+"/_teacher/_admin/teachers/editRole/id/"+$stateParams.id+'/role/'+$stateParams.role;
            }
        })
        
        .state('admin/users/consultant/:id', {
            url: "/admin/users/consultant/:id",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath+"/_teacher/_content_manager/contentManager/showTeacher?id="+$stateParams.id;
            }
        })
        .state('admin/addmainsliderphoto', {
            url: "/admin/addmainsliderphoto",
            cache: false,
            templateUrl: basePath+"/_teacher/_admin/carousel/create",
        })
        .state('admin/addaboutussliderphoto', {
            url: "/admin/addaboutussliderphoto",
            cache: false,
            templateUrl: basePath+"/_teacher/_admin/aboutusSlider/create",
        })
        .state('admin/addcity', {
            url: "/admin/addcity",
            cache: false,
            controller:"addressCtrl",
            templateUrl: basePath+"/_teacher/_admin/address/addCity",
        })
        .state('admin/editcity/:id', {
            url: "/admin/editcity/:id",
            cache: false,
            controller:"addressCtrl",
            templateUrl: function ($stateParams) {
                return basePath + "/_teacher/_admin/address/editCity/id/"+$stateParams.id;
            }
        })
        .state('admin/addcountry', {
            url: "/admin/addcountry",
            cache: false,
            templateUrl: basePath+"/_teacher/_admin/address/addCountry",
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
        .state('config/view/:id', {
            url: "/config/view/:id",
            cache: false,
            templateUrl: function ($stateParams) {
                console.log($stateParams.id);
                return basePath + "/_teacher/_admin/config/view/id/" + $stateParams.id;
            }
        })
        .state('addLinkedCourse/:model/:course/:lang', {
            url: "/addLinkedCourse/:model/:course/:lang",
            cache: false,
            templateUrl: function ($stateParams) {
                console.log($stateParams.id);
                return basePath+"/_teacher/_admin/coursemanage/addLinkedCourse/model/"+$stateParams.model+"/course/"+$stateParams.course+"/lang/"+$stateParams.lang;
            }
        });
});





