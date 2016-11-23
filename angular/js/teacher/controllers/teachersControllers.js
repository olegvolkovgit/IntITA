angular
    .module('teacherApp')
    .controller('teachersTableCtrl',teachersTableCtrl)
    .controller('teachersCtrl', teachersCtrl);

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
        bootbox.confirm('Змінити статус співробітника?', function (result) {
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
                        bootbox.alert("Статус співробітника змінено.");
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


function teachersCtrl($scope, $http, $state, $stateParams) {
    $scope.changePageHeader('Співробітник');
    $scope.teacher= new Object();
    $scope.loadTeacherData=function(id){
        $http({
            url: basePath+'/_teacher/_admin/teachers/getTeacherData',
            method: "POST",
            data: $jq.param({id:id}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            $scope.teacher=response.data;
        }, function errorCallback() {
            bootbox.alert("Отримати дані співробітника не вдалося");
        });
    };

    if($stateParams.id){
        $scope.loadTeacherData($stateParams.id);
    }
    $scope.onSelectUser = function ($item) {
        $scope.selectedUser = $item;
        $scope.generateEnglishName($scope.selectedUser.firstName, $scope.selectedUser.lastName, $scope.selectedUser.middleName);
    };
    $scope.generateEnglishName=function(first, last, middle) {
            $scope.generateFirst(first);
            $scope.generateMiddle(middle);
            $scope.generateLast(last);
    };
    
    $scope.generateFirst=function (first) {
        if(first)
        $scope.teacher.first_name_en=toEnglish(first);
    };
    $scope.generateMiddle=function (middle) {
        if(middle)
        $scope.teacher.middle_name_en=toEnglish(middle);
    };
    $scope.generateLast=function (last) {
        if(last)
        $scope.teacher.last_name_en=toEnglish(last);
    };
    
    $scope.reloadUser = function(){
        $scope.selectedUser=null;
    };

    $scope.sendTeacherForm= function (scenario) {
        if(scenario=='create') $scope.createTeacher();
        else $scope.updateTeacher();
    };
    $scope.createTeacher= function () {
        if(!$scope.selectedUser){
            bootbox.alert('Виберіть користувача');
            return;
        }
        $http({
            url: basePath+'/_teacher/_admin/teachers/create',
            method: "POST",
            data: $jq.param({
                userId: $scope.selectedUser.id,
                firstNameEn:$scope.teacher.first_name_en,
                middleNameEn:$scope.teacher.middle_name_en,
                lastNameEn:$scope.teacher.last_name_en,
                firstNameRu:$scope.teacher.first_name_ru,
                middleNameRu:$scope.teacher.middle_name_ru,
                lastNameRu:$scope.teacher.last_name_ru,
                profileTextFirst:$scope.teacher.profile_text_first,
                profileTextShort:$scope.teacher.profile_text_short,
                profileTextLast:$scope.teacher.profile_text_last,
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            if(response.data.error){
                bootbox.alert(response.data.error)
            }else if(response.data.userId){
                $state.go('admin/users/user/:id', {id:response.data.userId}, {reload: true});
            }else{
                bootbox.alert("Щось пішло не так");
            }
        }, function errorCallback() {
            bootbox.alert("Помилка сервера. Призначити користувача співробітником не вдалося");
        });
    };
    $scope.updateTeacher= function () {
        $http({
            url: basePath+'/_teacher/_admin/teachers/update',
            method: "POST",
            data: $jq.param({
                teacherId: $scope.teacher.user_id,
                firstNameEn:$scope.teacher.first_name_en,
                middleNameEn:$scope.teacher.middle_name_en,
                lastNameEn:$scope.teacher.last_name_en,
                firstNameRu:$scope.teacher.first_name_ru,
                middleNameRu:$scope.teacher.middle_name_ru,
                lastNameRu:$scope.teacher.last_name_ru,
                profileTextFirst:$scope.teacher.profile_text_first,
                profileTextShort:$scope.teacher.profile_text_short,
                profileTextLast:$scope.teacher.profile_text_last,
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            if(response.data.error){
                bootbox.alert(response.data.error)
            }else if(response.data.userId){
                bootbox.alert('Дані оновлено', function () {
                    $scope.loadTeacherData(response.data.userId);
                });
            }else{
                bootbox.alert("Щось пішло не так");
            }
        }, function errorCallback() {
            bootbox.alert("Помилка сервера. Призначити користувача співробітником не вдалося");
        });
    };
    // $scope.loadTeacherData = function () {
    //     $http.get(basePath + "/_teacher/_admin/teachers/loadJsonTeacherModel/g?id=" + $stateParams.id).then(function (response) {
    //         $scope.data = response.data;
    //     });
    // };
    // $scope.loadTeacherData();
    //
    // $scope.changeUserStatus = function (url, user, message) {
    //     bootbox.confirm(message, function (response) {
    //         if (response) {
    //             $http({
    //                 method: 'POST',
    //                 url: url,
    //                 data: $jq.param({user: user}),
    //                 headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    //             }).then(function successCallback(response) {
    //                 bootbox.confirm(response.data, function () {
    //                     $scope.loadTeacherData();
    //                 });
    //             }, function errorCallback() {
    //                 bootbox.alert("Операцію не вдалося виконати");
    //             });
    //         }
    //     });
    // };
    //
    // $scope.setTeacherRole = function (url) {
    //     var role = $scope.selectedRole;
    //     var teacher = $jq("#teacher").val();
    //     if (typeof role == 'undefined') {
    //         bootbox.alert('Роль не вибрана');
    //         return;
    //     }
    //     $http({
    //         method: "POST",
    //         url: url,
    //         data: $jq.param({role: role, teacher: teacher}),
    //         headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
    //         cache: false
    //     }).then(function successCallback(response) {
    //         bootbox.confirm(response.data, function () {
    //             $scope.loadTeacherData();
    //         });
    //     }, function errorCallback() {
    //         bootbox.alert("Операцію не вдалося виконати.");
    //     });
    // };
    //
    // $scope.addTeacherAttr = function (url, attr, id, role) {
    //     user = $jq('#user').val();
    //     if (!role) {
    //         role = $jq('#role').val();
    //     }
    //     var value = $jq(id).val();
    //
    //     if (value == 0) {
    //         bootbox.alert('Введіть дані форми.');
    //     }
    //     if (parseInt(user && value)) {
    //         $http({
    //             method: "POST",
    //             url: url,
    //             data: $jq.param({user: user, role: role, attribute: attr, attributeValue: value}),
    //             headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
    //             cache: false
    //         }).then(function successCallback(response) {
    //             if (response.data == "success") {
    //                 bootbox.alert("Операцію успішно виконано.", function () {
    //                     $scope.loadTeacherData();
    //                 });
    //             } else {
    //                 switch (role) {
    //                     case "trainer":
    //                         bootbox.alert(response.data);
    //                         break;
    //                     case "author":
    //                         bootbox.alert("Обраний модуль вже присутній у списку модулів даного викладача");
    //                         break;
    //                     case "consultant":
    //                         bootbox.alert("Консультанту вже призначений даний модуль для консультацій");
    //                         break;
    //                     case "teacher_consultant":
    //                         bootbox.alert("Обраний модуль вже присутній у списку модулів даного викладача");
    //                         break;
    //                     default:
    //                         bootbox.alert("Операцію не вдалося виконати");
    //                         break;
    //                 }
    //             }
    //         }, function errorCallback() {
    //             bootbox.alert("Операцію не вдалося виконати.");
    //         });
    //     }
    // };
    //
    // $scope.cancelUserRole=function (url, role, user) {
    //     bootbox.confirm("Скасувати роль?", function (response) {
    //         if (response) {
    //             $http({
    //                 method: 'POST',
    //                 url: url,
    //                 data: $jq.param({role: role, user: user}),
    //                 headers: {'Content-Type': 'application/x-www-form-urlencoded'}
    //             }).then(function successCallback(response) {
    //                 bootbox.alert(response.data, function () {
    //                     $scope.loadTeacherData();
    //                 });
    //             }, function errorCallback() {
    //                 bootbox.alert("Операцію не вдалося виконати");
    //             });
    //         }
    //     });
    // };
}