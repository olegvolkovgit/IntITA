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
    .controller('moduleAuthorsCtrl',moduleAuthorsCtrl);

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
function studentsTableCtrl ($http, $scope, usersService, NgTableParams){
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
function teachersTableCtrl ($http, $scope, usersService, NgTableParams){
    $scope.teachersTableParams = new NgTableParams({}, {
        getData: function (params) {
            return usersService
                .teachersList(params.url())
                .$promise
                .then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
        }
    });
    
    $scope.setTeacherStatus= function(isPrint, id) {
        bootbox.confirm('Змінити статус викладача?', function (result) {
            if (result) {
                if(isPrint==1) var url=basePath+'/_teacher/_admin/teachers/delete/id/'+id;
                else var url=basePath+'/_teacher/_admin/teachers/restore/id/'+id;
                $http({
                    method: 'POST',
                    url: url,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function successCallback(response) {
                    if (response.data == "success") {
                        $scope.teachersTableParams.reload();
                        bootbox.alert("Статус викладача змінено.");
                    } else {
                        bootbox.alert("Операцію не вдалося виконати.");
                    }
                }, function errorCallback() {
                    bootbox.alert("Виникла помилка");
                });
            }
        });
    }
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
function adminsTableCtrl ($http, $scope, usersService, NgTableParams){
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
    
    $scope.cancelRole= function(url, role, user) {
        bootbox.confirm('Скасувати роль?', function (result) {
            if (result) {
                $http({
                    method: 'POST',
                    url: basePath+url,
                    data: $jq.param({userId: user, role: role}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function successCallback(response) {
                    $scope.adminsTableParams.reload();
                    bootbox.alert(response.data);
                }, function errorCallback() {
                    bootbox.alert("Операцію не вдалося виконати.");
                });
            }
        });
    }

}
function accountantsTableCtrl ($http, $scope, usersService, NgTableParams){
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

    $scope.cancelRole= function(url, role, user) {
        bootbox.confirm('Скасувати роль?', function (result) {
            if (result) {
                $http({
                    method: 'POST',
                    url: basePath+url,
                    data: $jq.param({userId: user, role: role}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function successCallback(response) {
                    $scope.accountantsTableParams.reload();
                    bootbox.alert(response.data);
                }, function errorCallback() {
                    bootbox.alert("Операцію не вдалося виконати.");
                });
            }
        });
    };
}
function contentManagersTableCtrl ($http, $scope, usersService, NgTableParams){
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

    $scope.cancelRole= function(url, role, user) {
        bootbox.confirm('Скасувати роль?', function (result) {
            if (result) {
                $http({
                    method: 'POST',
                    url: basePath+url,
                    data: $jq.param({userId: user, role: role}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function successCallback(response) {
                    $scope.contentManagersTableParams.reload();
                    bootbox.alert(response.data);
                }, function errorCallback() {
                    bootbox.alert("Операцію не вдалося виконати.");
                });
            }
        });
    };
}
function teacherConsultantsTableCtrl ($http, $scope, usersService, NgTableParams){
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

    $scope.cancelRole= function(url, role, user) {
        bootbox.confirm('Скасувати роль?', function (result) {
            if (result) {
                $http({
                    method: 'POST',
                    url: basePath+url,
                    data: $jq.param({userId: user, role: role}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function successCallback(response) {
                    $scope.teacherConsultantsTableParams.reload();
                    bootbox.alert(response.data);
                }, function errorCallback() {
                    bootbox.alert("Операцію не вдалося виконати.");
                });
            }
        });
    };
}
function tenantsTableCtrl ($http, $scope, usersService, NgTableParams){
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

    $scope.cancelRole= function(url, role, user) {
        bootbox.confirm('Скасувати роль?', function (result) {
            if (result) {
                $http({
                    method: 'POST',
                    url: basePath+url,
                    data: $jq.param({userId: user, role: role}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function successCallback(response) {
                    $scope.tenantsTableParams.reload();
                    bootbox.alert(response.data);
                }, function errorCallback() {
                    bootbox.alert("Операцію не вдалося виконати.");
                });
            }
        });
    };
}
function consultantsTableCtrl ($http, $scope, usersService, NgTableParams){
    $scope.consultantsTableParams = new NgTableParams({}, {
        getData: function (params) {
            return usersService
                .consultantsList(params.url())
                .$promise
                .then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
        }
    });

    $scope.cancelRole= function(url, role, user) {
        bootbox.confirm('Скасувати роль?', function (result) {
            if (result) {
                $http({
                    method: 'POST',
                    url: basePath+url,
                    data: $jq.param({userId: user, role: role}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function successCallback(response) {
                    $scope.consultantsTableParams.reload();
                    bootbox.alert(response.data);
                }, function errorCallback() {
                    bootbox.alert("Операцію не вдалося виконати.");
                });
            }
        });
    };
}
function trainersTableCtrl ($http, $scope, usersService, NgTableParams){
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

    $scope.cancelRole= function(url, role, user) {
        bootbox.confirm('Скасувати роль?', function (result) {
            if (result) {
                $http({
                    method: 'POST',
                    url: basePath+url,
                    data: $jq.param({userId: user, role: role}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function successCallback(response) {
                    $scope.trainersTableParams.reload();
                    bootbox.alert(response.data);
                }, function errorCallback() {
                    bootbox.alert("Операцію не вдалося виконати.");
                });
            }
        });
    };
}
function usersCtrl ($http, $scope, $state, $stateParams, $templateCache){

    $scope.loadUserData=function(){
        $http.get(basePath + "/_teacher/user/loadJsonUserModel/"+$stateParams.id).then(function (response) {
            $scope.data = response.data;
        });
    };

    $scope.loadUserData();

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
                        $templateCache.remove(basePath+'/_teacher/_content_manager/contentManager/showTeacher/id/'+user);
                        $state.go($state.current, {}, {reload: true});
                        $scope.loadUserData();

                    });
                }, function errorCallback() {
                    bootbox.alert("Операцію не вдалося виконати");
                });
            }
        });
    };

    $scope.setUserRole=function (url) {
        var role = $scope.selectedRole;
        var user = $jq("#user").val();
        if (typeof role=='undefined') {
            bootbox.alert('Роль не вибрана');
        } else{
            $http({
                method: 'POST',
                url: url,
                data: $jq.param({role: role, user: user}),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function successCallback(response) {
                bootbox.alert(response.data, function () {
                    $state.go('admin/users/user/:id/addrole', {id:user}, {reload: true});
                });
            }, function errorCallback() {
                bootbox.alert("Операцію не вдалося виконати");
            });
        }
    };
    $scope.cancelUserRole=function (url, role, user) {
        bootbox.confirm("Скасувати роль?", function (response) {
            if (response) {
                $http({
                    method: 'POST',
                    url: url,
                    data: $jq.param({role: role, user: user}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                }).then(function successCallback(response) {
                    bootbox.alert(response.data, function () {
                        $scope.loadUserData();
                    });
                }, function errorCallback() {
                    bootbox.alert("Операцію не вдалося виконати");
                });
            }
        });
    };

    $scope.addStudentAttr=function (url, user, type) {
        value = $jq('#value').val();
        if (type == 'module') {
            module = value;
            course = 0;
        } else if (type == 'course') {
            module = 0;
            course = value;
        }
        if (value != 0) {
            $http({
                method: 'POST',
                url: url,
                data: $jq.param({user: user, module: module, course: course}),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function successCallback(response) {
                bootbox.alert(response.data, function () {
                    $scope.loadUserData();
                });
            }, function errorCallback() {
                bootbox.alert("Операцію не вдалося виконати");
            });
        } else {
            bootbox.alert('Виберіть курс чи модуль!');
        }
    };

    $scope.cancelCourse=function (url, course, user) {
        $http({
            method: 'POST',
            url: url,
            data: $jq.param({course: course, user : user}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function successCallback(response) {
            bootbox.alert(response.data, function () {
                $scope.loadUserData();
            });
        }, function errorCallback() {
            bootbox.alert("Операцію не вдалося виконати");
        });
    };
    $scope.cancelModule=function (url, module, user) {
        $http({
            method: 'POST',
            url: url,
            data: $jq.param({module: module, user : user}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function successCallback(response) {
            bootbox.alert(response.data, function () {
                $scope.loadUserData();
            });
        }, function errorCallback() {
            bootbox.alert("Операцію не вдалося виконати");
        });
    };
    $scope.addTrainer=function (url, scenario) {
        var id = document.getElementById('user').value;
        var trainerId = (scenario == "remove") ? 0 : $jq("#trainer").val();
        var oldTrainerId = 0;//(scenario != "new") ? $jq("#oldTrainerId").val() : 0;
        if (trainerId == 0 && scenario != "remove") {
            bootbox.alert("Виберіть тренера.");
        }
        $http({
            method: 'POST',
            url: url,
            data: $jq.param({userId: id, trainerId: trainerId, oldTrainerId: oldTrainerId}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function successCallback(response) {
            if (response.data == "success") {
                bootbox.alert('Операцію успішно виконано.', function () {
                    if(scenario == "new") $state.go('admin/users/user/:id/changetrainer', {id:id}, {reload: true});
                    else $scope.loadUserData();
                });
            }else{
                $scope.loadUserData();
                bootbox.alert(response.data)
            }
        }, function errorCallback() {
            bootbox.alert("Операцію не вдалося виконати");
        });
    };

    $scope.collapse=function (el) {
        $jq(el).toggle("medium");
    };

    $scope.cancelModuleAttr=function(url, id, attr, role, user, successUrl,tab,header){
        if (!user) {
            user = $jq('#user').val();
        }
        if (!role) {
            role = $jq('#role').val();
        }
        if (user && role) {
            $http({
                method: "POST",
                url: url,
                data: $jq.param({user: user, role: role, attribute: attr, attributeValue: id}),
                headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                cache: false
            }).then(function successCallback(response) {
                if (response.data == "success") {
                    bootbox.alert("Операцію успішно виконано.", function () {
                        $templateCache.remove(basePath+'/_teacher/_content_manager/contentManager/showTeacher/id/'+user);
                        $state.go($state.current, {}, {reload: true});
                    });
                } else {
                    showDialog("Операцію не вдалося виконати.");
                }
            }, function errorCallback() {
                bootbox.alert("Операцію не вдалося виконати.");
            });
        }
    };
}

function moduleAuthorsCtrl($scope, usersService, $http, NgTableParams){

    $scope.authorsTable = new NgTableParams({}, {
        getData: function (params) {
            $scope.params=params.url();
            $scope.params.startDate=$scope.startDate;
            $scope.params.endDate=$scope.endDate;
            return usersService
                .authorsList($scope.params)
                .$promise
                .then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
        }
    });
}