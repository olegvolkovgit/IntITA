/**
 * Created by adm on 13.11.2016.
 */
angular
    .module('teacherApp')
    .controller('mailTemplatesCtrl',mailTemplatesCtrl);

function mailTemplatesCtrl($scope, $http, $resource, $state, NgTableParams) {
   var table = $resource(basePath + '/_teacher/mailTemplates/getMailTemplates');
    $scope.mailTemplatesTable = new NgTableParams({
        page: 1,
        count: 10,
    }, {
        getData: function(params) {
            return table.get(params.url()).$promise.then(function(data) {
                params.total(data.count);
                return data.rows;
            });
        }
    });
   
}