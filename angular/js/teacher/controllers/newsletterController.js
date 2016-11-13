/**
 * Created by adm on 13.11.2016.
 */
angular
    .module('teacherApp')
    .controller('newsletterCtrl',newsletterCtrl);

function newsletterCtrl($scope, $http) {

     $http.get(basePath+'/_teacher/newsletter/getRoles').then(function (response) {
         $scope.roles = response.data;
     });

}