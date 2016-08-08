/**
 * Created by adm on 15.07.2016.
 */
var user = "";

angular
    .module('cabinetRouter',['ui.router']).
config(function ($stateProvider) {
        $stateProvider
            .state('messages', {
                url: "/messages",
                cache         : false,
                templateUrl: "/_teacher/messages/index"
            })
            .state('index', {
                url: "/index",
                cache         : false,
                templateUrl: "/_teacher/cabinet/loadDashboard/?user="+user,
            })
}
);

