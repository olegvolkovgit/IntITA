angular
    .module('moduleRevisionsApp')
    .controller('moduleRevisionCtrl',moduleRevisionCtrl);

function moduleRevisionCtrl($rootScope,$scope, $http, getModuleData) {
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
        // var object =  JSON.stringify(lectureList);
        // object =  JSON.parse(object);
        var object=lectureList;
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
    // $scope.previewRevision = function(url) {
    //     location.href=url;
    // };
    // //send revision for approve
    // $scope.sendRevision = function(id) {
    //     $http({
    //         url: basePath+'/revision/sendForApproveLecture',
    //         method: "POST",
    //         data: $.param({idRevision: id}),
    //         headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
    //     }).then(function successCallback(response) {
    //         if(response.data!='')
    //             bootbox.alert(response.data);
    //         else
    //         getLectureData.getData(idRevision).then(function(response){
    //             $rootScope.lectureData=response;
    //             location.href=basePath+'/revision/previewLectureRevision?idRevision='+idRevision;
    //         });
    //     }, function errorCallback() {
    //         bootbox.alert("Відправити заняття на затвердження не вдалося. Зв'яжіться з адміністрацією");
    //         return false;
    //     });
    // };
    // //canceled edit revision by the editor
    // $scope.cancelEditByEditor = function(id) {
    //     $http({
    //         url: basePath+'/revision/cancelEditRevisionByEditor',
    //         method: "POST",
    //         data: $.param({idRevision: id}),
    //         headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
    //     }).then(function successCallback() {
    //         getLectureData.getData(idRevision).then(function(response){
    //             $rootScope.lectureData=response;
    //             location.href=basePath+'/revision/previewLectureRevision?idRevision='+idRevision;
    //         });
    //     }, function errorCallback() {
    //         bootbox.alert("Відмінити ревізію автором не вдалося. Зв'яжіться з адміністрацією");
    //         return false;
    //     });
    // };
    // //add new page for lecture revision
    // $scope.addPage = function() {
    //     $http({
    //         url: basePath+'/revision/addPage',
    //         method: "POST",
    //         data: $.param({idRevision:idRevision}),
    //         headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
    //     }).then(function successCallback() {
    //         getLectureData.getData(idRevision).then(function(response){
    //             $rootScope.lectureData=response;
    //             $('body,html').animate({scrollTop: $(document).height()}, 500);
    //         });
    //     }, function errorCallback(response) {
    //         if(response.status==403){
    //             bootbox.alert('У вас недостатньо прав для редагування сторінки.');
    //         }
    //         return false;
    //     });
    // };

    // //check whether you can send the lecture for approval
    // $scope.checkLecture = function() {
    //     $http({
    //         url: basePath+'/revision/checkLecture',
    //         method: "POST",
    //         data: $.param({idRevision:idRevision}),
    //         headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
    //     }).then(function successCallback(response) {
    //         bootbox.alert(response.data);
    //     }, function errorCallback() {
    //         console.log('checkLecture error');
    //         return false;
    //     });
    // };
    // //approve lecture
    // $scope.approveLecture = function() {
    //     $http({
    //         url: basePath+'/revision/sendForApproveLecture',
    //         method: "POST",
    //         data: $.param({idLecture:idRevision}),
    //         headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
    //     }).then(function successCallback() {
    //         bootbox.alert('Запит на підтвердження відправлено', function () {
    //             location.href = basePath+'/revision/previewLectureRevision?idRevision=' + idRevision;
    //         });
    //     }, function errorCallback(response) {
    //         console.log('error '+response.status);
    //         return false;
    //     });
    // };
}
