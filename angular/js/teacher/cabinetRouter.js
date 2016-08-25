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
                    templateUrl: basePath+"/_teacher/messages/index"
                })
                .state('index', {
                    url: "/index",
                    cache         : false,
                    templateUrl: basePath+"/_teacher/cabinet/loadDashboard/?user="+user,
                })
                .state('newmessages/receiver/:id', {
                    url: "/newmessages/receiver/:id",
                    cache         : false,
                    templateUrl: function ($stateParams) {
                        return basePath + "/_teacher/messages/write/?id=" + user + "&receiver=" +$stateParams.id
                    }
                })
    }
    );

