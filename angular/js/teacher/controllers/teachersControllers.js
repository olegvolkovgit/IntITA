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

    $scope.cancelTeacher = function (user) {
        bootbox.confirm('У коростивуча буде автоматично скасовано усі ролі співробітника, які йому належали. Скасувати права співробітника?', function (result) {
                if (result) {usersService.cancelTeacher({'userId': user}).$promise.then(function successCallback() {
                    $scope.teachersTableParams.reload();
                }, function errorCallback() {
                    bootbox.alert("Операцію не вдалося виконати");
                });
            }
        });
    }
}


function teachersCtrl($scope, $http, $state) {
    $scope.changePageHeader('Співробітник');

    $scope.onSelectUser = function ($item) {
        $scope.selectedUser = $item;
    };
   
    $scope.reloadUser = function(){
        $scope.selectedUser=null;
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
            $state.go('users/profile/:id', {id:response.data}, {reload: true});
        }, function errorCallback() {
            bootbox.alert("Помилка сервера. Призначити користувача співробітником не вдалося");
        });
    };
}