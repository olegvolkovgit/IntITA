/**
 * Created by Wizlight on 25.04.2016.
 */
angular.module('directive.loading', [])

    .directive('loading',   ['$http' ,function ($http)
    {
        return {
            restrict: 'A',
            link: function (scope, elm, attrs)
            {
                scope.isLoading = function () {
                    return $http.pendingRequests.length > 0;
                };

                scope.$watch(scope.isLoading, function (v)
                {
                    if(v){
                        showAjaxLoader();
                    }else{
                        hideAjaxLoader();
                    }
                });
            }
        };

    }]);