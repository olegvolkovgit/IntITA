/**
 * Created by adm on 19.07.2016.
 */
angular
    .module('teacherApp')
    .controller('trainerStudentsCtrl', trainerStudentsCtrl)
    .controller('trainersStudentViewCtrl', trainersStudentViewCtrl)

function trainerStudentsCtrl($scope, trainerService, NgTableParams){
    $scope.changePageHeader('Закріплені студенти');
    $scope.trainersStudentsTableParams = new NgTableParams({}, {
        getData: function (params) {
            return trainerService
                .trainersStudentsList(params.url())
                .$promise
                .then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
        }
    });   
}

function trainersStudentViewCtrl($scope, trainerService, NgTableParams){
    $scope.trainersStudentsTableParams = new NgTableParams({}, {
        getData: function (params) {
            return trainerService
                .trainersStudentsList(params.url())
                .$promise
                .then(function (data) {
                    params.total(data.count);
                    return data.rows;
                });
        }
    });
}