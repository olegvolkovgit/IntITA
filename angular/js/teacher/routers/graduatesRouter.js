/**
 * Created by adm on 10.08.2016.
 */
angular
    .module('graduatesRouter',['ui.router']).
config(function ($stateProvider) {
    $stateProvider
        .state('graduate', {
            url: "/graduate",
            cache: false,
            templateUrl: "/_teacher/_admin/graduate/index",
        })
});
