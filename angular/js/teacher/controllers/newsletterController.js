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

            var html= "&lt;" + item.name+"&gt;"+item.email + "<span class=\"close select-search-list-item_selection-remove\">×</span>";

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
    .filter('coursesModulesFilter', function($sce) {
        return function(label, query, item, options, element) {

            var html= item.name;

            return $sce.trustAsHtml(html);
        };
    })
    .filter('coursesModulesSearchFilter', function($sce) {
        return function(label, query, item, options, element) {

            var html= item.name;

            return $sce.trustAsHtml(html) + "<span class=\"close select-search-list-item_selection-remove\">×</span>";
        };
    })
;

function newsletterCtrl($rootScope,$scope, $http, $resource, $state, $filter, $stateParams) {
    $scope.loadEmailCategory=function(){
        $resource(basePath+'/_teacher/newsletter/getEmailsCategoryList').query()
            .$promise
            .then(function (data) {
                $scope.emailsCategory=data;
                $scope.emailsCategory.push({id:0,title:'Вся база email'})
            });
    };
    $scope.loadEmailCategory();
    
    $scope.taskTypes = [

            {
                name: 'Негайно',
                value: '0'
            }, {
                name: 'Відкласти',
                value: '1'
            }];

    $scope.taskRepeatTypes =
        [{
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
    },
    {
        name: 'По днях тижня',
        value: '6'
    }
    ];

    $scope.weekdays = [
        {
            name: 'Понеділок',
            id: 1
        },
        {
            name: 'Вівторок',
            id: 2
        },
        {
            name: 'Середа',
            id: 3
        },
        {
            name: 'Четвер',
            id: 4
        },
        {
            name: 'П\'ятниця',
            id: 5
        },
        {
            name: 'Субота',
            id: 6
        },
        {
            name: 'Неділя',
            id: 7
        }
    ];

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
    $scope.emailSelected = [];
    function init() {
        $scope.selectedRecipients = null;
        $scope.newsletterType = null;
        $scope.subject = null;
        $scope.message = null;
        $scope.taskType = $scope.taskTypes[0].value;
        $scope.taskRepeat = $scope.taskRepeatTypes[0].value;
        $scope.hours = 1;
        $scope.minutes = 1;
        $scope.weekdaysList = [];

    }
    
    function getUserMailboxes() {
        $resource(basePath+'/_teacher/newsletter/getEmails').query().$promise.then(function (response) {
            if (!$state.is('scheduler/task/edit/:id'))
            {
                $scope.emailSelected.email = response[0].email;
            }
            return $scope.userEmails = response;
        });
    }



    var rolesArray = $resource(basePath+'/_teacher/newsletter/getRoles');
    var groupsArray =$resource(basePath+'/_teacher/newsletter/getGroups');
    var subGroupsArray =$resource(basePath+'/_teacher/newsletter/getSubGroups');
    var usersArray = $resource(basePath+'/_teacher/newsletter/getUserEmail');
    var modulesArray = $resource(basePath+'/_teacher/newsletter/getAllModules');
    var coursesArray = $resource(basePath+'/_teacher/newsletter/getAllCourses');
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

    $scope.getModules = function(query, querySelectAs) {

        return modulesArray.query({query:query}).$promise.then(function(response) {

            return response;
        });
    };

    $scope.getCourses = function(query, querySelectAs) {

        return coursesArray.query({query:query}).$promise.then(function(response) {

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
                    case 'emailsFromDatabase':
                        recipients = value;
                        break;
                    case 'modules':
                        recipients.push(value.id);
                        break;
                    case 'courses':
                        recipients.push(value.id);
                        break;
                }
            });

            if($scope.newsletterType=='emailsFromDatabase' && $scope.selectedRecipients == null || $scope.selectedRecipients == 'undefined'){
                bootbox.alert('Виберіть категорію, якщо робите розсилку по базі email');
                return false;
            };

            $http({
                method: 'POST',
                url: basePath + '/_teacher/newsletter/sendLetter',
                data: $jq.param({
                    'newsletter':
                     {
                        "type": $scope.newsletterType,
                        "recipients": recipients,
                        "subject": $scope.subject,
                        "text": $scope.message,
                        "newsletter_email": $scope.emailSelected.email,
                     },
                    "repeat_type": $scope.taskRepeat,
                    "parameters": $scope.weekdaysList,
                    "date": $filter('shortDate')($scope.date, 'dd-MM-yyyy') + ' ' + $filter('shortDate')($scope.time, 'HH:mm')
                }),
                headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
            }).success(function (response) {
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
            console.log($scope.model);
            $scope.selectedRecipients = $scope.model.newsletter.recipients;
            $scope.newsletterType =  $scope.model.newsletter.type;
            $scope.emailSelected.email = $scope.model.newsletter.newsletter_email;
            $scope.subject = $scope.model.newsletter.subject;
            $scope.message = $scope.model.newsletter.text;
            $scope.taskType = $scope.taskTypes[1].value;
            $scope.taskRepeat = $scope.model.repeat_type;
            $scope.weekdaysList = $scope.model.parameters;
        });

    }

    if ($state.is('scheduler/task/:id') || $state.is('scheduler/task/edit/:id')){
        if ($state.is('scheduler/task/edit/:id'))
        {
            getUserMailboxes();
        }
        loadModel($stateParams.id);
    }
    else {
        getUserMailboxes();
        init();
    };

    $scope.editNewsletter = function(modelId){
        $state.go('scheduler/task/edit/:id',{id:modelId});
    }
}