/**
 * Created by adm on 13.11.2016.
 */
angular
    .module('teacherApp')
    .controller('newsletterCtrl',newsletterCtrl).filter('usersFilter', function($sce) {
    return function(usersArray, query, item, options, element) {

        var html = item.name + " &lt;" + item.email+"&gt;";

        return $sce.trustAsHtml(html);
    };
})
    .filter('usersSearchFilter', function($sce) {
        return function(label, query, item, options, element) {

            var html = item.name +"<span class=\"close select-search-list-item_selection-remove\">×</span>";

            return $sce.trustAsHtml(html);
        };
    })
;

function newsletterCtrl($scope, $http, $resource) {

    var rolesArray = $resource(basePath+'/_teacher/newsletter/getRoles');
    var usersArray = $resource(basePath+'/_teacher/newsletter/getUserEmail');
    $scope.getRoles = function(query, querySelectAs) {
        console.log(query);
      return rolesArray.query().$promise.then(function(response) {
            return response;
        });
    };

    $scope.getUsers = function(query, querySelectAs) {

        return usersArray.query({query:query}).$promise.then(function(response) {
            return response;
        });
    };

    $scope.send = function () {
        var recipients = [];
        angular.forEach($scope.selectedRecipients, function(value) {
            switch ($scope.newsletterType){
                case 'roles':
                    recipients.push(value.id);
                    break;
                case 'users':
                    recipients.push(value.email);
                    break;
            }
        });
         $http({
             method:'POST',
             url:basePath+'/_teacher/newsletter/sendLetter',
             data: $jq.param({"type":$scope.newsletterType, "recipients":recipients,"subject":$scope.subject,"message":$scope.message}),
             headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        });
    }

}