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

            var html= item.name + "<span class=\"close select-search-list-item_selection-remove\">×</span>";

            return $sce.trustAsHtml(html);
        };
    })
;

function newsletterCtrl($rootScope,$scope, $http, $resource, $state, $filter) {

    $scope.taskTypes = [{
        name: 'Негайно',
        value: '0'
    }, {
        name: 'Відкласти',
        value: '1'
    }];

    $rootScope.$on('mailTemplateSelected', function (event, data) {
        $scope.subject = data.subject;
        $scope.message = data.text;
    });

    $scope.editorOptions = {
        language: 'uk-ua',
    };


    function init() {
        $scope.selectedRecipients = null;
        $scope.newsletterType = null;
        $scope.subject = null;
        $scope.message = null;
        $scope.taskType = $scope.taskTypes[0].value;
        $scope.hours = 1;
        $scope.minutes = 1;
        $scope.date = new Date();
        $scope.time = new Date();
        $scope.format = 'dd-MM-yyyy';
        $scope.dateOptions = {
            minDate: new Date(),
            showWeeks: true
        };
    };
    init();

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
        if ($scope.newsletterForm.$valid && $scope.newsletterForm.$dirty && $scope.newsletterType) {
            var recipients = [];
            angular.forEach($scope.selectedRecipients, function (value) {
                switch ($scope.newsletterType) {
                    case 'roles':
                        recipients.push(value.id);
                        break;
                    case 'users':
                        recipients.push(value.email);
                        break;
                }
            });
            $http({
                method: 'POST',
                url: basePath + '/_teacher/newsletter/sendLetter',
                data: $jq.param({
                    "type": $scope.newsletterType,
                    "recipients": recipients,
                    "subject": $scope.subject,
                    "message": $scope.message,
                    "date": $filter('shortDate')($scope.date,'dd-MM-yyyy')+' '+$filter('shortDate')($scope.time,'HH:mm')
                }),
                headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
            }).success(function () {
                bootbox.alert('Задача запланована',function () {
                   $state.go('scheduler/tasks');
                });
            }).error(function () {
                bootbox.alert('Вибачте, виникла помилка');
            });
        }
        else
            bootbox.alert('Невірні дані')
    }

    $scope.clearForm = function () {
        init();
    };

    $scope.cancel = function () {
        init();
        $state.go('index');
    };

    $scope.open1 = function() {
        $scope.open = !$scope.open;
    };
}