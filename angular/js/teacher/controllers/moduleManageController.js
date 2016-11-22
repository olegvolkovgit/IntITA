/**
 * Created by adm on 08.08.2016.
 */
angular
    .module('teacherApp')
    .controller('modulesTableCtrl',modulesTableCtrl)
    .controller('moduleManageCtrl',moduleManageCtrl)
    .controller('moduleAuthorsTableCtrl',moduleAuthorsTableCtrl)
    .controller('moduleTeachersConsultantTableCtrl',moduleTeachersConsultantTableCtrl);

function modulesTableCtrl ($scope, NgTableParams, $resource){
    $scope.changePageHeader('Модулі');

    var dataFromServer = $resource(basePath+'/_teacher/_admin/module/getModulesList');
    $scope.modulesTable = new NgTableParams({
        sorting:{'module_ID':"asc"}}, {
        getData: function(params) {
            return dataFromServer.get(params.url()).$promise.then(function(data) {
                params.total(data.count);
                return data.rows;
            });
        }
    });

    $scope.statuses = [{id:'0', title:'в розробці'},{id:'1', title:'готовий'}];
    $scope.cancelled = [{id:'0', title:'доступний'},{id:'1', title:'видалений'}];
    $scope.lang = [{id:'ua', title:'ua'},{id:'ru', title:'ru'},{id:'en', title:'en'}];

    $scope.levels = $resource(basePath+'/_teacher/_admin/level/getlevelslist').get()
        .$promise.then(function(data){
            var levels = [];
            data.rows.forEach(function(element){
                levels.push({
                    'id': element.id,
                    'title': element.title_ua
                })
            });
            return levels;
        });
}
function moduleManageCtrl ($scope, $http, $stateParams){
    $scope.changePageHeader('Модуль');
    $scope.moduleId=$stateParams.moduleId;

    $scope.changeStatus = function(moduleId, status){
        var url;
        switch (status){
            case 'delete':
                url = basePath+'/_teacher/_admin/module/delete/id/'+moduleId;
                break;
            case 'restore':
                url = basePath+'/_teacher/_admin/module/restore/id/'+moduleId;
                break;
        }
        bootbox.confirm("Ви впевнені?", function (result) {
            if(result){
                $http({
                    method: "POST",
                    url:  url,
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                }).success(function(message){
                    bootbox.alert(message);
                    location.hash = '/module/view/'+moduleId;
                }).error(function(){
                    bootbox.alert("Операцію не вдалося виконати.");
                })
            }
            else
            {
                bootbox.alert("Операцію відмінено");
            }
        })
    };
    
    //add module tags
    $scope.checkTags = function() {
        moduleTags=$scope.moduleTags;
    };
    
    $scope.languages = [
        {name: 'українською', value: 'ua'},
        {name: 'російською', value: 'ru'},
        {name: 'англійською', value: 'en'}
    ];

    //manipulations with module tags
    $scope.tagsList = function() {
        var promise = $http({
            url: basePath+'/module/getTagsList',
            method: "POST",
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            $scope.allTags=response.data;
            $scope.tags=response.data;
        }, function errorCallback() {
            bootbox.alert('Виникла помилка при завантажені хмарини тегів');
            return false;
        });
        return promise;
    };

    // create or update module tags
    $scope.moduleTags=[];

    $scope.tagsList().then(function successCallback() {
        $scope.tagsLoaded=true;
        if(typeof $scope.moduleId!='undefined'){
            $scope.tagsLoaded=false;
            $http({
                url: basePath+'/module/getModuleTags',
                method: "POST",
                data: $jq.param({"idModule":$scope.moduleId }),
                headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
            }).then(function successCallback(response) {
                $scope.moduleTags = response.data;
                $jq.each($scope.moduleTags, function(indexModuleTag) {
                    $jq.each($scope.allTags, function(indexTag) {
                        if($scope.allTags[indexTag]['id']==$scope.moduleTags[indexModuleTag]['id']){
                            $scope.allTags.splice(indexTag, 1);
                            return false;
                        }
                    });
                });
                $scope.tagsLoaded=true;
            }, function errorCallback() {
                bootbox.alert('Виникла помилка при завантажені хмарини тегів');
                return false;
            });
        }
    });

    $scope.addTag = function(tag,index) {
        $scope.moduleTags.push({id: tag.id, tag: tag.tag});
        $scope.tags.splice(index, 1);
    };
    $scope.removeTag = function(tag,index) {
        $scope.tags.push({id: tag.id, tag: tag.tag});
        $scope.moduleTags.splice(index, 1);
    };
}

function moduleAuthorsTableCtrl ($scope, NgTableParams, $resource,$stateParams,roleAttributeService){
    var dataFromServer = $resource(basePath+'/_teacher/_admin/module/getModuleAuthorsList');
    $scope.moduleAuthorsTable = new NgTableParams({'idModule':$stateParams.moduleId}, {
        getData: function(params) {
            return dataFromServer.get(params.url()).$promise.then(function(data) {
                params.total(data.count);
                return data.rows;
            });
        }
    });

    $scope.cancelTeacherRoleAttribute=function(role, attribute, userId, attributeId){
        roleAttributeService
            .unsetRoleAttribute({
                'attribute': attribute,
                'attributeValue':attributeId,
                'role': role,
                'userId' : userId
            })
            .$promise
            .then(function successCallback(response) {
                if(response.data=='success')
                    $scope.moduleAuthorsTable.reload();
                else bootbox.alert("Операцію не вдалося виконати");
            }, function errorCallback(data) {
                console.log(data);
                bootbox.alert("Операцію не вдалося виконати");
            });
    };
}

function moduleTeachersConsultantTableCtrl ($scope, NgTableParams, $resource,$stateParams,roleAttributeService){
    var dataFromServer = $resource(basePath+'/_teacher/_admin/module/getModuleTeachersConsultantList');
    $scope.moduleTeachersConsultantTable = new NgTableParams({'idModule':$stateParams.moduleId}, {
        getData: function(params) {
            return dataFromServer.get(params.url()).$promise.then(function(data) {
                params.total(data.count);
                return data.rows;
            });
        }
    });

    $scope.cancelTeacherRoleAttribute=function(role, attribute, userId, attributeId){
        roleAttributeService
            .unsetRoleAttribute({
                'attribute': attribute,
                'attributeValue':attributeId,
                'role': role,
                'userId' : userId
            })
            .$promise
            .then(function successCallback(response) {
                if(response.data=='success')
                    $scope.moduleTeachersConsultantTable.reload();
                else bootbox.alert("Операцію не вдалося виконати");
            }, function errorCallback(data) {
                console.log(data);
                bootbox.alert("Операцію не вдалося виконати");
            });
    };
}