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
    });


