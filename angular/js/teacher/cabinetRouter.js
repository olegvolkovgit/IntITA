/**
 * Created by adm on 15.07.2016.
 */
var user = "";

angular
    .module('cabinetRouter',['ui.router'])
    .config(function ($stateProvider) {
            $stateProvider
                .state('messages', {
                    url: "/messages",
                    cache         : false,
                    controller: function($scope){
                        $scope.changePageHeader('Повідомлення');
                    },
                    templateUrl: basePath+"/_teacher/messages/index"
                })
                .state('index', {
                    url: "/index",
                    cache         : false,
                    controller: function($scope){
                        $scope.changePageHeader('Особистий кабінет');
                    },
                    templateUrl: basePath+"/_teacher/cabinet/loadDashboard/?user="+user
                })
                .state('newmessages/receiver/:id', {
                    url: "/newmessages/receiver/:id",
                    cache         : false,
                    templateUrl: function ($stateParams) {
                        return basePath + "/_teacher/messages/write/?id=" + user + "&receiver=" +$stateParams.id
                    }
                })
                .state(':scenario/:id/:form/scheme/:schemeId', {
                    url: "/:scenario/:id/:form/scheme/:schemeId",
                    cache         : false,
                    templateUrl: function ($stateParams) {
                        return basePath + "/_teacher/_student/student/"+$stateParams.scenario+"/?id="+$stateParams.id+"&form="+$stateParams.form+"&schemeId="+$stateParams.schemeId
                    }
                })
                .state('publicOffer/course/:course/module/:module/scenario/:scenario/:form/scheme/:schemeId', {
                    url: "/publicOffer/course/:course/module/:module/scenario/:scenario/:form/scheme/:schemeId",
                    cache         : false,
                    templateUrl: function ($stateParams) {
                        return basePath + "/_teacher/_student/student/publicOffer?course=" + $stateParams.course + "&module=" + $stateParams.module +
                            "&type=" + $stateParams.scenario + "&form=" + $stateParams.form + "&schema=" + $stateParams.schemeId;
                    }
                })
                .state('users/profile/:id', {
                    url: "/users/profile/:id",
                    cache         : false,
                    templateUrl: function ($stateParams) {
                        return basePath+"/_teacher/user/index?id="+$stateParams.id;
                    }
                })

                .state('courses', {
                    url: '/courses',
                    views: {
                        '@': {
                            templateUrl: basePath+"/_teacher/courseManage/coursesList",
                        }
                    }
                })
                .state('courses.course', {
                    url: '/course/:id',
                    views: {
                        '@': {
                            templateUrl: function ($stateParams) {
                                return basePath+"/_teacher/courseManage/view?id="+$stateParams.id;
                            }
                        }
                    }
                })
                .state('modules', {
                    url: '/modules',
                    views: {
                        '@': {
                            templateUrl: basePath+"/_teacher/moduleManage/modulesList",
                        }
                    }
                })
                .state('modules.module', {
                    url: '/module/:moduleId',
                    views: {
                        '@': {
                            templateUrl: function ($stateParams) {
                                return basePath+"/_teacher/moduleManage/view?id="+$stateParams.moduleId;
                            }
                        }
                    }
                })
                .state('lectures', {
                    url: '/lectures',
                    views: {
                        '@': {
                            templateUrl: basePath+"/_teacher/lecture/lecturesList",
                        }
                    }
                })
                .state('users', {
                    url: '/users',
                    views: {
                        '@': {
                            templateUrl: basePath+"/_teacher/users/index",
                            controller: 'directorUsersTabsCtrl'
                        }
                    }
                })
                .state('users.registeredUsers', {
                    url: '/registeredUsers',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/users",
                        }
                    }
                })
                .state('users.blockedUsers', {
                    url: '/blockedUsers',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/blockedUsers",
                        }
                    }
                })
                .state('users.withoutRole', {
                    url: '/withoutRole',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/usersWithoutRoles",
                        }
                    }
                })
                .state('users.students', {
                    url: '/students',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/students",
                        }
                    }
                })
                .state('users.offlineStudents', {
                    url: '/offlineStudents',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/offlineStudents",
                        }
                    }
                })
                .state('users.directors', {
                    url: '/directors',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/directors",
                        }
                    }
                })
                .state('directors', {
                    url: '/directors',
                    templateUrl: basePath+"/_teacher/users/directors",
                    controller: function($scope){$scope.changePageHeader('Директора');},
                })

                .state('users.auditors', {
                    url: '/auditors',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/auditors",
                        }
                    }
                })
                .state('auditors', {
                    url: '/auditors',
                    templateUrl: basePath+"/_teacher/users/auditors",
                    controller: function($scope){$scope.changePageHeader('Аудитори');},
                })

                .state('users.superAdmins', {
                    url: '/superAdmins',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/superAdmins",
                        }
                    }
                })
                .state('superAdmins', {
                    url: '/superAdmins',
                    templateUrl:  basePath+"/_teacher/users/superAdmins",
                    controller: function($scope){$scope.changePageHeader('Суперадмін');},
                })

                .state('users.coworkers', {
                    url: '/coworkers',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/coworkers",
                        }
                    }
                })
                .state('users.admins', {
                    url: '/admins',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/admins",
                        }
                    }
                })
                .state('admins', {
                    url: '/admins',
                    templateUrl:  basePath+"/_teacher/users/admins",
                    controller: function($scope){$scope.changePageHeader('Адміністратори');},
                })

                .state('users.accountants', {
                    url: '/accountants',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/accountants",
                        }
                    }
                })
                .state('users.supervisors', {
                    url: '/supervisors',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/supervisors",
                        }
                    }
                })
                .state('users.contentManagers', {
                    url: '/contentManagers',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/contentManagers",
                        }
                    }
                })
                .state('users.trainers', {
                    url: '/trainers',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/trainers",
                        }
                    }
                })
                .state('users.contentAuthors', {
                    url: '/contentAuthors',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/contentAuthors",
                        }
                    }
                })
                .state('users.teacherConsultants', {
                    url: '/teacherConsultants',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/teacherConsultants",
                        }
                    }
                })
                .state('users.tenants', {
                    url: '/tenants',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/tenants",
                        }
                    }
                })
    }
    );

