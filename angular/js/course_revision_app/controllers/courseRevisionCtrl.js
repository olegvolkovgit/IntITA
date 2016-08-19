angular
    .module('courseRevisionsApp')
    .controller('courseRevisionCtrl',courseRevisionCtrl)
    .controller('moduleCreateCtrl',moduleCreateCtrl);

function courseRevisionCtrl($rootScope,$scope, $http, getCourseData, courseRevisionsActions, courseRevisionMessage) {
    redirectFromEdit=true;
    //revisions status
    $scope.readyModule='ready_module';
    $scope.developModule='develop_module';
    //revisions status

    $scope.tempId=[];
    //load from service lecture data for scope
    getCourseData.getData(idRevision).then(function(response){
        $rootScope.courseData=response;
        $scope.moduleInCourse=$rootScope.courseData.modules;
        getCourseData.getModules().then(function(response){
            $scope.readyModules=response;
            if($scope.readyModules.current){
                $.each($scope.readyModules.current, function(status) {
                    $.each($scope.readyModules.current[status], function(index) {
                        $.each($scope.moduleInCourse, function(indexInCourse) {
                            if($scope.moduleInCourse[indexInCourse]['id']==$scope.readyModules.current[status][index]['id']){
                                $scope.tempId.push($scope.moduleInCourse[indexInCourse]['id']);
                                return false;
                            }
                        });
                    });
                    $scope.readyModules.current[status] = $scope.readyModules.current[status].filter(function(value) {
                        return !find($scope.tempId,value.id)
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


    $scope.addRevisionToCourseFromCurrentList = function (moduleId, index, status) {
        var module=$scope.readyModules.current[status][index];
        module.list='current';
        module.status=status;
        $scope.readyModules.current[status].splice(index, 1);
        $scope.moduleInCourse.push(module);
    };
    $scope.addRevisionToCourseFromForeignList= function (moduleId, index, status) {
        var module=$scope.readyModules.foreign[status][index];
        module.list='foreign';
        module.status=status;
        $scope.readyModules.foreign[status].splice(index, 1);
        $scope.moduleInCourse.push(module);
    };

    $scope.removeModuleFromCourse= function (moduleId, index) {
        var module=$scope.moduleInCourse[index];
        $scope.moduleInCourse.splice(index, 1);
        if(module.list=='foreign'){
            $scope.readyModules.foreign[module.status].push(module);
        }else{
            if($scope.readyModules.current[module.status]){
                $scope.readyModules.current[module.status].push(module);
            }else{
                switch (module.status) {
                    case "Готовий":
                        $scope.readyModules.current['ready_module'].push(module);
                        break;
                    case "В розробці":
                        $scope.readyModules.current['develop_module'].push(module);
                        break;
                }
            }
        }
    };
    //reorder block
    $scope.upModuleInCourse = function(index) {
        if(index>0){
            var prevModule=$scope.moduleInCourse[index-1];
            $scope.moduleInCourse[index-1]=$scope.moduleInCourse[index];
            $scope.moduleInCourse[index]=prevModule;
        }
    };
    $scope.downModuleInCourse = function(index) {
        if(index<$scope.moduleInCourse.length-1){
            var nextModule=$scope.moduleInCourse[index+1];
            $scope.moduleInCourse[index+1]=$scope.moduleInCourse[index];
            $scope.moduleInCourse[index]=nextModule;
        }
    };

    $scope.editCourseRevision = function (modulesList) {
        if($scope.enabled!=false){
            $scope.enabled=false;
            var object = {};
            modulesList.forEach(function (item, index) {
                object[item.id] = {
                    id_module: item.id,
                    module_order: index + 1
                };
            });
            $http({
                url: basePath + '/courseRevision/editCourseRevision',
                method: "POST",
                data: $.param({courseModules: JSON.stringify(object), id_course_revision: idRevision}),
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
    $scope.previewCourseRevision = function(url) {
        location.href=url;
    };
    //edit revision
    $scope.editCourseRevisionPage = function(url) {
        location.href=url;
    };
    //approve revision
    $scope.approveCourseRevision = function(id) {
        courseRevisionsActions.approveCourseRevision(id).then(function(){
            getCourseData.getData(idRevision).then(function(response) {
                $rootScope.courseData = response;
            });
        });
    };
    //send revision for approve
    $scope.sendCourseRevision = function(id, redirect) {
        courseRevisionsActions.sendCourseRevision(id).then(function(senResponse){
            // bootbox.alert(senResponse, function () {
                getCourseData.getData(idRevision).then(function (response) {
                    $rootScope.courseData = response;
                    if (redirect) {
                        location.href = basePath + '/courseRevision/previewCourseRevision?idRevision=' + idRevision;
                    }
                });
            // });
        });
    };
    //canceled edit revision by the editor
    $scope.cancelCourseEditByEditor = function(id, redirect) {
        courseRevisionsActions.cancelCourseEditByEditor(id).then(function(){
            getCourseData.getData(idRevision).then(function(response) {
                $rootScope.courseData = response;
                if(redirect){
                    location.href=basePath+'/courseRevision/previewCourseRevision?idRevision='+idRevision;
                }
            });
        });
    };

    $scope.cancelSendCourseRevision = function(id) {
        courseRevisionsActions.cancelSendCourseRevision(id).then(function(){
            getCourseData.getData(idRevision).then(function(response) {
                $rootScope.courseData = response;
            });
        });
    };

    $scope.cancelCourseRevision = function(id) {
        courseRevisionsActions.cancelCourseRevision(id).then(function(){
            getCourseData.getData(idRevision).then(function(response) {
                $rootScope.courseData = response;
            });
        });
    };

    $scope.rejectCourseRevision = function(id) {
        // bootbox.dialog({
        //     title: "Ти впевнений, що хочеш відхилити ревізію?",
        //         message: '<div class="panel-body"><div class="row"><form role="form" name="rejectMessage"><div class="form-group col-md-12">'+
        //         '<textarea class="form-control" style="resize: none" rows="6" id="rejectMessageText" placeholder="тут можна залишити коментар при відхилені ревізії"></textarea>'+
        //         '</div></form></div></div>',
        //         buttons: {success: {label: "Підтвердити", className: "btn btn-primary",
        //             callback: function () {
        //                 var comment = $('#rejectMessageText').val();
                        courseRevisionsActions.rejectCourseRevision(id).then(function(){
                            getCourseData.getData(idRevision).then(function(response) {
                                $rootScope.courseData = response;
                            });
                        });
                    // }
                // },
                //     cancel: {label: "Скасувати", className: "btn btn-default",
                //         callback: function () {
                //         }
                //     }
                // }
            // }
        // );
    };

    $scope.releaseCourseRevision = function(id) {
        if($scope.enabled!=false) {
            $scope.enabled = false;
            courseRevisionsActions.releaseCourseRevision(id).then(function () {
                $scope.enabled=true;
                getCourseData.getData(idRevision).then(function (response) {
                    $rootScope.courseData = response;
                });
            });
        }
    };

    $scope.restoreCourseEditByEditor = function(id) {
        courseRevisionsActions.restoreCourseEditByEditor(id).then(function(){
            getCourseData.getData(idRevision).then(function(response) {
                $rootScope.courseData = response;
            });
        });
    };

    $scope.checkCourseRevision = function() {
        $http({
            url: basePath+'/courseRevision/checkCourseRevision',
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

    $scope.sendCourseRevisionMessage = function(idRevision) {
        courseRevisionMessage.sendMessage(idRevision);
    };

    $scope.enableEdit=function () {
        $scope.editVisible=true;
    };
    $scope.showForm=function () {
        document.getElementById('moduleForm').style.display = 'block';
    };
    $scope.hideForm=function (id, title1, title2, title3) {
        $form = document.getElementById(id);
        $form.style.display = 'none';
        document.getElementById(title1).innerHTML = '';
        document.getElementById(title2).innerHTML = '';
        document.getElementById(title3).innerHTML = '';
    };

    $scope.selection = {
        ids: {"0": true}
    };
    $scope.setCategories = function() {
        getCourseData.getModules($scope.selection.ids).then(function(response){
            $scope.readyModules=response;
            if($scope.readyModules.current){
                $.each($scope.readyModules.current, function(status) {
                    $.each($scope.readyModules.current[status], function(index) {
                        $.each($scope.moduleInCourse, function(indexInCourse) {
                            if($scope.moduleInCourse[indexInCourse]['id']==$scope.readyModules.current[status][index]['id']){
                                $scope.tempId.push($scope.moduleInCourse[indexInCourse]['id']);
                                return false;
                            }
                        });
                    });
                    $scope.readyModules.current[status] = $scope.readyModules.current[status].filter(function(value) {
                        return !find($scope.tempId,value.id)
                    });
                });
            }
        });
    };
};

function moduleCreateCtrl($scope, $http) {
    $scope.languages = [
        {name: 'українською', value: 'ua'},
        {name: 'російською', value: 'ru'},
        {name: 'англійською', value: 'en'}
    ];
    
    //manipulations with module tags
    $scope.tagsList = function() {
        $http({
            url: basePath+'/module/getTagsList',
            method: "POST",
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            $scope.allTags=response.data;
            $scope.allTags.push({id: 0, tag: 'Усі категорії'});
            $scope.tags=response.data;
        }, function errorCallback() {
            bootbox.alert('Виникла помилка при завантажені хмарини тегів');
            return false;
        });
    };
    $scope.tagsList();

    $scope.addTag = function(tag,index) {
        $scope.moduleTags.push({id: tag.id, tag: tag.tag});
        $scope.tags.splice(index, 1);
    };
    $scope.removeTag = function(tag,index) {
        $scope.tags.push({id: tag.id, tag: tag.tag});
        $scope.moduleTags.splice(index, 1);
    };
    //manipulations with module tags
    //create module
    $scope.createModule = function() {
        $http({
            url: basePath+'/module/create',
            method: "POST",
            data: $.param({
                titleUA:$scope.titleUa,
                titleRU:$scope.titleRu,
                titleEN:$scope.titleEn,
                language:$scope.language.value,
                isAuthor:$scope.isAuthor,
                moduleTags:$scope.moduleTags
            }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        }).then(function successCallback(response) {
            if(response.data!='')
                bootbox.alert(response.data, function (){
                    location.reload();
                });
            else{
                location.reload();
            }
        }, function errorCallback() {
            
            bootbox.alert('Виникла помилка при створені модуля. Зв\'яжіться з адміністрацією.');
            return false;
        });
    };
    //create module
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
