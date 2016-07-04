angular
    .module('moduleRevisionsApp')
    .controller('moduleRevisionCtrl',moduleRevisionCtrl);

function moduleRevisionCtrl($rootScope,$scope, $http, getModuleData, moduleRevisionsActions, moduleRevisionMessage) {
    redirectFromEdit=true;
    //revisions status
    $scope.revisionProposedToRelease='proposed_to_release';
    $scope.revisionReleased='released';
    $scope.revisionApproved='approved';
    //revisions status

    $scope.tempId=[];
    //load from service lecture data for scope
    getModuleData.getData(idRevision).then(function(response){
        $rootScope.moduleData=response;
        $scope.lectureInModule=$rootScope.moduleData.lectures;
        getModuleData.getApprovedLecture().then(function(response){
            $scope.approvedLecture=response;
            if($scope.approvedLecture.current){
                $.each($scope.approvedLecture.current, function(status) {
                    $.each($scope.approvedLecture.current[status], function(index) {
                        $.each($scope.lectureInModule, function(indexInModule) {
                            if($scope.lectureInModule[indexInModule]['id_lecture_revision']==$scope.approvedLecture.current[status][index]['id_lecture_revision']){
                                $scope.tempId.push($scope.lectureInModule[indexInModule]['id_lecture_revision']);
                                return false;
                            }
                        });
                    });
                    $scope.approvedLecture.current[status] = $scope.approvedLecture.current[status].filter(function(value) {
                        return !find($scope.tempId,value.id_lecture_revision)
                    });
                });
            }
        });
    });

    //find exist value in array or not
    function find(array, value) {

        for (var i = 0; i < array.length; i++) {
            if (array[i] == value) return true;
        }

        return false;
    }


    $scope.addRevisionToModuleFromCurrentList = function (lectureRevisionId, index, status) {
        var revision=$scope.approvedLecture.current[status][index];
        revision.list='current';
        revision.status=status;
        $scope.approvedLecture.current[status].splice(index, 1);
        $scope.lectureInModule.push(revision);
    };
    $scope.addRevisionToModuleFromForeignList= function (lectureRevisionId, index, status) {
        var revision=$scope.approvedLecture.foreign[status][index];
        revision.list='foreign';
        revision.status=status;
        $scope.approvedLecture.foreign[status].splice(index, 1);
        $scope.lectureInModule.push(revision);
    };

    $scope.removeRevisionFromModule= function (lectureRevisionId, index) {
        var revision=$scope.lectureInModule[index];
        $scope.lectureInModule.splice(index, 1);
        if(revision.list=='foreign'){
            $scope.approvedLecture.foreign[revision.status].push(revision);
        }else{
            if($scope.approvedLecture.current[revision.status]){
                $scope.approvedLecture.current[revision.status].push(revision);
            }else{
                $scope.approvedLecture.current['released'].push(revision);
            }
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
        if($scope.enabled!=false){
            $scope.enabled=false;
            var object = {};
            lectureList.forEach(function (item, index) {
                object[item.id_lecture_revision] = {
                    id_lecture_revision: item.id_lecture_revision,
                    lecture_order: index + 1
                };
            });
            $http({
                url: basePath + '/moduleRevision/editModuleRevision',
                method: "POST",
                data: $.param({moduleLectures: JSON.stringify(object), id_module_revision: idRevision}),
                headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
            }).then(function successCallback() {
                bootbox.alert("Зміни збережено", function () {
                    location.reload();
                });
                $scope.enabled=true;
            }, function errorCallback() {
                bootbox.alert("Зберегти зміни в ревізію не вдалося. Зв'яжіться з адміністрацією");
                $scope.enabled=true;
                return false;
            });
        }
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
        moduleRevisionsActions.sendModuleRevision(id).then(function(senResponse){
            bootbox.alert(senResponse, function () {
                getModuleData.getData(idRevision).then(function (response) {
                    $rootScope.moduleData = response;
                    if (redirect) {
                        location.href = basePath + '/moduleRevision/previewModuleRevision?idRevision=' + idRevision;
                    }
                });
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
        if($scope.enabled!=false) {
            $scope.enabled = false;
            moduleRevisionsActions.releaseModuleRevision(id).then(function () {
                $scope.enabled=true;
                getModuleData.getData(idRevision).then(function (response) {
                    $rootScope.moduleData = response;
                });
            });
        }
    };

    $scope.restoreModuleEditByEditor = function(id) {
        moduleRevisionsActions.restoreModuleEditByEditor(id).then(function(){
            getModuleData.getData(idRevision).then(function(response) {
                $rootScope.moduleData = response;
            });
        });
    };

    $scope.checkModuleRevision = function() {
        $http({
            url: basePath+'/moduleRevision/checkModuleRevision',
            method: "POST",
            data: $.param({idRevision:idRevision}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            bootbox.alert(response.data);
        }, function errorCallback(response) {
            console.log('checkLecture error');
            console.log(response);
            return false;
        });
    };

    $scope.sendModuleRevisionMessage = function(idRevision) {
        moduleRevisionMessage.sendMessage(idRevision);
    };
}

function getImgName (str){
    if (str.lastIndexOf('\\')){
        var i = str.lastIndexOf('\\')+1;
    }
    else{
        var i = str.lastIndexOf('/')+1;
    }
    var filename = str.slice(i);
    var uploaded = document.getElementById("avatarInfo");
    uploaded.innerHTML = filename;
}

/**
 * Created by Wizlight on 14.01.2016.
 */
function CheckFile(file)
{
    var msg;
    var error=0;
    var maxSize=1024*1024*5;
    if(file.files[0].size>maxSize)
        error=error+1;
    var filesExt = ['jpg', 'gif', 'png','jpeg'];
    var parts = $(file).val().split('.');
    if(filesExt.join().search(parts[parts.length - 1]) == -1){
        error=error+2;
    }
    if(error!=0){
        switch (error) {
            case 1:
                msg='Файл перевищує 5 Мб';
                break;
            case 2:
                msg='Неправильний формат файлу';
                break;
            case 3:
                msg='Файл перевищує 5 Мб. Неправильний формат файлу';
                break;
        }
        $('#errorMessage').text(msg);
        $('#errorMessage').show();
        $('#imgButton').attr('disabled','true');
    }else{
        $('#errorMessage').hide();
        $('#imgButton').removeAttr('disabled');
    }
}
