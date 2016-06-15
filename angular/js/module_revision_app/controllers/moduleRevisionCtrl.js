angular
    .module('moduleRevisionsApp')
    .controller('moduleRevisionCtrl',moduleRevisionCtrl);

function moduleRevisionCtrl($rootScope,$scope, $http, getModuleData, moduleRevisionsActions) {
    $scope.tempId=[];
    //load from service lecture data for scope
    getModuleData.getData(idRevision).then(function(response){
        $rootScope.moduleData=response;
        $scope.lectureInModule=$rootScope.moduleData.lectures;
        getModuleData.getApprovedLecture().then(function(response){
            $scope.approvedLecture=response;
            $.each($scope.approvedLecture.current, function(index) {
                $.each($scope.lectureInModule, function(indexInModule) {
                    if($scope.lectureInModule[indexInModule]['id_lecture_revision']==$scope.approvedLecture.current[index]['id_lecture_revision']){
                        $scope.tempId.push($scope.lectureInModule[indexInModule]['id_lecture_revision']);
                        return false;
                    }
                });
            });
            $scope.approvedLecture.current = $scope.approvedLecture.current.filter(function(value) {
                return !find($scope.tempId,value.id_lecture_revision)
            });
        });
    });

    //find exist value in array or not
    function find(array, value) {

        for (var i = 0; i < array.length; i++) {
            if (array[i] == value) return true;
        }

        return false;
    }


    $scope.addRevisionToModuleFromCurrentList = function (lectureRevisionId, index) {
        var revision=$scope.approvedLecture.current[index];
        revision.list='current';
        $scope.approvedLecture.current.splice(index, 1);
        $scope.lectureInModule.push(revision);
    };
    $scope.addRevisionToModuleFromForeignList= function (lectureRevisionId, index) {
        var revision=$scope.approvedLecture.foreign[index];
        revision.list='foreign';
        $scope.approvedLecture.foreign.splice(index, 1);
        $scope.lectureInModule.push(revision);
    };
    
    $scope.removeRevisionFromModule= function (lectureRevisionId, index) {
        var revision=$scope.lectureInModule[index];
        $scope.lectureInModule.splice(index, 1);
        if(revision.list=='foreign'){
            $scope.approvedLecture.foreign.push(revision);
        }else{
            $scope.approvedLecture.current.push(revision);
        }
    };
    //reorder pages
    $scope.upRevisionInModule = function(lectureRevisionId, index) {
        if(index>0){
            var prevRevision=$scope.lectureInModule[index-1];
            $scope.lectureInModule[index-1]=$scope.lectureInModule[index];
            $scope.lectureInModule[index]=prevRevision;
        }
    };
    $scope.downRevisionInModule = function(lectureRevisionId, index) {
        if(index<$scope.lectureInModule.length-1){
            var nextRevision=$scope.lectureInModule[index+1];
            $scope.lectureInModule[index+1]=$scope.lectureInModule[index];
            $scope.lectureInModule[index]=nextRevision;
        }
    };

    $scope.editModuleRevision = function (lectureList) {
        var object =  JSON.stringify(lectureList);
        object =  JSON.parse(object);
        $.each(object, function(index) {
            object[index]['lecture_order']=index+1;
            object[index]['id_module_revision']=idRevision;
            delete object[index]['title'];
            delete object[index]['link'];
        });
        $http({
            url: basePath+'/moduleRevision/editModuleRevision',
            method: "POST",
            data: $.param({moduleLectures: JSON.stringify(object), idModule:idModule}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback() {
            bootbox.alert("Зміни збережено", function () {
                location.reload();
            });
        }, function errorCallback() {
            bootbox.alert("Зберегти зміни в ревізію не вдалося. Зв'яжіться з адміністрацією");
            return false;
        });
    };
    $scope.previewModuleRevision = function(url) {
        location.href=url;
    };
    //edit revision
    $scope.editModuleRevisionPage = function(url) {
        location.href=url;
    };
    //approve revision
    $scope.approveModuleRevision = function(id) {
        moduleRevisionsActions.approveModuleRevision(id).then(function(){
            getModuleData.getData(idRevision).then(function(response) {
                $rootScope.moduleData = response;
            });
        });
    };
    //send revision for approve
    $scope.sendModuleRevision = function(id, redirect) {
        moduleRevisionsActions.sendModuleRevision(id).then(function(){
            getModuleData.getData(idRevision).then(function(response) {
                $rootScope.moduleData = response;
                if(redirect){
                    location.href=basePath+'/moduleRevision/previewModuleRevision?idRevision='+idRevision;
                }
            });
        });
    };
    //canceled edit revision by the editor
    $scope.cancelModuleEditByEditor = function(id, redirect) {
        moduleRevisionsActions.cancelModuleEditByEditor(id).then(function(){
            getModuleData.getData(idRevision).then(function(response) {
                $rootScope.moduleData = response;
                if(redirect){
                    location.href=basePath+'/moduleRevision/previewModuleRevision?idRevision='+idRevision;
                }
            });
        });
    };

    $scope.cancelSendModuleRevision = function(id) {
        moduleRevisionsActions.cancelSendModuleRevision(id).then(function(){
            getModuleData.getData(idRevision).then(function(response) {
                $rootScope.moduleData = response;
            });
        });
    };

    $scope.cancelModuleRevision = function(id) {
        moduleRevisionsActions.cancelModuleRevision(id).then(function(){
            getModuleData.getData(idRevision).then(function(response) {
                $rootScope.moduleData = response;
            });
        });
    };

    $scope.rejectModuleRevision = function(id) {
        moduleRevisionsActions.rejectModuleRevision(id).then(function(){
            getModuleData.getData(idRevision).then(function(response) {
                $rootScope.moduleData = response;
            });
        });
    };

    $scope.releaseModuleRevision = function(id) {
        moduleRevisionsActions.releaseModuleRevision(id).then(function(){
            getModuleData.getData(idRevision).then(function(response) {
                $rootScope.moduleData = response;
            });
        });
    };

    $scope.restoreModuleEditByEditor = function(id) {
        moduleRevisionsActions.restoreModuleEditByEditor(id).then(function(){
            getModuleData.getData(idRevision).then(function(response) {
                $rootScope.moduleData = response;
            });
        });
    };
}
