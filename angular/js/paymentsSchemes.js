'use strict';

/* App Module */
angular
    .module('paymentsSchemes.directives', [])
    .directive('paymentsScheme', ['paymentsService', paymentsScheme])
    .factory('paymentsService', ['$resource',
        function ($resource) {
            var url = basePath+'/course';
            return $resource(
                url,
                {},
                {
                    scheme: {
                        url : url + '/getPaymentSchemas',
                    }
                });
        }]);

    function paymentsScheme(schemes) {
        function link($scope, element, attrs) {
            $scope.setSchema = function (event, educForm, type) {
                $scope.otherSchemes['selectedForm']='';
                $scope.otherSchemes['selectedSchemeType']='';
                
                $scope.schemes['selectedForm']=educForm;
                $scope.schemes['selectedSchemeType']=type;
                
                //todo
                // var changeEl=educForm=='Online'?'numbersFirstOnline':'numbersFirstOffline';
                // var schemaHtml=$(event.currentTarget).next().find('.numbers').html();
                // if($(event.currentTarget).next().find('.numbers').next().is('.discount'))
                //     schemaHtml=schemaHtml+$(event.currentTarget).next().find('.numbers').next('.discount').html();
                // $('#'+changeEl).html(schemaHtml);
            };
        }
        return {
            scope: {
                'schemes': '=schemes',
                'otherSchemes': '=otherSchemes'
            },
            link: link,
            templateUrl: basePath + '/angular/js/templates/paymentsSchemes.html'
        };
    }