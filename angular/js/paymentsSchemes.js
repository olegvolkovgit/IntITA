'use strict';

/* App Module */
angular
    .module('paymentsSchemes.directives', [])
    .directive('paymentsScheme', ['paymentsService', paymentsScheme])
    .directive('paymentsSchemeByTemplate', ['paymentsService', paymentsSchemeByTemplate])
    .factory('paymentsService', ['$resource',
        function ($resource) {
            var url = basePath+'/course';
            return $resource(
                url,
                {},
                {
                    scheme: {
                        url : url + '/getPaymentSchemas',
                    },
                });
        }]);

    function paymentsScheme(paymentsService) {
        function link($scope, element, attrs) {
            $scope.form=attrs.educationForm;
            if($scope.serviceType && $scope.contentId){
                if(attrs.educationForm=='online'){
                    paymentsService
                        .scheme({service:$scope.serviceType, contentId: $scope.contentId,educationFormId:1,templateId:null,user:$scope.user})
                        .$promise
                        .then(function (data) {
                            $scope.schemes=data;
                            if($scope.setForm=='online'){
                                var index = getIndexOf($scope.schemes.schemes, $scope.setScheme, "schemeId");
                                $scope.selectedModelScheme = $scope.schemes.schemes[index];
                            }
                            if(typeof $scope.selectedModelScheme=='undefined') {
                                $scope.selectedModelScheme=$scope.schemes.schemes[0];
                            }
                        });
                } else if(attrs.educationForm=='offline'){
                    paymentsService
                        .scheme({service:$scope.serviceType, contentId: $scope.contentId,educationFormId:2,templateId:null,user:$scope.user})
                        .$promise
                        .then(function (data) {
                            $scope.schemes=data;
                            if($scope.setForm=='offline'){
                                var index = getIndexOf($scope.schemes.schemes, $scope.setScheme, "schemeId");
                                $scope.selectedModelScheme = $scope.schemes.schemes[index];
                            }
                        });
                }
            }

            $scope.setSchema = function (event, model) {
                $scope.selectedModelScheme=model;
            };

            function getIndexOf(arr, val, prop) {
                var l = arr.length, k = 0;
                for (k = 0; k < l; k = k + 1) {
                    if (arr[k][prop] == val && arr[k][prop] == val) {
                        return k;
                    }
                }
                return false;
            }

            $scope.getContentUrl = function() {
                if($scope.user){
                    return basePath + '/angular/js/templates/paymentsSchemesSelect.html';
                }
                if($scope.serviceType=='course')
                    return basePath + '/angular/js/templates/paymentsSchemes.html';
                else return basePath + '/angular/js/templates/modulesPaymentsSchemes.html';
            }
        }
        return {
            scope: {
                'setScheme':'=setScheme',
                'setForm':'=setForm',
                'contentId':'=contentId',
                'serviceType':'=serviceType',
                'selectedModelScheme':'=selectedModelScheme',
                'schemes':'=schemes',
                'user':'=user'
            },
            link: link,
            template: '<div ng-include="getContentUrl()"></div>'
        };
    }

    function paymentsSchemeByTemplate(paymentsService) {
        function link($scope, element, attrs) {
            $scope.form=attrs.educationForm;
            if(attrs.educationForm=='online'){
                paymentsService
                    .scheme({
                        service:$scope.serviceType,
                        contentId: $scope.contentId,
                        educationFormId:1,
                        templateId: $scope.schemeTemplate
                    })
                    .$promise
                    .then(function (data) {
                        $scope.schemes=data;
                    });
            } else if(attrs.educationForm=='offline'){
                paymentsService
                    .scheme({
                        service:$scope.serviceType,
                        contentId: $scope.contentId,
                        educationFormId:2,
                        templateId: $scope.schemeTemplate
                    })
                    .$promise
                    .then(function (data) {
                        $scope.schemes=data;
                    });
            }

            $scope.getContentUrl = function() {
                if($scope.serviceType=='course')
                    return basePath + '/angular/js/templates/paymentsSchemesByTemplate.html';
                else return basePath + '/angular/js/templates/modulesPaymentsSchemesByTemplate.html';
            }
        }
        return {
            scope: {
                'contentId':'=contentId',
                'serviceType':'=serviceType',
                'schemes':'=schemes',
                'schemeTemplate':'=schemeTemplate'
            },
            link: link,
            template: '<div ng-include="getContentUrl()"></div>'
        };
    }