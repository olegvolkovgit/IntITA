angular
    .module('teacherApp')
    .controller('usersTableCtrl',usersTableCtrl)
    .controller('studentsTableCtrl',studentsTableCtrl)
    .controller('withoutRolesTableCtrl',withoutRolesTableCtrl)
    .controller('adminsTableCtrl',adminsTableCtrl)
    .controller('accountantsTableCtrl',accountantsTableCtrl)
    .controller('contentManagersTableCtrl',contentManagersTableCtrl)
    .controller('teacherConsultantsTableCtrl',teacherConsultantsTableCtrl)
    .controller('tenantsTableCtrl',tenantsTableCtrl)
    .controller('trainersTableCtrl',trainersTableCtrl)
    .controller('blockedUsersCtrl',blockedUsersCtrl)
    .controller('superVisorsTableCtrl', superVisorsTableCtrl)
    .controller('authorsTableCtrl', authorsTableCtrl)
    .controller('offlineStudentsTableCtrl', offlineStudentsTableCtrl)
    .controller('userProfileCtrl',userProfileCtrl)
    .controller('usersEmailCtrl',usersEmailCtrl)
    .controller('emailCategoryTableCtrl',emailCategoryTableCtrl)
    .controller('emailCategoryCtrl',emailCategoryCtrl)
    .controller('directorsTableCtrl', directorsTableCtrl)
    .controller('auditorsTableCtrl', auditorsTableCtrl)
    .controller('superAdminsTableCtrl', superAdminsTableCtrl)
    .controller('usersTabsCtrl', usersTabsCtrl)
    .controller('organizationUsersTabsCtrl', organizationUsersTabsCtrl)

function blockedUsersCtrl ($http, $scope, usersService, NgTableParams) {
    $scope.blockedUsersTable = new NgTableParams({
        sorting: {
            locked_date: 'desc'
        },
    }, {
        getData: function (params) {
            return usersService
                .blockedUsersList(params.url())
                .$promise
                .then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
        }
    });
    $scope.changeUserStatus=function (url, user, message) {
        bootbox.confirm(message, function (response) {
            if (response) {
                $http({
                    method: 'POST',
                    url: url,
                    data: $jq.param({user: user}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function successCallback(response) {
                    bootbox.confirm(response.data, function () {
                        $scope.blockedUsersTable.reload();
                    });
                }, function errorCallback() {
                    bootbox.alert("Операцію не вдалося виконати");
                });
            }
        });
    }
};

function usersTableCtrl ($scope, usersService, NgTableParams){
        $scope.usersTableParams = new NgTableParams({
            sorting: {
                reg_time: 'desc'
            },
        }, {
            getData: function (params) {
                return usersService
                    .usersList(params.url())
                    .$promise
                    .then(function (data) {
                        params.total(data.count);
                        return data.rows;
                    });
            }
        });
}
function studentsTableCtrl ($scope, usersService, NgTableParams, $attrs){
    $scope.educationForms = [{id:'1', title:'онлайн'},{id:'3', title:'онлайн/офлайн'}];
    $jq("#startDate").datepicker(lang);
    $jq("#endDate").datepicker(lang);

    $scope.studentsTableParams = new NgTableParams({
        organization:$attrs.organization,
        sorting: {
            "student.start_date": 'desc'
        },
    }, {
        getData: function (params) {
            $scope.params=params.url();
            $scope.params.startDate=$scope.startDate;
            $scope.params.endDate=$scope.endDate;
            return usersService
                .studentsList($scope.params)
                .$promise
                .then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
        }
    });

    $scope.updateStudentList=function(startDate, endDate){
        $scope.studentsTableParams = new NgTableParams({}, {
            getData: function (params) {
                $scope.params=params.url();
                $scope.params.startDate=startDate;
                $scope.params.endDate=endDate;
                return usersService
                    .studentsList($scope.params)
                    .$promise
                    .then(function (data) {
                        params.total(data.count);
                        return data.rows;
                    });
            }
        });
    }
}

function offlineStudentsTableCtrl ($scope, usersService, NgTableParams, $attrs){
    $scope.shifts = [{id:'1', title:'ранкова'},{id:'2', title:'вечірня'},{id:'3', title:'байдуже'}];
    $scope.offlineStudentsTableParams = new NgTableParams({organization:$attrs.organization}, {
        getData: function (params) {
            return usersService
                .offlineStudentsList(params.url())
                .$promise
                .then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
        }
    });
}

function withoutRolesTableCtrl ($scope, usersService, NgTableParams){
    $scope.withoutRolesTableParams = new NgTableParams({
        sorting: {
            reg_time: 'desc'
        },
    }, {
        getData: function (params) {
            return usersService
                .withoutRolesList(params.url())
                .$promise
                .then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
        }
    });
}
function adminsTableCtrl ($scope, usersService, NgTableParams, roleService, $attrs){
    $scope.adminsTableParams = new NgTableParams({organization:$attrs.organization}, {
        getData: function (params) {
            return usersService
                .adminsList(params.url())
                .$promise
                .then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
        }
    });

    $scope.cancelRoleByDirector = function (user, role, organization) {
        bootbox.confirm('Скасувати роль?', function (result) {
            if (result) {roleService.cancelRoleByDirector({'userId': user, 'role': role, 'organizationId':organization}).$promise.then(function successCallback(response) {
                if(response.data=='success') $scope.adminsTableParams.reload();
                else bootbox.alert(response.data);
            }, function errorCallback() { bootbox.alert("Операцію не вдалося виконати");});}
        });
    }
}
function accountantsTableCtrl ($scope, usersService, NgTableParams,roleService, $attrs){
    $scope.accountantsTableParams = new NgTableParams({organization:$attrs.organization}, {
        getData: function (params) {
            return usersService
                .accountantsList(params.url())
                .$promise
                .then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
        }
    });
    $scope.cancelLocalRole = function (user, role) {
        bootbox.confirm('Скасувати роль?', function (result) {
            if (result) {roleService.cancelLocalRole({'userId': user, 'role': role}).$promise.then(function successCallback(response) {
                if(response.data=='success') $scope.accountantsTableParams.reload();
                else bootbox.alert(response.data);
            }, function errorCallback() { bootbox.alert("Операцію не вдалося виконати");});}
        });
    };
}
function contentManagersTableCtrl ($scope, usersService, NgTableParams,roleService, $attrs){
    $scope.contentManagersTableParams = new NgTableParams({organization:$attrs.organization}, {
        getData: function (params) {
            return usersService
                .contentManagersList(params.url())
                .$promise
                .then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
        }
    });

    $scope.cancelLocalRole = function (user, role) {
        bootbox.confirm('Скасувати роль?', function (result) {
            if (result) {roleService.cancelLocalRole({'userId': user, 'role': role}).$promise.then(function successCallback(response) {
                if(response.data=='success') $scope.contentManagersTableParams.reload();
                else bootbox.alert(response.data);
            }, function errorCallback() { bootbox.alert("Операцію не вдалося виконати");});}
        });
    };
}
function teacherConsultantsTableCtrl ($scope, usersService, NgTableParams,roleService, $attrs){
    $scope.teacherConsultantsTableParams = new NgTableParams({organization:$attrs.organization}, {
        getData: function (params) {
            return usersService
                .teacherConsultantsList(params.url())
                .$promise
                .then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
        }
    });

    $scope.cancelLocalRole = function (user, role) {
        bootbox.confirm('Скасувати роль?', function (result) {
            if (result) {roleService.cancelLocalRole({'userId': user, 'role': role}).$promise.then(function successCallback(response) {
                if(response.data=='success') $scope.teacherConsultantsTableParams.reload();
                else bootbox.alert(response.data);
            }, function errorCallback() { bootbox.alert("Операцію не вдалося виконати");});}
        });
    };
}
function tenantsTableCtrl ($scope, usersService, NgTableParams,roleService, $attrs){
    $scope.tenantsTableParams = new NgTableParams({organization:$attrs.organization}, {
        getData: function (params) {
            return usersService
                .tenantsList(params.url())
                .$promise
                .then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
        }
    });

    $scope.cancelLocalRole = function (user, role) {
        bootbox.confirm('Скасувати роль?', function (result) {
            if (result) {roleService.cancelLocalRole({'userId': user, 'role': role}).$promise.then(function successCallback(response) {
                if(response.data=='success') $scope.tenantsTableParams.reload();
                else bootbox.alert(response.data);
            }, function errorCallback() { bootbox.alert("Операцію не вдалося виконати");});}
        });
    };
}

function trainersTableCtrl ($scope, usersService, NgTableParams,roleService, $attrs){
    $scope.trainersTableParams = new NgTableParams({organization:$attrs.organization}, {
        getData: function (params) {
            return usersService
                .trainersList(params.url())
                .$promise
                .then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
        }
    });

    $scope.cancelLocalRole = function (user, role) {
        bootbox.confirm('Скасувати роль?', function (result) {
            if (result) {roleService.cancelLocalRole({'userId': user, 'role': role}).$promise.then(function successCallback(response) {
                if(response.data=='success') $scope.trainersTableParams.reload();
                else bootbox.alert(response.data);
            }, function errorCallback() { bootbox.alert("Операцію не вдалося виконати");});}
        });
    };
}

function superVisorsTableCtrl ($scope, usersService, NgTableParams, roleService, $attrs){
    $scope.superVisorsTableParams = new NgTableParams({organization:$attrs.organization}, {
        getData: function (params) {
            return usersService
                .superVisorsList(params.url())
                .$promise
                .then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
        }
    });

    $scope.cancelLocalRole = function (user, role) {
        bootbox.confirm('Скасувати роль?', function (result) {
            if (result) {roleService.cancelLocalRole({'userId': user, 'role': role}).$promise.then(function successCallback(response) {
                if(response.data=='success') $scope.superVisorsTableParams.reload();
                else bootbox.alert(response.data);
            }, function errorCallback() { bootbox.alert("Операцію не вдалося виконати");});}
        });
    };
}

function authorsTableCtrl ($scope, usersService, NgTableParams, roleService, $attrs){
    $scope.authorsTableParams = new NgTableParams({organization:$attrs.organization}, {
        getData: function (params) {
            return usersService
                .authorsList(params.url())
                .$promise
                .then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
        }
    });

    $scope.cancelLocalRole = function (user, role) {
        bootbox.confirm('Скасувати роль?', function (result) {
            if (result) {roleService.cancelLocalRole({'userId': user, 'role': role}).$promise.then(function successCallback(response) {
                if(response.data=='success') $scope.authorsTableParams.reload();
                else bootbox.alert(response.data);
            }, function errorCallback() { bootbox.alert("Операцію не вдалося виконати");});}
        });
    };
}

function userProfileCtrl ($http, $scope, $stateParams, roleService, $rootScope, $q, userService, superVisorService){
    $scope.changePageHeader('Профіль користувача');
    $scope.userId=$stateParams.id;
    $scope.formData={};
    $rootScope.$on('mailAddressCreated', function (event, data) {
        $scope.data.teacher.corporate_mail = data.mailbox;
    });

    //todo
    $q.all([
        userService.userProfileData({userId: $scope.userId}),
        userService.userOfflineEducationData({userId: $scope.userId}),
        userService.teacherProfileData({userId: $scope.userId})
    ]).then(function (results) {
        $scope.user = results[0];
        $scope.offline = results[1];
        $scope.teacher = results[2];
    });
    //todo
    $scope.loadUserData=function(userId){
        $http.get(basePath + "/_teacher/user/loadJsonUserModel/"+userId).then(function (response) {
            $scope.data = response.data;
        });
        $http.get(basePath + "/_teacher/user/getRolesHistory/id/"+userId).then(function (response) {
            $scope.roles = response.data;
        });
    };

    $scope.loadUserData($scope.userId);

    $scope.changeUserStatus=function (url, user) {
        $http({
            method: 'POST',
            url: url,
            data: $jq.param({user: user}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function successCallback(response) {
            $scope.loadUserData($scope.userId);
        }, function errorCallback() {
            bootbox.alert("Операцію не вдалося виконати");
        });
    };
    $scope.changeDocStatus=function (id) {
        $http({
            method: 'POST',
            url: basePath+'/_teacher/_accountant/accountant/changeDocumentStatus',
            data: $jq.param({id: id}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function successCallback() {
            $scope.loadUserData($scope.userId);
        }, function errorCallback() {
            bootbox.alert("Операцію не вдалося виконати");
        });
    }
    $scope.assignLocalRole = function (user, role) {
        if(user && role){
            roleService
                .assignLocalRole({
                    'userId': user,
                    'role': role,
                })
                .$promise
                .then(function successCallback(response) {
                    $scope.addUIHandlers(response.data);
                    $scope.loadUserData($scope.userId);
                }, function errorCallback(response) {
                    console.log(response);
                    bootbox.alert("Операцію не вдалося виконати");
                });
        }
    };

    $scope.cancelLocalRole = function (user, role) {
        bootbox.confirm('Скасувати роль?', function (result) {
            if (result) {roleService.cancelLocalRole({'userId': user, 'role': role}).$promise.then(function successCallback(response) {
                if(response.data=='success') $scope.loadUserData($scope.userId);
                else bootbox.alert(response.data);
            }, function errorCallback() { bootbox.alert("Операцію не вдалося виконати");});}
        });
    };

    $scope.onSelectModule = function ($item) {
        $scope.selectedModule = $item;
    };
    $scope.reloadModule = function(){
        $scope.selectedModule=null;
    };
    $scope.onSelectCourse = function ($item) {
        $scope.selectedCourse = $item;
    };
    $scope.reloadCourse = function(){
        $scope.selectedCourse=null;
    };
    $scope.clearInputs=function () {
        $scope.selectedModule=null;
        $scope.selectedCourse=null;
        $scope.formData.moduleSelected=null;
        $scope.formData.courseSelected=null;
    };

    $scope.onSelectTrainer = function ($item) {
        $scope.selectedTrainer = $item;
    };
    $scope.reloadTrainer = function(){
        $scope.selectedTrainer=null;
    };
    $scope.clearTrainerInputs=function () {
        $scope.trainerSelected=null;
        $scope.selectedTrainer=null;
    };

    $scope.addTrainer=function (trainerId, userId) {
        if (!trainerId) {
            bootbox.alert("Виберіть тренера.");
            return;
        }
        superVisorService
            .setTrainer({trainerId:trainerId,userId:userId})
            .$promise
            .then(function (response) {
                $scope.clearTrainerInputs();
                if (response.data == "success") {
                    bootbox.alert('Операцію успішно виконано.', function () {
                        $scope.loadUserData($scope.userId);
                    });
                }else{
                    bootbox.alert(response.data)
                    $scope.loadUserData($scope.userId);
                }
            });
    };
    $scope.cancelTrainer=function (userId) {
        superVisorService
            .removeTrainer({userId:userId})
            .$promise
            .then(function (response) {
                if (response.data == "success") {
                    bootbox.alert('Операцію успішно виконано.', function () {
                        $scope.loadUserData($scope.userId);
                    });
                }else{
                    $scope.loadUserData($scope.userId);
                    bootbox.alert(response.data)
                }
            });
    };

    $scope.collapse=function (el) {
        $jq(el).toggle("medium");
    };
}

function usersEmailCtrl ($http, $scope,  usersService, NgTableParams, $ngBootbox) {
    $scope.loadEmailCategory=function(){
        return usersService
            .emailsCategoryList()
            .$promise
            .then(function (data) {
                $scope.emailsCategory=data;
            });
    };
    $scope.loadEmailCategory();

    $scope.usersEmailTableParams = new NgTableParams({}, {
        getData: function (params) {
            return usersService
                .usersEmailList(params.url())
                .$promise
                .then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
        }
    });
    
    $scope.uploadFile =function (files) {
        $scope.errormsg='';
        $scope.error=false;
        var filesExt = ['xlsx', 'xls'];
        var parts = files[0].name.split('.');
        if(filesExt.join().search(parts[parts.length - 1]) == -1){
            $scope.error=true;
            $scope.errormsg='Неправильний тип файлу';
            return false;
        }

            var file_data = files[0];
            var form_data = new FormData();
            form_data.append('file', file_data);
            $jq.ajax({
                url: basePath + "/_teacher/_admin/users/saveExcelFile", // point to server-side PHP script
                dataType: 'text',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function () {
                    bootbox.alert('Файл завантажено');
                    $scope.isFile = true;
                }
            });
    };

    $scope.importExcel=function (emailCategory) {
        $ngBootbox.confirm("Імпортувати список email`ів? ").then(function () {
            $http({
                method: 'POST',
                url: basePath+"/_teacher/_admin/users/importExcel",
                data: $jq.param({categoryId: emailCategory}),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function successCallback() {
                $scope.usersEmailTableParams.reload();
            }, function errorCallback() {
                $scope.isFile=false;
                bootbox.alert("Операцію не вдалося виконати");
            });
        })

    }

    $scope.addNewEmail=function (email,emailCategory) {
        $http({
            method: 'POST',
            url: basePath+"/_teacher/_admin/users/addNewEmail",
            data: $jq.param({
                email: email,
                categoryId:emailCategory
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function successCallback() {
            $scope.usersEmailTableParams.reload();
            $scope.newEmail=null;
        }, function errorCallback() {
            bootbox.alert("Операцію не вдалося виконати");
        });
    }
    
    $scope.removeEmail=function (email) {
        bootbox.confirm('Видалити email?', function (result) {
            if (result) {
                $http({
                    method: 'POST',
                    data: $jq.param({email: email}),
                    url: basePath + "/_teacher/_admin/users/removeEmail",
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function successCallback() {
                    $scope.usersEmailTableParams.reload();
                }, function errorCallback() {
                    bootbox.alert("Операцію не вдалося виконати");
                });
            }
        });
    }

    $scope.truncateEmailsTable=function (emailCategory) {
        bootbox.confirm("Очистити базу email'ів вибраної категорії?", function (result) {
            if (result) {
                $http({
                    method: 'POST',
                    data: $jq.param({categoryId:emailCategory}),
                    url: basePath + "/_teacher/_admin/users/truncateEmailsTable",
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function successCallback() {
                    $scope.usersEmailTableParams.reload();
                }, function errorCallback() {
                    bootbox.alert("Операцію не вдалося виконати");
                });
            }
        });
    }
};

function emailCategoryTableCtrl ($scope,  usersService, $http) {
    $scope.loadEmailCategory=function(){
        return usersService
            .emailsCategoryList()
            .$promise
            .then(function (data) {
                $scope.emailsCategory=data;
            });
    };
    $scope.loadEmailCategory();

    $scope.removeEmailCategory=function (categoryId) {
        bootbox.confirm("При видаленні цієї категорії буде видалено всі email'и які в неї входять. Ви впевнені, що хочите видалити?", function (result) {
            if (result) {
                $http({
                    method: 'POST',
                    data: $jq.param({categoryId: categoryId}),
                    url: basePath + "/_teacher/_admin/users/removeEmailCategory",
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function successCallback() {
                    location.reload();
                }, function errorCallback() {
                    bootbox.alert("Операцію не вдалося виконати");
                });
            }
        });
    }
};

function emailCategoryCtrl ($http, $scope,  usersService, $stateParams, $state) {
    $scope.loadEmailCategory=function(id){
        usersService.emailCategoryData({'id':id})
            .$promise
            .then(function successCallback(response) {
                $scope.emailCategory=response;
            }, function errorCallback() {
                bootbox.alert("Отримати дані не вдалося");
            });
    };
    if($stateParams.id){
        $scope.loadEmailCategory($stateParams.id);
    }

    $scope.sendEmailCategory= function (scenario) {
        if(scenario=='new') $scope.createEmailCategory();
        else $scope.editEmailCategory();
    };
    $scope.createEmailCategory= function () {
        $http({
            url: basePath + "/_teacher/_admin/users/createEmailCategory",
            method: "POST",
            data: $jq.param({
                name: $scope.emailCategory.title,
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback() {
            $state.go("admin/emailscategory", {}, {reload: true});
        }, function errorCallback() {
            bootbox.alert("Створити категорію емейлів не вдалося. Помилка сервера.");
        });
    };
    $scope.editEmailCategory= function () {
        $http({
            url: basePath + "/_teacher/_admin/users/updateEmailCategory",
            method: "POST",
            data: $jq.param({
                id:$stateParams.id,
                name: $scope.emailCategory.title,
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback() {
            $state.go("admin/emailscategory", {}, {reload: true});
        }, function errorCallback() {
            bootbox.alert("Оновити дані не вдалося. Помилка сервера.");
        });
    };
};

function directorsTableCtrl ($scope, usersService, NgTableParams, roleService){
    $scope.directorsTableParams = new NgTableParams({}, {
        getData: function (params) {
            return usersService
                .directorsList(params.url())
                .$promise
                .then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
        }
    });

    $scope.cancelRoleByDirector = function (user, role) {
        bootbox.confirm('Скасувати роль?', function (result) {
            if (result) {roleService.cancelRoleByDirector({'userId': user, 'role': role}).$promise.then(function successCallback(response) {
                if(response.data=='success') $scope.directorsTableParams.reload();
                else bootbox.alert(response.data);
            }, function errorCallback() { bootbox.alert("Операцію не вдалося виконати");});}
        });
    }
}

function auditorsTableCtrl ($scope, usersService, NgTableParams, roleService){
    $scope.auditorsTableParams = new NgTableParams({}, {
        getData: function (params) {
            return usersService
                .auditorsList(params.url())
                .$promise
                .then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
        }
    });

    $scope.cancelRoleByDirector = function (user, role) {
        bootbox.confirm('Скасувати роль?', function (result) {
            if (result) {roleService.cancelRoleByDirector({'userId': user, 'role': role}).$promise.then(function successCallback(response) {
                if(response.data=='success') $scope.auditorsTableParams.reload();
                else bootbox.alert(response.data);
            }, function errorCallback() { bootbox.alert("Операцію не вдалося виконати");});}
        });
    }
}

function superAdminsTableCtrl ($scope, usersService, NgTableParams, roleService){
    $scope.superAdminsTableParams = new NgTableParams({}, {
        getData: function (params) {
            return usersService
                .superAdminsList(params.url())
                .$promise
                .then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
        }
    });

    $scope.cancelRoleByDirector = function (user, role) {
        bootbox.confirm('Скасувати роль?', function (result) {
            if (result) {roleService.cancelRoleByDirector({'userId': user, 'role': role}).$promise.then(function successCallback(response) {
                if(response.data=='success') $scope.superAdminsTableParams.reload();
                else bootbox.alert(response.data);
            }, function errorCallback() { bootbox.alert("Операцію не вдалося виконати");});}
        });
    }
}

function usersTabsCtrl ($scope, $state, usersService, lodash) {
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

function organizationUsersTabsCtrl ($scope, $state, usersService, lodash) {
    $scope.changePageHeader('Користувачі');

    $scope.tabs = [
        { title: "Зареєстровані користувачі", route: "registeredUsers"},
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
        .organizationUsersCount()
        .$promise
        .then(function (data) {
            $scope.rolesCount=data;
            $scope.tabs.forEach(function(item, i) {
                if(lodash.find($scope.rolesCount, ['role', item.route])){
                    item.count=lodash.find($scope.rolesCount, ['role', item.route]).count;
                }
                if('organization.'+item.route==$state.current.name) {
                    $scope.active=i;
                }
            });
        });
}