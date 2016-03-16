/**
 * Created by Wizlight on 24.12.2015.
 */
angular
    .module('interpreterApp')
    .directive('paramsForm',function(){
        return{
            restrict:'E',
            templateUrl: basePath+'/angular/js/interpreter_app/template/paramsForm.html'
        };
    })
    .directive('unitForm',function(){
        return{
            restrict:'E',
            templateUrl:  basePath+'/angular/js/interpreter_app/template/unitTestForm.html'
        };
    })
    .directive('resultForm',function(){
        return{
            restrict:'E',
            templateUrl:  basePath+'/angular/js/interpreter_app/template/resultForm.html'
        };
    })
    .directive('compareForm',function(){
        return{
            restrict:'E',
            templateUrl:  basePath+'/angular/js/interpreter_app/template/argsIndexes.html'
        };
    })

    .directive('spoilerTest',function(){
        return {
            link: function (scope, element) {
                element.bind('click', function () {
                    if(element.next().is(':visible')){
                        element.html('Показати юніттест <i class="fa fa-expand"></i>');
                    }else{
                        element.html('Приховати юніттест <i class="fa fa-expand"></i>');
                    }
                    element.next().toggle();
                });
            }
        };
    })
    .directive('cleanModel',['$parse',
        function($parse) {
        return {
            require: 'ngModel',
            link: function (scope, element, attributes, controller) {
                scope.$watch(function() { return element.is(':hidden') }, function() {
                    var modelGetter = $parse(attributes['ngModel']);
                    var modelSetter = modelGetter.assign;
                    if(!element.is(':visible')) {
                        modelSetter(scope, '');
                    }
                });
            }
        }
    }]);

