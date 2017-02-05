/**
 * Created by adm on 08.08.2016.
 */
angular
    .module('teacherApp')
    .controller('coursesTableCtrl',coursesTableCtrl)
    .controller('coursemanageCtrl',coursemanageCtrl)
    .controller('mandatoryModulesCtrl',mandatoryModulesCtrl);

function coursesTableCtrl ($scope, NgTableParams, $resource){
    /* Sorting params  */
    $scope.statuses = [{id:'0', title:'в розробці'},{id:'1', title:'готовий'}];
    $scope.cancelled = [{id:'0', title:'доступний'},{id:'1', title:'видалений'}];
    $scope.languages = [{id:'ua', title:'ua'},{id:'ru', title:'ru'},{id:'en', title:'en'}];
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

    /* Init course table  */
    var dataFromServer = $resource(basePath+'/_teacher/_admin/coursemanage/getCoursesList');
    $scope.courseTable = new NgTableParams({
        sorting:{'course_ID':"asc"}
    }, {
        getData: function(params) {
            return dataFromServer.get(params.url()).$promise.then(function(data) {
                params.total(data.count);
                return data.rows;
            });
        }
    });
}
function coursemanageCtrl ($http, $scope, $stateParams, $state ,$templateCache){
    $scope.formData = {};
    $scope.courseId= null;
    $scope.coursesList =null;

    $scope.saveSchema = function(idCourse){
        var url = basePath+'/_teacher/_admin/coursemanage/saveschema?idCourse='+idCourse;
        $http({
            method: "POST",
            url:  url,
            data: {"idCourse":idCourse},
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
            cache: false
        }).success(function(data) {
            bootbox.confirm("Схема курсу збережена.", function () {
            })
        }).error(function(data){
            showDialog("Схему курсу не вдалося зберегти.");
        });

        $scope.changeView('course/edit/'+idCourse);
    };
    /* Change course status  */
    $scope.changeCourse = function(courseId) {
        var url = basePath+'/_teacher/_admin/coursemanage/changeStatus/id/' + courseId + '/';
        bootbox.confirm("Змінити статус курсу?", function (result) {
            if (result) {
                $http.post(url).success(function (data) {
                    bootbox.alert("Операцію успішно виконано.", function () {
                        $templateCache.remove(basePath+"/_teacher/_admin/coursemanage/update/id/"+courseId);
                        $state.go('course/edit/:id',{'id':courseId},{reload: true});
                    })
                }).error(function (data) {
                    showDialog("Операцію не вдалося виконати.");
                });
            }
            else {
                showDialog("Операцію відмінено.");
            }
        });
    };
    /* Get modules List   */
    $scope.getCoursesByLang = function(value, currentCourseLang) {
        return $http.get(basePath+'/_teacher/_admin/coursemanage/coursesByQueryAndLang', {
            params: {
                query: value,
                lang: $stateParams.lang,
                currentCourseLang: currentCourseLang
            }
        }).then(function(response){
            if (response.data.results)
                return response.data.results.map(function(item){
                    console.log(item);
                    return item;
                });
        });
    };

    $scope.onSelect = function ($item) {
        $scope.courseId = $item.id;
    };

    $scope.editCourse = function(courseId){
      $state.go('course/edit/:id',{'id':courseId},{reload: true});
        $templateCache.remove(basePath+"/_teacher/_admin/coursemanage/view?id="+courseId);
    };

    $scope.addLinkedCourse = function(courseId, language, linkedCourseId) {
        $http({
            method: "POST",
            url:  basePath+"/_teacher/_admin/coursemanage/changeLinkedCourses/",
            data: $jq.param({"course":courseId, "lang":language, "linkedCourse":linkedCourseId }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
            cache: false
        })
            .success(function(data){
                bootbox.alert(data, function () {
                    $templateCache.remove(basePath+"/_teacher/_admin/coursemanage/update/id/"+$stateParams.course);
                    $state.go('course/edit/:id', {id:$stateParams.course},{reload:true});
                })
            }).error(function (){
            bootbox.alert("Операцію не вдалося виконати.", function () {
            })
        })
    }

    $scope.deleteMod = function(courseId,language){
        bootbox.confirm("Видалити пов\'язаний курс?", function(result) {
            if (result) {
                $http({
                    method: "POST",
                    url:  basePath+"/_teacher/_admin/coursemanage/deleteLinkedCourse/",
                    data: $jq.param({"id":courseId, "lang":language}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                    cache: false
                })
                    .success(function(data){
                        bootbox.alert(data, function () {
                            $templateCache.remove(basePath+"/_teacher/_admin/coursemanage/update/id/"+$stateParams.id);
                            $state.reload();
                        })
                    }).error(function (){
                    bootbox.alert("Операцію не вдалося виконати.", function () {
                    })
                })
            }
            else bootbox.alert("Операцію відмінено.")
        })
    };
}

function mandatoryModulesCtrl ($scope, $http,$state,$templateCache){
    $scope.addMandatory=function (url) {
        var mandatory = $jq("select[name=mandatory] option:selected").val();
        var courseId = $jq("input[name=course]").val();
        var moduleId = $jq("input[name=module]").val();
        if (mandatory && courseId && moduleId) {
            $http({
                method: "POST",
                url:  url,
                data: $jq.param({'module': moduleId, 'course': courseId, 'mandatory': mandatory}),
                headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                cache: false
            })
                .success(function(data){
                    bootbox.alert(data, function () {
                        $templateCache.remove(basePath+"/_teacher/_admin/coursemanage/update/id/"+courseId);
                        $state.go('course/edit/:id',{'id':courseId},{reload: true});
                    })
                })
                .error(function (){
                bootbox.alert("Операцію не вдалося виконати.")
            })
        }
    }
}
