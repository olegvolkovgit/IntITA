/**
 * Created by adm on 15.07.2016.
 */
var user = "";

angular
    .module('cabinetRouter',['ui.router'])
    .config(function ($stateProvider) {
            $stateProvider
                .state('messages', {
                    url: "/messages",
                    cache         : false,
                    controller: function($scope){
                        $scope.changePageHeader('Повідомлення');
                    },
                    templateUrl: basePath+"/_teacher/messages/index"
                })
                .state('index', {
                    url: "/index",
                    cache         : false,
                    controller: function($scope){
                        $scope.changePageHeader('Особистий кабінет');
                    },
                    templateUrl: basePath+"/_teacher/cabinet/loadDashboard/?user="+user
                })
                .state('newmessages/receiver/:id', {
                    url: "/newmessages/receiver/:id",
                    cache         : false,
                    templateUrl: function ($stateParams) {
                        return basePath + "/_teacher/messages/write/?id=" + user + "&receiver=" +$stateParams.id
                    }
                })
                .state(':scenario/:id/:form/scheme/:schemeId', {
                    url: "/:scenario/:id/:form/scheme/:schemeId",
                    cache         : false,
                    templateUrl: function ($stateParams) {
                        return basePath + "/_teacher/_student/student/"+$stateParams.scenario+"/?id="+$stateParams.id+"&form="+$stateParams.form+"&schemeId="+$stateParams.schemeId
                    }
                })
                .state('publicOffer/course/:course/module/:module/scenario/:scenario/:form/scheme/:schemeId', {
                    url: "/publicOffer/course/:course/module/:module/scenario/:scenario/:form/scheme/:schemeId",
                    cache         : false,
                    templateUrl: function ($stateParams) {
                        return basePath + "/_teacher/_student/student/publicOffer?course=" + $stateParams.course + "&module=" + $stateParams.module +
                            "&type=" + $stateParams.scenario + "&form=" + $stateParams.form + "&schema=" + $stateParams.schemeId;
                    }
                })
    }
    );

