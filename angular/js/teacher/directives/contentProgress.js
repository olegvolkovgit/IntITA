'use strict';

/* App Module */
angular
    .module('contentProgressApp',[])
    .directive('contentProgress', ['NgTableDataService', '$state', '$stateParams', 'studentProgressService', 'teacherConsultantService',
        function (NgTableDataService, $state, $stateParams, studentProgressService, teacherConsultantService) {
            function link($scope, element, attrs) {
                $scope.stateParams=$stateParams;
                $scope.progress={
                    lectureRatings:[],
                    moduleRating:[],
                    currentPage:'',
                    servicesCategory:[{id:1, title:'Курси'}, {id:2, title:'Модулі'}],
                    filter:{search:null,group:null,service:1,owner:$scope.owner},
                    pageChanged: function () {
                        NgTableDataService.getData(
                            {
                                'student': $stateParams.studentId,
                                'course': $stateParams.courseId,
                                'module': $stateParams.module,
                                'lecture': $stateParams.lecture,
                                'page': $scope.progress.currentPage,
                                'filter':$scope.progress.filter,
                            }).then(function (data) {
                            $scope.data = data.data;
                            $scope.totalItems = data.count;
                            $scope.progress.lectureRatings=[];
                            $scope.progress.moduleRating=[];
                        })
                    },
                    allpyFilter: function (keyEvent) {
                        if (!keyEvent || keyEvent.which === 13){
                            $scope.progress.pageChanged();
                        }
                    },
                    getGroupList: function () {
                        teacherConsultantService
                            .studentsCategoryList()
                            .$promise
                            .then(function (data) {
                                var groupList=data.map(function (item) {
                                    return {id: item.id, title: item.name}
                                });
                                $scope.progress.studentsCategory=[{id:'0', title:'Усі студенти'}].concat(groupList);
                            });
                    },
                    getAllLecturesRating: function (student, module, index) {
                        var promise = studentProgressService.getLecturesRatings({student: student,module:module, index:index}).$promise.then(
                            function successCallback(response) {
                                if(typeof index=='undefined'){
                                    $scope.progress.lectureRatings = response;
                                }else{
                                    $scope.progress.lectureRatings = response.map(function(new_value, index) {
                                        return new_value || $scope.progress.lectureRatings[index];
                                    });
                                }
                                return response;
                            }, function errorCallback() {
                                bootbox.alert("Отримати рейтинг лекцій не вдалося");
                            });
                        return promise;
                    },
                    getIntermediateModuleRating: function (student, module, index) {
                        $scope.progress.getAllLecturesRating(student, module).then(function (data) {
                            var positiveArr = data.filter(function(number) {
                                return number > 0;
                            });
                            var len = positiveArr.length;
                            var sum = 0;
                            for (var i = 0; i < len; i++) {
                                sum += +positiveArr[i];
                            }
                            $scope.progress.moduleRating[index]=sum/len;
                        });
                    }
                };

                NgTableDataService.setUrl($scope.dataUrl);
                $scope.data = "";
                $scope.totalItems = 0;
                $scope.progress.pageChanged();
                if(document.getElementById("groupSelect"))
                    $scope.progress.getGroupList();

                $scope.getContentUrl = function() {
                    return $scope.template;
                }
            }
            return {
                scope: {
                    'template':'=template',
                    'dataUrl':'=dataUrl',
                    'progress':'=progress',
                    'owner':'=owner',
                    'stateParams':'=stateParams'
                },
                link: link,
                template: '<div ng-include="getContentUrl()"></div>'
            };
        }]);