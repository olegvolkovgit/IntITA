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
                userId: $scope.selectedUser.id
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            if(response.data.error){
                bootbox.alert(response.data.error)
            }else if(response.data.userId){
                $state.go('users/profile/:id', {id:response.data.userId}, {reload: true});
            }else{
                bootbox.alert("Щось пішло не так");
            }
        }, function errorCallback() {
            bootbox.alert("Помилка сервера. Призначити користувача співробітником не вдалося");
        });
    };
}