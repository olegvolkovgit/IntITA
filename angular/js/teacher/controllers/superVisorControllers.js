/**
 * Created by adm on 19.07.2016.
 */
angular
    .module('teacherApp')
    .controller('superVisorCtrl', superVisorCtrl)
    .controller('offlineGroupsTableCtrl', offlineGroupsTableCtrl)
    .controller('offlineGroupCtrl', offlineGroupCtrl)
    .controller('offlineGroupSubgroupsTableCtrl', offlineGroupSubgroupsTableCtrl)
    .controller('offlineSubgroupsTableCtrl', offlineSubgroupsTableCtrl)
    .controller('offlineSubgroupCtrl', offlineSubgroupCtrl)
    .controller('offlineStudentsSVTableCtrl', offlineStudentsSVTableCtrl)
    .controller('offlineStudentProfileCtrl', offlineStudentProfileCtrl)
    .controller('updateOfflineStudentCtrl', updateOfflineStudentCtrl)
    .controller('studentsWithoutGroupSVTableCtrl', studentsWithoutGroupSVTableCtrl)
    .controller('specializationsTableCtrl', specializationsTableCtrl)
    .controller('specializationCtrl', specializationCtrl)
    .controller('usersSVTableCtrl', usersSVTableCtrl)
    .controller('studentsSVTableCtrl', studentsSVTableCtrl)
    .controller('groupAccessCtrl', groupAccessCtrl)

function superVisorCtrl (){

}

function offlineGroupsTableCtrl ($scope, superVisorService, NgTableParams){
    $scope.offlineGroupsTableParams = new NgTableParams({}, {
        getData: function (params) {
            return superVisorService
                .offlineGroupsList(params.url())
                .$promise
                .then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
        }
    });
}

function offlineSubgroupsTableCtrl ($scope, superVisorService, NgTableParams){
    $scope.offlineSubgroupsTableParams = new NgTableParams({}, {
        getData: function (params) {
            return superVisorService
                .offlineSubgroupsList(params.url())
                .$promise
                .then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
        }
    });
}


function offlineStudentsSVTableCtrl ($scope, superVisorService, NgTableParams){
    $scope.changePageHeader('Студенти в підгрупах');
    $scope.offlineStudentsTableParams = new NgTableParams({}, {
        getData: function (params) {
            return superVisorService
                .offlineStudentsList(params.url())
                .$promise
                .then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
        }
    });
}

function studentsWithoutGroupSVTableCtrl ($scope, superVisorService, NgTableParams){
    $scope.changePageHeader('Усі студенти(офлайн ф.н.)');
    $scope.studentsWithoutGroupTableParams = new NgTableParams({}, {
        getData: function (params) {
            return superVisorService
                .studentsWithoutGroupList(params.url())
                .$promise
                .then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
        }
    });
}

function offlineGroupSubgroupsTableCtrl ($scope, superVisorService, NgTableParams, $stateParams){
    $scope.groupId=$stateParams.id;
    $scope.offlineGroupSubgroupsTableParams = new NgTableParams({'id':$scope.groupId}, {
        getData: function (params) {
            return superVisorService
                .offlineGroupSubgroupsList(params.url())
                .$promise
                .then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
        }
    });
}

function specializationsTableCtrl ($scope, superVisorService, $state, $http, $stateParams){
    $scope.changePageHeader('Спеціалізації груп');

    $scope.loadSpecializations=function(){
        return superVisorService
            .getSpecializationsList()
            .$promise
            .then(function (data) {
                $scope.specializations=data;
            });
    };
    $scope.loadSpecializations();

    $scope.createSpecialization= function () {
        $http({
            url: basePath+'/_teacher/_supervisor/superVisor/createSpecialization',
            method: "POST",
            data: $jq.param({name: $scope.specialization.name}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            bootbox.alert(response.data, function(){
                $state.go("supervisor/specializations", {}, {reload: true});
            });
        }, function errorCallback() {
            bootbox.alert("Створити спеціалізацію не вдалося. Помилка сервера.");
        });
    };
}

function specializationCtrl ($scope, $state, $http, $stateParams){
    $scope.changePageHeader('Спеціалізація');
    
    $scope.loadSpecializationData=function(){
        $http({
            url: basePath+'/_teacher/_supervisor/superVisor/getSpecializationData',
            method: "POST",
            data: $jq.param({id:$stateParams.id}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            $scope.specialization=response.data;
        }, function errorCallback() {
            bootbox.alert("Отримати дані спеціалізації не вдалося");
        });
    };
    $scope.loadSpecializationData();

    $scope.editSpecialization= function () {
        $http({
            url: basePath+'/_teacher/_supervisor/superVisor/updateSpecialization',
            method: "POST",
            data: $jq.param({id:$stateParams.id,name: $scope.specialization.name}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            bootbox.alert(response.data, function(){
                $state.go("supervisor/specializations", {}, {reload: true});
            });
        }, function errorCallback() {
            bootbox.alert("Відредагувати спеціалізацію не вдалося. Помилка сервера.");
        });
    };
}

function offlineGroupCtrl ($scope, $state, $http, $stateParams, superVisorService, NgTableParams, typeAhead){
    $scope.changePageHeader('Офлайн група');
    if($stateParams.id){
        $scope.groupId=$stateParams.id;
        $scope.offlineStudentsTableParams = new NgTableParams({'idGroup':$scope.groupId}, {
            getData: function (params) {
                return superVisorService
                    .offlineStudentsList(params.url())
                    .$promise
                    .then(function (data) {
                        params.total(data.count);
                        return data.rows;
                    });
            }
        });
        $scope.groupCoursesAccessParams = new NgTableParams({'idGroup':$scope.groupId}, {
            getData: function (params) {
                return superVisorService
                    .courseAccessList(params.url())
                    .$promise
                    .then(function (data) {
                        params.total(data.count);
                        return data.rows;
                    });
            }
        });
        $scope.groupModulesAccessParams = new NgTableParams({'idGroup':$scope.groupId}, {
            getData: function (params) {
                return superVisorService
                    .moduleAccessList(params.url())
                    .$promise
                    .then(function (data) {
                        params.total(data.count);
                        return data.rows;
                    });
            }
        });
    }

    $scope.loadGroupData=function(){
        $http({
            url: basePath+'/_teacher/_supervisor/superVisor/getGroupData',
            method: "POST",
            data: $jq.param({id:$stateParams.id}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            $scope.group=response.data;
            $scope.loadCityToModel($scope.group.city);
            $scope.loadCuratorToModel($scope.group.id_user_curator);
            $scope.changePageHeader('Офлайн група: '+$scope.group.name);
            $scope.selectedSpecialization=$scope.specializations[$scope.group.specialization-1].id;
        }, function errorCallback() {
            bootbox.alert("Отримати дані групи не вдалося");
        });
    };
    
    $scope.loadSpecializations=function(){
        return superVisorService
            .getSpecializationsList()
            .$promise
            .then(function (data) {
                $scope.specializations=data;
                if($stateParams.id)
                    $scope.loadGroupData();
                else $scope.loadCuratorToModel();
            });
    };
    $scope.loadSpecializations();

    $scope.sendFormOfflineGroup= function (scenario) {
        if(scenario=='new') $scope.createOfflineGroup();
        else $scope.editOfflineGroup();
    };
    $scope.createOfflineGroup= function () {
        if(!$scope.selectedCity){
            bootbox.alert('Виберіть місто з існуючого списку');
            return;
        }
        if(!$scope.selectedCurator){
            bootbox.alert('Виберіть куратора з існуючого списку');
            return;
        }
        $http({
            url: basePath+'/_teacher/_supervisor/superVisor/createOfflineGroup',
            method: "POST",
            data: $jq.param({
                name: $scope.group.name,
                date:$scope.group.start_date,
                specialization:$scope.selectedSpecialization,
                city:$scope.selectedCity.id,
                curator:$scope.selectedCurator.id
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            bootbox.alert(response.data, function(){
                $state.go("supervisor/offlineGroups", {}, {reload: true});
            });
        }, function errorCallback() {
            bootbox.alert("Створити групу не вдалося. Помилка сервера.");
        });
    };
    $scope.editOfflineGroup= function () {
        if(!$scope.selectedCity){
            bootbox.alert('Виберіть місто з існуючого списку');
            return;
        }
        $http({
            url: basePath+'/_teacher/_supervisor/superVisor/updateOfflineGroup',
            method: "POST",
            data: $jq.param({
                id:$stateParams.id,
                name: $scope.group.name,
                date:$scope.group.start_date,
                specialization:$scope.selectedSpecialization,
                city:$scope.selectedCity.id,
                curator:$scope.selectedCurator.id
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            bootbox.alert(response.data, function(){
                $state.go("supervisor/offlineGroup/:id", {id:$stateParams.id}, {reload: true});
            });
        }, function errorCallback() {
            bootbox.alert("Створити групу не вдалося. Помилка сервера.");
        });
    };

    //select curator
    $scope.loadCuratorToModel=function(curatorId){
        curatorId = typeof curatorId !== 'undefined' ? curatorId :'';
        $http.get(basePath + "/_teacher/_supervisor/superVisor/getCuratorById/?id="+curatorId).then(function (response) {
            $scope.curatorEntered = response.data.fullName;
            $scope.selectedCurator={id: response.data.id, name: response.data.fullName};
        });
    };
    $scope.onSelectCurator = function ($item) {
        $scope.selectedCurator = $item;
    };
    $scope.reloadCurator = function(){
        $scope.selectedCurator=null;
    };
    var curatorsTypeaheadUrl = basePath + '/_teacher/_supervisor/superVisor/curatorsByQuery';
    $scope.getCurators = function(value){
        return typeAhead.getData(curatorsTypeaheadUrl,{query : value});
    };
    //select city
    $scope.loadCityToModel=function(cityId){
        $http.get(basePath + "/_teacher/_supervisor/superVisor/getCityById/?id="+cityId).then(function (response) {
            $scope.cityEntered = response.data;
            $scope.selectedCity={id: cityId, title: response.data};
        });
    };
    $scope.onSelect = function ($item) {
        $scope.selectedCity = $item;
    };
    $scope.reload = function(){
        $scope.selectedCity=null;
    };
    var citiesTypeaheadUrl = basePath + '/_teacher/_supervisor/superVisor/citiesByQuery';
    $scope.getCities = function(value){
        return typeAhead.getData(citiesTypeaheadUrl,{query : value});
    };
}

function offlineSubgroupCtrl ($scope, $state, $http, $stateParams, superVisorService, NgTableParams, typeAhead){
    //select curator
    $scope.loadCuratorToModel=function(curatorId){
        curatorId = typeof curatorId !== 'undefined' ? curatorId :'';
        $http.get(basePath + "/_teacher/_supervisor/superVisor/getCuratorById/?id="+curatorId).then(function (response) {
            $scope.curatorEntered = response.data.fullName;
            $scope.selectedCurator={id: response.data.id, name: response.data.fullName};
        });
    };
    $scope.onSelectCurator = function ($item) {
        $scope.selectedCurator = $item;
    };
    $scope.reloadCurator = function(){
        $scope.selectedCurator=null;
    };
    var curatorsTypeaheadUrl = basePath + '/_teacher/_supervisor/superVisor/curatorsByQuery';
    $scope.getCurators = function(value){
        return typeAhead.getData(curatorsTypeaheadUrl,{query : value});
    };
    //select curator

    $scope.loadSubgroupData=function(subgroupId){
        $http({
            url: basePath+'/_teacher/_supervisor/superVisor/getSubgroupData',
            method: "POST",
            data: $jq.param({id:subgroupId}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            $scope.subgroup=response.data;
            $scope.changePageHeader('Офлайн підгрупа: '+$scope.subgroup.name);
            $scope.loadGroupData($scope.subgroup.group);
            $scope.loadCuratorToModel($scope.subgroup.id_user_curator);
        }, function errorCallback() {
            bootbox.alert("Отримати дані підгрупи не вдалося");
        });
    };
    $scope.loadGroupData=function(groupId){
        $http({
            url: basePath+'/_teacher/_supervisor/superVisor/getGroupData',
            method: "POST",
            data: $jq.param({id:groupId}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            $scope.group=response.data;
        }, function errorCallback() {
            bootbox.alert("Отримати дані групи не вдалося");
        });
    };

    if($stateParams.groupId) {
        $scope.groupId=$stateParams.groupId;
        $scope.loadGroupData($scope.groupId);
        $scope.loadCuratorToModel();
    }
    if($stateParams.id) {
        $scope.subgroupId = $stateParams.id;
        $scope.offlineStudentsTableParams = new NgTableParams({'idSubgroup': $scope.subgroupId}, {
            getData: function (params) {
                return superVisorService
                    .offlineStudentsList(params.url())
                    .$promise
                    .then(function (data) {
                        params.total(data.count);
                        return data.rows;
                    });
            }
        });
        $scope.loadSubgroupData($scope.subgroupId);
    };

    $scope.sendFormSubgroup= function (scenario) {
        if(scenario=='new') $scope.addSubgroup();
        else $scope.editSubgroup();
    };

    $scope.addSubgroup= function () {
        $http({
            url: basePath+'/_teacher/_supervisor/superVisor/addSubgroup',
            method: "POST",
            data: $jq.param({
                name: $scope.subgroup.name, 
                group: $scope.groupId, 
                data: $scope.subgroup.data, 
                curator: $scope.selectedCurator.id
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            bootbox.alert(response.data, function(){
                $state.go("supervisor/offlineGroup/:id", {id:$scope.groupId}, {reload: true});
            });
        }, function errorCallback() {
            bootbox.alert("Створити групу не вдалося. Помилка сервера.");
        });
    };
    $scope.editSubgroup= function () {
        $http({
            url: basePath+'/_teacher/_supervisor/superVisor/updateSubgroup',
            method: "POST",
            data: $jq.param({
                id:$scope.subgroupId,
                name: $scope.subgroup.name, 
                data: $scope.subgroup.data,
                curator: $scope.selectedCurator.id
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            bootbox.alert(response.data, function(){
                $state.go("supervisor/offlineSubgroup/:id", {id:$scope.subgroupId}, {reload: true});
            });
        }, function errorCallback() {
            bootbox.alert("Редагувати підгрупу не вдалося. Помилка сервера.");
        });
    };
    $scope.goBack= function () {
        if($stateParams.groupId) {
            $state.go('supervisor/offlineGroup/:id', {id:$stateParams.groupId}, {reload: true});
        } else if($stateParams.id) {
            $state.go('supervisor/offlineSubgroup/:id', {id:$stateParams.id}, {reload: true});
        }
    };
}

function offlineStudentProfileCtrl ($scope, $state, $http, $stateParams, typeAhead, superVisorService){
    $scope.changePageHeader('Користувач');
    $scope.studentId=$stateParams.id;
    $scope.loadUserData=function(studentId){
        $http.get(basePath + "/_teacher/_supervisor/superVisor/getUserData/?id="+studentId).then(function (response) {
            $scope.user = response.data.user;
            $scope.offlineStudent=response.data.offlineStudent;
        });
    };
    $scope.loadUserData($scope.studentId);

    $scope.addTrainer=function (url, scenario) {
        var id = document.getElementById('user').value;
        var trainerId = (scenario == "remove") ? 0 : $jq("#trainer").val();
        var oldTrainerId = 0;
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
                    if(scenario == "new") $state.go('supervisor/student/:id/changetrainer', {id:id}, {reload: true});
                    else if(scenario == "remove") $state.go('supervisor/student/:id/addtrainer', {id:id}, {reload: true});
                    else $state.reload();
                });
            }else{
                $scope.loadUserData($scope.studentId);
                bootbox.alert(response.data)
            }
        }, function errorCallback() {
            bootbox.alert("Операцію не вдалося виконати");
        });
    };

    $scope.addStudentToSubgroup=function (idUser,idSubgroup,startDate) {
        if ($scope.selectedGroup==null) {
            bootbox.alert("Виберіть групу");
        } else if($scope.selectedSubgroup==null){
            bootbox.alert("Виберіть підгрупу");
        } else if($scope.user.id==null){
            bootbox.alert("Виберіть студента");
        }else{
            $http({
                method: 'POST',
                url: basePath+'/_teacher/_supervisor/superVisor/addStudentToSubgroup',
                data: $jq.param({userId: idUser, subgroupId: idSubgroup, startDate: startDate}),
                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
            }).then(function successCallback(response) {
                bootbox.alert(response.data, function () {
                    $state.go('supervisor/studentsWithoutGroup');
                });
            }, function errorCallback() {
                bootbox.alert("Операцію не вдалося виконати");
            });
        }
    };

    $scope.cancelStudentFromSubgroup=function (idUser, idSubgroup) {
        $http({
            method: 'POST',
            url: basePath+'/_teacher/_supervisor/superVisor/cancelStudentFromSubgroup',
            data: $jq.param({userId: idUser, subgroupId: idSubgroup}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function successCallback(response) {
            bootbox.alert(response.data);
            $scope.loadUserData(idUser);
        }, function errorCallback() {
            bootbox.alert("Операцію не вдалося виконати");
        });
    };
    
    $scope.onSelect = function ($item) {
        $scope.selectedGroup = $item;
        superVisorService
            .offlineGroupSubgroupsList({'id':$scope.selectedGroup.id})
            .$promise
            .then(function (data) {
                $scope.subgroupsList=data.rows;
            });
    };
    $scope.reload = function(){
        $scope.selectedGroup=null;
        $scope.selectedSubgroup=null;
        $scope.subgroupsList=null;
    };
}

function updateOfflineStudentCtrl ($scope, $state, $http, $stateParams, typeAhead, superVisorService){
    $scope.changePageHeader('Студент(офлайнова форма навчання)');
    $scope.studentModelId=$stateParams.idOfflineStudentModel;
    $scope.loadStudentModel=function(modelId){
        $http.get(basePath + "/_teacher/_supervisor/superVisor/getOfflineStudentModel/?id="+modelId).then(function (response) {
            $scope.studentModel = response.data;
            superVisorService
                .offlineGroupSubgroupsList({'id':$scope.studentModel.idGroup})
                .$promise
                .then(function (data) {
                    $scope.subgroupsList=data.rows;
                    $scope.selectedSubgroup={id:$scope.studentModel.idSubgroup};
                });
        });
    };
    $scope.loadStudentModel($scope.studentModelId);

    $scope.updateOfflineStudent=function (modelId, idUser, idSubgroup, newSubgroupId, startDate, graduateDate) {
        $http({
            method: 'POST',
            url: basePath+'/_teacher/_supervisor/superVisor/updateOfflineStudent',
            data: $jq.param({modelId: modelId, userId: idUser, subgroupId: idSubgroup, newSubgroupId: newSubgroupId, startDate: startDate, graduateDate: graduateDate}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function successCallback(response) {
            bootbox.alert(response.data);
            $scope.loadStudentModel($scope.studentModelId);
        }, function errorCallback() {
            bootbox.alert("Операцію не вдалося виконати");
        });
    };

    $scope.cancelStudentFromSubgroup=function (idUser, idSubgroup) {
        $http({
            method: 'POST',
            url: basePath+'/_teacher/_supervisor/superVisor/cancelStudentFromSubgroup',
            data: $jq.param({userId: idUser, subgroupId: idSubgroup}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function successCallback(response) {
            bootbox.alert(response.data);
            $scope.loadStudentModel($scope.studentModelId);
        }, function errorCallback() {
            bootbox.alert("Операцію не вдалося виконати");
        });
    };

    $scope.onSelect = function ($item) {
        $scope.selectedGroup = $item;
        superVisorService
            .offlineGroupSubgroupsList({'id':$scope.selectedGroup.id})
            .$promise
            .then(function (data) {
                $scope.subgroupsList=data.rows;
            });
    };
    $scope.reload = function(){
        $scope.selectedGroup=null;
        $scope.selectedSubgroup=null;
        $scope.subgroupsList=null;
    };
}

function usersSVTableCtrl ($scope, superVisorService, NgTableParams){
    $scope.changePageHeader('Зареєстровані користувачі');
    $scope.usersTableParams = new NgTableParams({}, {
        getData: function (params) {
            return superVisorService
                .usersList(params.url())
                .$promise
                .then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
        }
    });
}

function studentsSVTableCtrl ($scope, superVisorService, NgTableParams){
    $scope.changePageHeader('Усі студенти');

    $jq("#startDate").datepicker(lang);
    $jq("#endDate").datepicker(lang);

    $scope.studentsTableParams = new NgTableParams({}, {
        getData: function (params) {
            $scope.params=params.url();
            $scope.params.startDate=$scope.startDate;
            $scope.params.endDate=$scope.endDate;
            return superVisorService
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
                return superVisorService
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


function groupAccessCtrl ($scope, $state, $http, $stateParams, superVisorService, NgTableParams){
    $scope.changePageHeader('Доступ групи до контенту');
    $scope.onSelect = function ($item) {
        $scope.selectedGroup = $item;
    };
    $scope.reload = function(){
        $scope.selectedGroup=null;
    };
    $scope.onSelectCourse = function ($item) {
        $scope.selectedCourse = $item;
    };
    $scope.reloadCourse = function(){
        $scope.selectedCourse=null;
    };
    $scope.onSelectModule = function ($item) {
        $scope.selectedModule = $item;
    };
    $scope.reloadModule = function(){
        $scope.selectedModule=null;
    };
    $scope.clearContent = function(){
        $scope.selectedCourse=null;
        $scope.courseSelected=null;
        $scope.selectedModule=null;
        $scope.moduleSelected=null;
    };
    
    $scope.sendGroupAccessToContent=function(idGroup, idContent, startDate, endDate, serviceType){
        if(idGroup && idContent && startDate && endDate){
            $http({
                url: basePath+'/_teacher/_supervisor/superVisor/setGroupAccessToService',
                method: "POST",
                data: $jq.param({
                    idGroup:idGroup,
                    idContent:idContent,
                    startDate:startDate,
                    endDate:endDate,
                    serviceType:serviceType
                }),
                headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
            }).then(function successCallback(response) {
                $scope.addUIHandlers(response.data);
                $scope.clearContent();
            }, function errorCallback(response) {
                console.log(response);
                bootbox.alert("Виникла помилка");
            });
        }else{
            bootbox.alert("Введіть всі необхідні дані форми");
        }
    }
}