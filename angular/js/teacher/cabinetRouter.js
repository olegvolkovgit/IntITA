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
                .state("otherwise", {
                    url: "",
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
                .state('users/profile/:id/agreement/:type/:idCourse', {
                    url: "/users/profile/:id/agreement/:type/:idCourse",
                    cache: false,
                    templateUrl: function ($stateParams) {
                        return basePath+"/_teacher/user/agreement/user/"+$stateParams.id+'/param/'+$stateParams.idCourse+'/type/'+$stateParams.type;
                    }
                })
                .state('courses', {
                    url: '/courses',
                    templateUrl: basePath+"/_teacher/courseManage/coursesList",
                })
                .state('organization/courses', {
                    url: '/organization/courses',
                    templateUrl: basePath+"/_teacher/courseManage/organizationCoursesList",
                })
                .state('course/id/:id', {
                    url: '/course/id/:id',
                    templateUrl: function ($stateParams) {
                        return basePath+"/_teacher/courseManage/view?id="+$stateParams.id;
                    }
                })

                .state('modules', {
                    url: '/modules',
                    templateUrl: basePath+"/_teacher/moduleManage/modulesList",
                })
                .state('organization/modules', {
                    url: '/organization/modules',
                    templateUrl: basePath+"/_teacher/moduleManage/organizationModulesList",
                })
                .state('module/id/:moduleId', {
                    url: '/module/id/:moduleId',
                    templateUrl: function ($stateParams) {
                        return basePath+"/_teacher/moduleManage/view?id="+$stateParams.moduleId;
                    }
                })
                
                .state('lectures', {
                    url: '/lectures',
                    templateUrl: basePath+"/_teacher/lecture/lecturesList",
                })
                .state('organization/lectures', {
                    url: '/organization/lectures',
                    templateUrl: basePath+"/_teacher/lecture/organizationLecturesList",
                })
                
                .state('users', {
                    url: '/users',
                    templateUrl: basePath+"/_teacher/users/index",
                })
                .state('organization', {
                    url: '/organization',
                    templateUrl: basePath+"/_teacher/users/organizationUsers",
                })
                
                .state('users.registeredUsers', {
                    url: '/registeredUsers',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/users",
                        }
                    }
                })
                .state('organization.registeredUsers', {
                    url: '/registeredUsers',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/users",
                        }
                    }
                })
                .state('registeredUsers', {
                    url: '/registeredUsers',
                    controller: function($scope){
                        $scope.changePageHeader('Зареєстровані користувачі');
                    },
                    templateUrl: basePath+"/_teacher/users/users",
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
                            templateUrl: basePath+"/_teacher/users/students?organization=0",
                        }
                    }
                })
                .state('organization.students', {
                    url: '/students',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/students?organization=1",
                        }
                    }
                })
                .state('students', {
                    url: '/students',
                    controller: function($scope){
                        $scope.changePageHeader('Студенти');
                    },
                    templateUrl: basePath+"/_teacher/users/students?organization=1",
                })
                
                .state('users.offlineStudents', {
                    url: '/offlineStudents',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/offlineStudents?organization=0",
                        }
                    }
                })
                .state('organization.offlineStudents', {
                    url: '/offlineStudents',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/offlineStudents?organization=1",
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
                .state('organization.directors', {
                    url: '/directors',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/directors",
                        }
                    }
                })
                
                .state('users.accountants', {
                    url: '/accountants',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/accountants?organization=0",
                        }
                    }
                })
                .state('organization.accountants', {
                    url: '/accountants',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/accountants?organization=1",
                        }
                    }
                })
                
                .state('users.supervisors', {
                    url: '/supervisors',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/supervisors?organization=0",
                        }
                    }
                })
                .state('organization.supervisors', {
                    url: '/supervisors',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/supervisors?organization=1",
                        }
                    }
                })
                
                .state('users.contentManagers', {
                    url: '/contentManagers',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/contentManagers?organization=0",
                        }
                    }
                })
                .state('organization.contentManagers', {
                    url: '/contentManagers',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/contentManagers?organization=1",
                        }
                    }
                })
                
                .state('users.trainers', {
                    url: '/trainers',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/trainers?organization=0",
                        }
                    }
                })
                .state('organization.trainers', {
                    url: '/trainers',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/trainers?organization=1",
                        }
                    }
                })
                
                .state('users.contentAuthors', {
                    url: '/contentAuthors',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/contentAuthors?organization=0",
                        }
                    }
                })
                .state('organization.contentAuthors', {
                    url: '/contentAuthors',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/contentAuthors?organization=1",
                        }
                    }
                })
                .state('contentAuthors', {
                    url: '/contentAuthors',
                    controller: function($scope){
                        $scope.changePageHeader('Автори контента');
                    },
                    templateUrl: basePath+"/_teacher/users/contentAuthors?organization=1",
                })
                
                .state('users.teacherConsultants', {
                    url: '/teacherConsultants',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/teacherConsultants?organization=0",
                        }
                    }
                })
                .state('organization.teacherConsultants', {
                    url: '/teacherConsultants',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/teacherConsultants?organization=1",
                        }
                    }
                })
                .state('teacherConsultants', {
                    url: '/teacherConsultants',
                    controller: function($scope){
                        $scope.changePageHeader('Викладачі');
                    },
                    templateUrl: basePath+"/_teacher/users/teacherConsultants?organization=1",
                })

                .state('users.tenants', {
                    url: '/tenants',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/tenants?organization=0",
                        }
                    }
                })
                .state('organization.tenants', {
                    url: '/tenants',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/tenants?organization=1",
                        }
                    }
                })
                
                .state('users.coworkers', {
                    url: '/coworkers',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/coworkers?organization=0",
                        }
                    }
                })
                .state('organization.coworkers', {
                    url: '/coworkers',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/coworkers?organization=1",
                        }
                    }
                })
                .state('coworkers', {
                    url: '/coworkers',
                    controller: function($scope){
                        $scope.changePageHeader('Співробітники');
                    },
                    templateUrl: basePath+"/_teacher/users/coworkers?organization=1",
                })

                .state('users.admins', {
                    url: '/admins',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/admins?organization=0",
                        }
                    }
                })
                .state('organization.admins', {
                    url: '/admins',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/admins?organization=1",
                        }
                    }
                })

                .state('users.superAdmins', {
                    url: '/superAdmins',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/superAdmins",
                        }
                    }
                })
                .state('organization.superAdmins', {
                    url: '/superAdmins',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/superAdmins",
                        }
                    }
                })

                .state('users.auditors', {
                    url: '/auditors',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/auditors",
                        }
                    }
                })
                .state('organization.auditors', {
                    url: '/auditors',
                    views: {
                        'usersTabs': {
                            templateUrl: basePath+"/_teacher/users/auditors",
                        }
                    }
                })
                
                .state('directors', {
                    url: '/directors',
                    templateUrl: basePath+"/_teacher/users/directors",
                    controller: function($scope){$scope.changePageHeader('Директора');},
                })
                
                .state('auditors', {
                    url: '/auditors',
                    templateUrl: basePath+"/_teacher/users/auditors",
                    controller: function($scope){$scope.changePageHeader('Аудитори');},
                })
                
                .state('superAdmins', {
                    url: '/superAdmins',
                    templateUrl:  basePath+"/_teacher/users/superAdmins",
                    controller: function($scope){$scope.changePageHeader('Суперадмін');},
                })
                .state('admins', {
                    url: '/admins',
                    templateUrl:  basePath+"/_teacher/users/admins",
                    controller: function($scope){$scope.changePageHeader('Адміністратори');},
                })
                .state('teacherprofile', {
                    url: "/teacherprofile",
                    cache         : false,
                    templateUrl: basePath+"/_teacher/_admin/teachers/updateTeacherProfileForm"
                })
    }
    );

