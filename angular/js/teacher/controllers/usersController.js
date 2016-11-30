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

function blockedUsersCtrl ($http, $scope, usersService, NgTableParams) {
    $scope.blockedUsersTable = new NgTableParams({}, {
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
        $scope.usersTableParams = new NgTableParams({}, {
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
function studentsTableCtrl ($scope, usersService, NgTableParams){
    $jq("#startDate").datepicker(lang);
    $jq("#endDate").datepicker(lang);

    $scope.studentsTableParams = new NgTableParams({}, {
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

function offlineStudentsTableCtrl ($scope, usersService, NgTableParams){
    $scope.offlineStudentsTableParams = new NgTableParams({}, {
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
    $scope.withoutRolesTableParams = new NgTableParams({}, {
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
function adminsTableCtrl ($http, $scope, usersService, NgTableParams, roleService){
    $scope.adminsTableParams = new NgTableParams({}, {
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

    $scope.cancelRole = function (user, role) {
        bootbox.confirm('Скасувати роль?', function (result) {
            if (result) {
                roleService
                    .cancelRole({
                        'userId': user,
                        'role': role,
                    })
                    .$promise
                    .then(function successCallback(response) {
                        if(response.data=='success')
                            $scope.adminsTableParams.reload();
                        else bootbox.alert(response.data);
                    }, function errorCallback(response) {
                        console.log(response);
                        bootbox.alert("Операцію не вдалося виконати");
                    });
            }
        });
    }
}
function accountantsTableCtrl ($scope, usersService, NgTableParams,roleService){
    $scope.accountantsTableParams = new NgTableParams({}, {
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

    $scope.cancelRole = function (user, role) {
        bootbox.confirm('Скасувати роль?', function (result) {
            if (result) {
                roleService
                    .cancelRole({
                        'userId': user,
                        'role': role,
                    })
                    .$promise
                    .then(function successCallback(response) {
                        if(response.data=='success')
                            $scope.accountantsTableParams.reload();
                        else bootbox.alert(response.data);
                    }, function errorCallback(response) {
                        console.log(response);
                        bootbox.alert("Операцію не вдалося виконати");
                    });
            }
        });
    };
}
function contentManagersTableCtrl ($scope, usersService, NgTableParams,roleService){
    $scope.contentManagersTableParams = new NgTableParams({}, {
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

    $scope.cancelRole = function (user, role) {
        bootbox.confirm('Скасувати роль?', function (result) {
            if (result) {
                roleService
                    .cancelRole({
                        'userId': user,
                        'role': role,
                    })
                    .$promise
                    .then(function successCallback(response) {
                        if(response.data=='success')
                            $scope.contentManagersTableParams.reload();
                        else bootbox.alert(response.data);
                    }, function errorCallback(response) {
                        console.log(response);
                        bootbox.alert("Операцію не вдалося виконати");
                    });
            }
        });
    };
}
function teacherConsultantsTableCtrl ($scope, usersService, NgTableParams,roleService){
    $scope.teacherConsultantsTableParams = new NgTableParams({}, {
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

    $scope.cancelRole = function (user, role) {
        bootbox.confirm('Скасувати роль?', function (result) {
            if (result) {
                roleService
                    .cancelRole({
                        'userId': user,
                        'role': role,
                    })
                    .$promise
                    .then(function successCallback(response) {
                        if(response.data=='success')
                            $scope.teacherConsultantsTableParams.reload();
                        else bootbox.alert(response.data);
                    }, function errorCallback(response) {
                        console.log(response);
                        bootbox.alert("Операцію не вдалося виконати");
                    });
            }
        });
    };
}
function tenantsTableCtrl ($scope, usersService, NgTableParams,roleService){
    $scope.tenantsTableParams = new NgTableParams({}, {
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

    $scope.cancelRole = function (user, role) {
        bootbox.confirm('Скасувати роль?', function (result) {
            if (result) {
                roleService
                    .cancelRole({
                        'userId': user,
                        'role': role,
                    })
                    .$promise
                    .then(function successCallback(response) {
                        if(response.data=='success')
                            $scope.tenantsTableParams.reload();
                        else bootbox.alert(response.data);
                    }, function errorCallback(response) {
                        console.log(response);
                        bootbox.alert("Операцію не вдалося виконати");
                    });
            }
        });
    };
}

function trainersTableCtrl ($scope, usersService, NgTableParams,roleService){
    $scope.trainersTableParams = new NgTableParams({}, {
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

    $scope.cancelRole = function (user, role) {
        bootbox.confirm('Скасувати роль?', function (result) {
            if (result) {
                roleService
                    .cancelRole({
                        'userId': user,
                        'role': role,
                    })
                    .$promise
                    .then(function successCallback(response) {
                        if(response.data=='success')
                            $scope.tenantsTableParams.reload();
                        else bootbox.alert(response.data);
                    }, function errorCallback(response) {
                        console.log(response);
                        bootbox.alert("Операцію не вдалося виконати");
                    });
            }
        });
    };
}

function superVisorsTableCtrl ($scope, usersService, NgTableParams, roleService){
    $scope.superVisorsTableParams = new NgTableParams({}, {
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

    $scope.cancelRole = function (user, role) {
        bootbox.confirm('Скасувати роль?', function (result) {
            if (result) {
                roleService
                    .cancelRole({
                        'userId': user,
                        'role': role,
                    })
                    .$promise
                    .then(function successCallback(response) {
                        if(response.data=='success')
                            $scope.superVisorsTableParams.reload();
                        else bootbox.alert(response.data);
                    }, function errorCallback(response) {
                        console.log(response);
                        bootbox.alert("Операцію не вдалося виконати");
                    });
            }
        });
    };
}

function authorsTableCtrl ($scope, usersService, NgTableParams, roleService){
    $scope.authorsTableParams = new NgTableParams({}, {
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

    $scope.cancelRole = function (user, role) {
        bootbox.confirm('Скасувати роль?', function (result) {
            if (result) {
                roleService
                    .cancelRole({
                        'userId': user,
                        'role': role,
                    })
                    .$promise
                    .then(function successCallback(response) {
                        if(response.data=='success')
                            $scope.authorsTableParams.reload();
                        else bootbox.alert(response.data);
                    }, function errorCallback(response) {
                        console.log(response);
                        bootbox.alert("Операцію не вдалося виконати");
                    });
            }
        });
    };
}

function userProfileCtrl ($http, $scope, $stateParams, roleService){
    $scope.changePageHeader('Профіль користувача');
    $scope.userId=$stateParams.id;
    $scope.formData={};

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
    
    $scope.assignRole = function (user, role) {
        if(user && role){
            roleService
                .assignRole({
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
    
    $scope.cancelRole = function (user, role) {
        bootbox.confirm('Скасувати роль?', function (result) {
            if (result) {
                roleService
                    .cancelRole({
                        'userId': user,
                        'role': role,
                    })
                    .$promise
                    .then(function successCallback(response) {
                        if(response.data=='success')
                            $scope.loadUserData($scope.userId);
                        else bootbox.alert(response.data);
                    }, function errorCallback(response) {
                        console.log(response);
                        bootbox.alert("Операцію не вдалося виконати");
                    });
            }
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
    $scope.actionModule = function(action,userId,moduleId) {
        var url;
        switch (action){
            case 'payModule':
                url = basePath+'/_teacher/_admin/pay/payModule/';
                break;
            case 'cancelModule':
                url = basePath+'/_teacher/_admin/pay/cancelModule/';
                break;

        }
        if (moduleId && userId) {
            $http({
                method:'POST',
                url:url,
                data: $jq.param({'module': moduleId, 'user': userId}),
                headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
            })
                .success(function(data){
                    $scope.addUIHandlers(data);
                    $scope.clearInputs();
                    $scope.loadUserData($scope.userId)
                })
                .error(function(data){
                    bootbox.alert(data);
                })
        }else{
            bootbox.alert('Введено не всі дані');
        }
    };

    $scope.actionCourse = function(action,userId,courseId){
        var url;
        switch (action){
            case 'payCourse':
                url = basePath+'/_teacher/_admin/pay/payCourse/';
                break;
            case 'cancelCourse':
                url = basePath+'/_teacher/_admin/pay/cancelCourse/';
                break;

        }
        if (courseId && userId) {
            $http({
                method:'POST',
                url:url,
                data: $jq.param({'course': courseId, 'user': userId}),
                headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
            })
                .success(function(data){
                    $scope.addUIHandlers(data);
                    $scope.clearInputs();
                    $scope.loadUserData($scope.userId)
                })
                .error(function(data){
                    bootbox.alert(data);
                })
        }else{
            bootbox.alert('Введено не всі дані');
        }
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

    $scope.cancelTrainer=function (userId) {
        $http({
            method: 'POST',
            url: basePath+'/_teacher/_admin/users/removeTrainer',
            data: $jq.param({userId: userId}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function successCallback(response) {
            if (response.data == "success") {
                bootbox.alert('Операцію успішно виконано.', function () {
                    $scope.loadUserData($scope.userId);
                });
            }else{
                $scope.loadUserData($scope.userId);
                bootbox.alert(response.data)
            }
        }, function errorCallback() {
            bootbox.alert("Операцію не вдалося виконати");
        });
    };

    $scope.addTrainer=function (trainerId, userId) {
        if (!trainerId) {
            bootbox.alert("Виберіть тренера.");
            return;
        }
        $http({
            method: 'POST',
            url: basePath+"/_teacher/_admin/users/setTrainer",
            data: $jq.param({userId: userId, trainerId: trainerId}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function successCallback(response) {
            $scope.clearTrainerInputs();
            if (response.data == "success") {
                bootbox.alert('Операцію успішно виконано.', function () {
                    $scope.loadUserData($scope.userId);
                });
            }else{
                $scope.loadUserData($scope.userId);
                bootbox.alert(response.data)
            }
        }, function errorCallback() {
            bootbox.alert("Операцію не вдалося виконати");
        });
    };

    $scope.collapse=function (el) {
        $jq(el).toggle("medium");
    };
}