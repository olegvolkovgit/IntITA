/**
 * Created by adm on 08.08.2016.
 */
angular
    .module('teacherApp')
    .controller('coursemanageCtrl',coursemanageCtrl);

function coursemanageCtrl ($http, $scope, DTOptionsBuilder, $window, $stateParams, $document){
    $scope.formData = {};
    $scope.courseId= null;
    $scope.coursesList =null;
    /* Init course table  */

    $http.get('/_teacher/_admin/coursemanage/getCoursesList').then(function (data) {
        $scope.coursesList = data.data["data"];
    });
    $scope.dtOptions = DTOptionsBuilder.newOptions()
        .withPaginationType('simple_numbers')
        .withLanguageSource('//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Ukranian.json');
    /* Save course schema  */
    $scope.saveSchema = function(idCourse){
        var url = '/_teacher/_admin/coursemanage/saveschema?idCourse='+idCourse;
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
            showDialog("Схему курса не вдалося зберегти.");
        });

        $scope.changeView('course/edit/'+idCourse);
    };
    /* Change course status  */
    $scope.changeCourse = function(courseId) {
        var url = '/_teacher/_admin/coursemanage/changeStatus/id/' + courseId + '/';
        bootbox.confirm("Видалити курс?", function (result) {
            if (result) {
                $http.post(url).success(function (data) {
                    bootbox.confirm("Операцію успішно виконано.", function () {
                    })
                }).error(function (data) {
                    showDialog("Операцію не вдалося виконати.");
                });
                $location.path(url).replace();
                $scope.changeView('admin/coursemanage');
            }
            else {
                showDialog("Операцію відмінено.");
            }
        });
    };
    /* Get modules List   */
    $scope.getCourses = function(value) {
        return $http.get('/_teacher/_admin/coursemanage/coursesByQueryAndLang', {
            params: {
                query: value,
                lang: $stateParams.lang
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

    $scope.addLinkedCourse = function(modelId, courseId, language, linkedCourseId) {

        $http({
            method: "POST",
            url:  "/_teacher/_admin/coursemanage/changeLinkedCourses/",
            data: $jq.param({"course":courseId, "lang":language, "linkedCourse":linkedCourseId, "modelId":modelId }),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
            cache: false
        })
            .success(function(data){
                bootbox.alert(data, function () {

                })
                $window.history.back();
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
                    url:  "/_teacher/_admin/coursemanage/deleteLinkedCourse/",
                    data: $jq.param({"id":courseId, "lang":language}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                    cache: false
                })
                    .success(function(data){
                        bootbox.alert(data, function () {

                        })
                        $window.location = '/';
                    }).error(function (){
                    bootbox.alert("Операцію не вдалося виконати.", function () {
                    })
                })
            }
            else
                showDialog("Операцію відмінено.")
        })
    };


}
