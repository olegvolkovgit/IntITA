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

            var html= item.email + "<span class=\"close select-search-list-item_selection-remove\">×</span>";

            return $sce.trustAsHtml(html);
        };
    })
    .filter('subgroupsSearchFilter', function($sce) {
        return function(label, query, item, options, element) {


            var html= "&lt;" + item.groupName+"&gt;"+item.name + "<span class=\"close select-search-list-item_selection-remove\">×</span>";

            return $sce.trustAsHtml(html);
        };
    })
    .filter('subgroupsFilter', function($sce) {
        return function(label, query, item, options, element) {

            var html= "&lt;" + item.groupName+"&gt;"+item.name;

            return $sce.trustAsHtml(html);
        };
    })
;

function newsletterCtrl($rootScope,$scope, $http, $resource, $state, $filter, $stateParams) {

    $scope.taskTypes = [{
        name: 'Негайно',
        value: '0'
    }, {
        name: 'Відкласти',
        value: '1'
    }];

    $scope.taskRepeatTypes = [{
        name: 'Один раз',
        value: '1'
    }, {
        name: 'Раз на день',
        value: '2'
    }, {
        name: 'Раз на тиждень',
        value: '3'
    }, {
        name: 'Раз на місяць',
        value: '4'
    }, {
        name: 'Раз на рік',
        value: '5'
    }];

    $rootScope.$on('mailTemplateSelected', function (event, data) {
        $scope.subject = data.subject;
        $scope.message = data.text;
    });

    $scope.editorOptions = {
        language: 'uk-ua',
    };

    $scope.date = new Date();
    $scope.time = new Date();
    $scope.format = 'dd-MM-yyyy';
    $scope.dateOptions = {
        minDate: $scope.date,
        showWeeks: true
    };

    function init() {
        $scope.selectedRecipients = null;
        $scope.newsletterType = null;
        $scope.subject = null;
        $scope.message = null;
        $scope.taskType = $scope.taskTypes[0].value;
        $scope.taskRepeat = $scope.taskRepeatTypes[0].value;
        $scope.hours = 1;
        $scope.minutes = 1;
    }
   init();

    var rolesArray = $resource(basePath+'/_teacher/newsletter/getRoles');
    var groupsArray =$resource(basePath+'/_teacher/newsletter/getGroups');
    var subGroupsArray =$resource(basePath+'/_teacher/newsletter/getSubGroups');
    var usersArray = $resource(basePath+'/_teacher/newsletter/getUserEmail');
    $scope.getRoles = function(query, querySelectAs) {
      return rolesArray.query().$promise.then(function(response) {
            return response;
        });
    };

    $scope.getUsers = function(query, querySelectAs) {

        return usersArray.query({query:query}).$promise.then(function(response) {
            return response;
        });
    };

    $scope.getGroups = function(query, querySelectAs) {

        return groupsArray.query({query:query}).$promise.then(function(response) {

            return response;
        });
    };
    $scope.getSubGroups = function(query, querySelectAs) {

        return subGroupsArray.query({query:query}).$promise.then(function(response) {

            return response;
        });
    };

    $scope.send = function () {
        if ($scope.newsletterForm.$valid && $scope.newsletterType) {
            var recipients = [];
            angular.forEach($scope.selectedRecipients, function (value) {
                switch ($scope.newsletterType) {
                    case 'roles':
                        recipients.push(value.id);
                        break;
                    case 'users':
                        recipients.push(value.email);
                        break;
                    case 'groups':
                        recipients.push(value.id);
                        break;
                    case 'subGroups':
                        recipients.push(value.id);
                        break;
                }
            });
            $http({
                method: 'POST',
                url: basePath + '/_teacher/newsletter/sendLetter',
                data: $jq.param({
                    'parameters':{
                        "type": $scope.newsletterType,
                        "recipients": recipients,
                        "subject": $scope.subject,
                        "message": $scope.message,
                    },
                    "taskType": $scope.taskType,
                    "taskRepeat": $scope.taskRepeat,
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

    function loadModel(id) {
        $http.get(basePath+'/_teacher/schedulerTasks/getModel?id='+id).
        then(function (response) {
            $scope.model = response.data;
            parameters = JSON.parse($scope.model.parameters);
            var recipients  = parameters.recipients;
            $scope.newsletterType = parameters.type;
            switch ($scope.newsletterType){
                case 'users':
                    $scope.selectedRecipients = [];
                    for (var item in recipients){
                        $scope.selectedRecipients.push({email:recipients[item]});
                    }
                    break;
                case 'groups':
                    $http({
                        method: 'POST',
                        url: basePath + '/_teacher/newsletter/getGroupsById',
                        data: $jq.param({groups:recipients}),
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                    }).success(function (response) {
                        $scope.selectedRecipients = response;
                    })
                    break;
                case 'subGroups':
                    $http({
                        method: 'POST',
                        url: basePath + '/_teacher/newsletter/getSubGroupsById',
                        data: $jq.param({subGroups:recipients}),
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                    }).success(function (response) {
                        $scope.selectedRecipients = response;
                    })
                    break;
                case 'roles':
                    $http({
                        method: 'POST',
                        url: basePath + '/_teacher/newsletter/getRolesById',
                        data: $jq.param({roles:recipients}),
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                    }).success(function (response) {
                        $scope.selectedRecipients = response;
                    });
                    break;
            }

            $scope.subject = parameters.subject;
            $scope.message = parameters.message;
        });
    }

    if ($state.is('scheduler/task/:id') || $state.is('scheduler/task/edit/:id')){
        loadModel($stateParams.id);
    };

    $scope.editNewsletter = function(modelId){
        $state.go('scheduler/task/edit/:id',{id:modelId});

        //loadModel(modelId);
    }


}