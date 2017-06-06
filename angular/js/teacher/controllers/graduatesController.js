/**
 * Created by adm on 10.08.2016.
 */
angular
    .module('teacherApp')
    .controller('graduateCtrl',graduateCtrl);

function graduateCtrl ($scope, $http, graduates, NgTableParams, translitService, typeAhead, $httpParamSerializerJQLike, $filter){

    $scope.addGraduate = function () {
        $http({
            method:'POST',
            url: basePath+'/_teacher/graduate/addGraduate',
            data: $httpParamSerializerJQLike({Graduate:$scope.graduate}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).success(function (response) {
            if (typeof response === 'object'){
                $scope.errors = response.errors;
                return false;
            }
        })
    }

    $scope.selectedUser = function ($item, $model, $label, $event) {
        $scope.graduate.first_name_en = translitService.translitPlease('ua-en',$item.firstName);
        $scope.graduate.last_name_en = translitService.translitPlease('ua-en',$item.secondName);
    }

    $scope.format = 'shortDate';
    $scope.dateOptions = {
        showWeeks: true
    };

    // $scope.$watch('graduate.date_done', function (newValue) {
    //     $scope.graduate.date_done = $filter('shortDate')(newValue, 'dd-MM-yyyy');
    // });

    $scope.openDatepicker = function() {
        $scope.open = !$scope.open;
    };

    $scope.getAllUsersByOrganization = function (value) {

        return typeAhead.getData(basePath+"/_teacher/graduate/getusers",{query : value});
    };

    $scope.getAllCoursesByOrganization = function (value) {

        return typeAhead.getData(basePath+"/_teacher/graduate/getAllCourses",{query : value});
    };

    $scope.tableParams = new NgTableParams({}, {
        getData: function(params) {
            return graduates.list(params.url())
                .$promise
                .then(function (data) {
                    params.total(data.count); // recal. page nav controls
                    return data.rows;
                });
        }
    });

    $scope.deleteGraduatePhoto = function(graduateId){
        bootbox.confirm('Видалити фото випускника?', function (result) {
            if(result){
                $http({
                    method: 'POST',
                    url: basePath+'/_teacher/_admin/graduate/deletePhoto/',
                    data: $jq.param({'id': graduateId}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).success(function(){
                    bootbox.alert('Операцію виконано успішно.');
                    location.hash = '/graduate';
                }).error(function(){
                    bootbox.alert('Операцію не вдалося виконати.');
                })
            }
            else{
                bootbox.confirm('Операцію відмінено.')
            }
        })
    };
    $scope.deleteGraduate = function(graduateId){
        bootbox.confirm('Видалити випускника?', function (result) {
            if(result){
                $http({
                    method: 'POST',
                    url: basePath+'/_teacher/_admin/graduate/delete/',
                    data: $jq.param({'id': graduateId}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).success(function(response){
                    bootbox.alert(response);
                    location.hash = '/graduate';
                }).error(function(){
                    bootbox.alert('Операцію не вдалося виконати.');
                })
            }
            else{
                bootbox.confirm('Операцію відмінено.')
            }
        })
    };
}
