/**
 * Created by adm on 10.08.2016.
 */
angular
    .module('teacherApp')
    .controller('graduateCtrl',graduateCtrl)
    .controller('editGraduateCtrl',editGraduateCtrl);
function graduateCtrl ($rootScope, $scope, $filter, $http, graduates, NgTableParams, translitService, typeAhead, $httpParamSerializerJQLike, $state, $stateParams, $ngBootbox, $timeout){

    $scope.publishStatus = [{id:'0', title:'Не опубліковано'},{id:'1', title:'Опубліковано'}];
    $rootScope.$on('userCreated', function (event, data) {
        $scope.graduate.user = data;
        $scope.noResults = false;
    });

    if ($state.is('graduate/edit/:graduateId')){
        $scope.courseCollapsed = true;
        $scope.modulesCollapsed = true;
        $http.get('/_teacher/graduate/getGraduateData/'+$stateParams.graduateId).then(function (response) {
            $scope.graduate = response.data;
            $scope.graduate.graduate_date = new Date($scope.graduate.graduate_date);
        });

    }

    $scope.addGraduate = function () {

        $http({
            method:'POST',
            url: basePath+'/_teacher/graduate/addGraduate',
            data: $httpParamSerializerJQLike({Graduate:$scope.graduate}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).success(function (response) {
            if (typeof response === 'object'){
                $scope.errors = response.errors;
                bootbox.alert(JSON.stringify($scope.errors));
                return false;
            }
            else{
                $state.go('graduate');
            }
        })
    }

    $scope.selectedUser = function ($item, $model, $label, $event) {
        $scope.graduate.first_name_en = translitService.translitPlease('ua-en',$item.firstName);
        $scope.graduate.last_name_en = translitService.translitPlease('ua-en',$item.secondName);
    }

    $scope.format = 'dd-MM-yyyy';
    $scope.dateOptions = {
        showWeeks: true
    };

    $scope.openDatepicker = function() {
        $scope.open = !$scope.open;
    };

    $scope.getAllUsersByOrganization = function (value) {

        return typeAhead.getData(basePath+"/_teacher/graduate/getusers",{query : value});
    };

    $scope.getAllCoursesByOrganization = function (value) {

        return typeAhead.getData(basePath+"/_teacher/graduate/getAllCourses",{query : value});
    };

    $scope.getAllModulesByOrganization = function (value) {

        return typeAhead.getData(basePath+"/_teacher/graduate/getAllModules",{query : value});
    };

    $scope.tableParams = new NgTableParams({
        sorting: {
            id: 'desc'
        },
    }, {
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
                bootbox.alert('Операцію відмінено.')
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
                bootbox.alert('Операцію відмінено.')
            }
        })
    };

    $scope.changeGraduateStatus = function (item) {
        bootbox.confirm('Змінити статус публікації відгуку на сайті?', function (result) {
            if(result){
                $http({
                    method: 'POST',
                    url: basePath+'/_teacher/graduate/changeStatus/',
                    data: $jq.param({'id': item.id}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).success(function(response){
                    item.published = !item.published;
                }).error(function(){
                    bootbox.alert('Операцію не вдалося виконати.');
                })
            }
        })
    };

    $scope.updateGraduate = function () {
        
        $http({
            method:'POST',
            url: basePath+'/_teacher/graduate/updateGraduate',
            data: $httpParamSerializerJQLike({'Graduate':$scope.graduate}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).success(function (response) {
            if (typeof response === 'object'){
                $scope.errors = response.errors;
                bootbox.alert(JSON.stringify($scope.errors));
                return false;
            }
            else{
                $state.go('graduate');
            }
        })
    }

    $scope.changeRating = function (type, data) {
        $scope.changeData = data;
        $scope.changeData.type = type;
        $scope.customDialogOptions = {
            templateUrl: '/angular/js/teacher/templates/addRate.html',
            scope: $scope,
            title: 'Змінити рейтинг',
        };
        $ngBootbox.customDialog($scope.customDialogOptions);
    };

    $scope.deleteRating = function (type,id) {
        $ngBootbox.confirm("Ви дійсно бажаєте видалити рейтинг по даному сервісу у студента?")
            .then(function() {
                $http({
                    method:'POST',
                    url: basePath+'/_teacher/graduate/deleteRating',
                    data: $httpParamSerializerJQLike({Rating:{'id':id,type:type}}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).success(function (response) {
                    if (typeof response === 'object'){
                        $scope.errors = response.errors;
                        bootbox.alert(JSON.stringify($scope.errors));
                        return false;
                    }
                    else{
                        $state.go('graduate/edit/:graduateId',{graduateId:$stateParams.graduateId});
                    }
                })
            }, function() {

            });
    }

    $scope.addRating = function (type) {
        $scope.addRatingType = type;
        $scope.customDialogOptions = {
            templateUrl: '/angular/js/teacher/templates/addServiceRate.html',
            scope: $scope,
            title: 'Дотати рейтинг',
        };
        $ngBootbox.customDialog($scope.customDialogOptions);
    }

}

function editGraduateCtrl($scope, $http, $state, $httpParamSerializerJQLike, $stateParams, $ngBootbox, typeAhead) {
    $scope.getRatingScale = function () {
        return new Array(Number($scope.graduate.ratingScale));
    }
    $scope.changeRate = function () {
        $http({
            method:'POST',
            url: basePath+'/_teacher/graduate/updateRating',
            data: $httpParamSerializerJQLike({'Rating':$scope.changeData}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).success(function (response) {
            if (typeof response === 'object'){
                $scope.errors = response.errors;
                bootbox.alert(JSON.stringify($scope.errors));
                return false;
            }
            else{
                $ngBootbox.hideAll();
                $state.go('graduate/edit/:graduateId',{graduateId:$stateParams.graduateId});
            }
        })
    };
    $scope.getServicesName = function (value) {
        return typeAhead.getData(basePath+'/_teacher/graduate/getServicesList',{query:value, type:$scope.addRatingType});
    };
    $scope.onSelectService = function(item)
    {
        $scope.service = item;
    };

    $scope.addRate = function () {
        $http({
            method:'POST',
            url: basePath+'/_teacher/graduate/addRating',
            data: $httpParamSerializerJQLike({'Rating':{service:$scope.service, rating:$scope.rating, user:$scope.graduate.id_user, type: $scope.addRatingType}}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).success(function (response) {
            if (typeof response === 'object'){
                $scope.errors = response.errors;
                bootbox.alert(JSON.stringify($scope.errors));
                return false;
            }
            else{
                $ngBootbox.hideAll();
                $state.go('graduate/edit/:graduateId',{graduateId:$stateParams.graduateId});
            }
        })
    }


}