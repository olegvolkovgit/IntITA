/**
 * Created by Wizlight on 11.12.2015.
 */
angular
    .module('interpreterApp')
    .controller('interpreterCtrl',interpreterCtrl);

function interpreterCtrl($scope,sendTaskJsonService,getTaskJson) {
    var codeMirrorLang;
    switch ($scope.lang) {
        case "js":
            codeMirrorLang="text/javascript";
            break;
        case "php":
            codeMirrorLang="text/x-php";
            break;
        case "c++":
            codeMirrorLang="text/x-c++src";
            break;
        case "c#":
            codeMirrorLang="text/x-csharp";
            break;
        case "java":
            codeMirrorLang="text/x-java";
            break;
    }


    $scope.codeMirrorOptions = {
        lineNumbers: true,             // показывать номера строк
        matchBrackets: true,             // подсвечивать парные скобки
        mode: codeMirrorLang,
        theme: "rubyblue",               // стиль подсветки
        indentUnit: 4                    // размер табуляции
    };

    getTaskJson.getJson($scope.task,$scope.interpreterServer).then(function(response){
        $scope.editedJson=response;
        //load json for edit if it is
        if ($scope.editedJson != undefined){
            
            //replace space symbols for json
            var oldSymbol = ['\n','\t','\r'];
            var newSymbol = ['\\n','\\t','\\r'];
            for (var i in oldSymbol) {
                $scope.editedJson=$scope.editedJson.replace( RegExp( oldSymbol[i], "g" ), newSymbol[i]);
            }

            $scope.editedJson=JSON.parse($scope.editedJson);
            $scope.editedJson.function.function_name=$scope.editedJson.name+$scope.prefix;
            $scope.results=$scope.editedJson.function.results;
            $scope.compare_marks=$scope.editedJson.function.compare_mark;
            $scope.tests_code_arr=$scope.editedJson.function.tests_code;
            $scope.compareFull=$scope.editedJson.function.checkable_args_indexes;
            for (var k = 0; k < $scope.editedJson.function.args.length; k++) {
                $scope.loadPattern($scope.editedJson.function.args[k].type,$scope.editedJson.function.args[k].size,k);
            }
            $scope.loadResultPattern($scope.editedJson.function.type,$scope.editedJson.function.size);
            $scope.args = $scope.editedJson.function.args;
            for (var i = 0; i < $scope.args.length; i++) {
                for (var j = 0; j < $scope.args[i].etalon_value.length; j++) {
                    if($scope.args[i].etalon_value[j][0]==''){
                        $scope.args[i].etalon_value[j] = $scope.args[i].etalon_value[j].join('');
                    }
                }
            }
            for (var i = 0; i < $scope.editedJson.function.args.length; i++) {
                if(i>=0){
                    for (var j=0;j<3;j++)
                        $scope.indexes.push({
                            index: [],
                            value: $scope.indexes.length
                        });
                }
                $scope.indexes[3+i*3].index = '$'+$scope.editedJson.function.args[i].arg_name;
                $scope.indexes[3+(i*3+1)].index = '$'+$scope.editedJson.function.args[i].arg_name+'_etalon';
                $scope.indexes[3+(i*3+2)].index = '$'+$scope.editedJson.function.args[i].arg_name+'_for_etalon';
            }
            for (var u=0;u<$scope.editedJson.function.unit_test_num-1;u++){
                $scope.units.push({
                    result: ''
                });
            }
            $scope.function = $scope.editedJson.function;
            $scope.finalResult = $scope.editedJson;
        }
    });

    $scope.Math = window.Math;
    $scope.prefix = '_'+$scope.task;
    //options
    $scope.types = [
        {name:'Integer', type:0},
        {name:'Float', type:1},
        {name:'Bool', type:2},
        {name:'String', type:3},
        {name:'Char', type:4},
        {name:'Range', type:5}
    ];
    $scope.is_array = [
        {name:'Primitive', value:0},
        {name:'Array', value:1}
    ];
    $scope.compare = [
        {name:'<=', value:0, bool:false},
        {name:'<', value:1, bool:false},
        {name:'==', value:2, bool:false},
        {name:'>', value:3, bool:false},
        {name:'>=', value:4, bool:false},
        {name:'!=', value:5, bool:false},
        {name:'==', value:2, bool:true},
        {name:'!=', value:5, bool:true}
    ];
    $scope.indexes = [
        {index:'$result', value:0},
        {index:'$result_etalon', value:1},
        {index:'$result_for_etalon', value:2},
    ];
    //options
    //init obj
    $scope.results=[];
    $scope.etalon='';
    $scope.compare_marks=[2];
    $scope.tests_code_arr=[];
    $scope.compareFull=[
        [{
            first: 0,
            second: 0
        }]
    ];
    $scope.args= [];
    $scope.units=
        [{
            result: '',
            compare_mark:''
        }];
    $scope.unitsResult = '';
    $scope.name='';
    //init obj

    $scope.function = {
        function_name: '',
        type: 0,
        array_type: 0,
        size:null,
        unit_test_num: 1,
        checkable_args_indexes:$scope.compareFull,
        results: $scope.results,
        compare_mark: $scope.compare_marks,
        tests_code:$scope.tests_code_arr,
        args : $scope.args
    };
    $scope.finalResult= {
        operation: "addtask",
        task: $scope.task,
        etalon: $scope.etalon,
        lang: $scope.lang,
        function : $scope.function,
        name:$scope.name
    };
    //add options to select
    $scope.updateList = function(index, arg){
        if($("#params").hasClass('invalidParams')) $("#params").removeClass('invalidParams');
        $scope.indexes[3+3*index].index = '$'+arg;
        $scope.indexes[3+(3*index+1)].index = '$'+arg+'_etalon';
        $scope.indexes[3+(3*index+2)].index = '$'+arg+'_for_etalon';
    };
    //add options to select
    $scope.sizeRefresh = function(index,array,type){
        if(array==0){
            for(var i=0;i<$scope.args[index].value.length;i++){
                $scope.args[index].value[i]=null;
                $scope.args[index].etalon_value[i]='';
            }
            $scope.args[index].size=null;
            $scope.updatePattern(type,null,index);
        }
        if(array!=0){
            $scope.args[index].size=1;
            $scope.updatePattern(type,1,index);
        }
    };
    $scope.sizeResultRefresh = function(array,type){
        if(array==0){
            for(var i=0;i<$scope.function.results.length;i++){
                $scope.editedJson.function.results[i]=null;
            }
            $scope.function.size=null;
            $scope.updateResultPattern(type,null);
        }
        if(array!=0){
            $scope.function.size=1;
            $scope.updateResultPattern(type,1);
        }
    };
    //add or delete form
    $scope.addDellForm = function (index, indexArg) {
        if(index==0){
            $scope.args.push({
                type: 0,
                size: null,
                arg_name: '',
                pattern:/^[-]?\d+$/,
                value: [],
                is_array: 0,
                etalon_value: [''],
                compare_mark: [2]
            });
            for (var j=1;j<$scope.units.length;j++){
                $scope.args[$scope.args.length-1].compare_mark.push(2);
                $scope.args[$scope.args.length-1].etalon_value.push('');
            }
            for (var i=0;i<3;i++)
                $scope.indexes.push({
                    index: [],
                    value: $scope.indexes.length
                });
        }else{
            $scope.args.splice(indexArg, 1);
            $scope.indexes.splice(3+(3*indexArg), 3);
        }
    };

    $scope.addDellFormResult = function (index) {
        if(index==0){
            for (var i=0;i<$scope.function.args.length;i++){
                $scope.function.args[i].etalon_value.push('');
            }
            $scope.units.push({
                result: ''
            });
            $scope.function.compare_mark[$scope.units.length-1]=2;
            for (var i=0;i<$scope.function.args.length;i++){
                $scope.function.args[i].compare_mark[$scope.units.length-1]=2;
            }
            $scope.compareFull.push(
                [{
                first: 0,
                second: 0
                }]
            );
            $scope.function['unit_test_num']=$scope.units.length;
        }else{
            $scope.units.splice(index, 1);
            $scope.function.checkable_args_indexes.splice(index, 1);
            $scope.function.results.splice(index, 1);
            $scope.function.compare_mark.splice(index, 1);
            $scope.function.tests_code.splice(index, 1);
            for (var i=0;i<$scope.function.args.length;i++){
                $scope.function.args[i].value.splice(index, 1);
                $scope.function.args[i].etalon_value.splice(index, 1);
                $scope.function.args[i].compare_mark.splice(index, 1);
            }
            $scope.function['unit_test_num']=$scope.units.length;
        }
    };
    $scope.addDellCompare = function (bool,index) {
        if(bool==0){
            $scope.compareFull[index].push({
                first: 0,
                second: 0
            });
        }else{
            $scope.compareFull[index].splice(-1, 1);
        }
    };
    //add or delete form

    //переглядаэмо чи є аргумент масивом і відповідно формуємо value в json и результат
    $scope.res_finalResult = null;

    $scope.$watch('finalResult', function(_data) {
        $scope.res_finalResult = angular.copy(_data);
        for (var i = 0; i < _data.function.args.length; i++) {
            if (_data.function.args[i].is_array) {
                for (var j = 0; j < _data.function.args[i].value.length; j++) {
                    if ($scope.res_finalResult.function.args[i].value[j] != null && (typeof _data.function.args[i].value[j]) == 'string') {
                        $scope.res_finalResult.function.args[i].value[j] = _data.function.args[i].value[j].split(',');
                    }
                }
                for (var j = 0; j < _data.function.args[i].etalon_value.length; j++) {
                    if($scope.res_finalResult.function.args[i].etalon_value[j]!=null && (typeof _data.function.args[i].etalon_value[j])=='string'){
                        $scope.res_finalResult.function.args[i].etalon_value[j] = _data.function.args[i].etalon_value[j].split(',');
                        for (var n = 0; n < _data.function.args[i].size; n++) {
                            if($scope.res_finalResult.function.args[i].etalon_value[j][n]==undefined)
                                $scope.res_finalResult.function.args[i].etalon_value[j].push('');
                        }
                    }
                }
            }
        }
        if (_data.function.array_type) {
            for (var k = 0; k < _data.function.results.length; k++) {
                if($scope.res_finalResult.function.results[k]!=null && (typeof _data.function.results[k])=='string')
                    $scope.res_finalResult.function.results[k] = _data.function.results[k].split(',')
            }
        }
    }, true);
    //переглядаэмо чи є аргумент масивом і відповідно формуємо value в json и результат
    //Генерація назви функції з префіксом
    $scope.fNameGenerate = function () {
        $scope.function.function_name=$scope.finalResult.name+$scope.prefix;
    };
    $scope.sendJson = function (url,idTask,uid) {
        for (var i=0;i<$scope.res_finalResult.function.args.length;i++){
            if($scope.res_finalResult.function.args[i].type==0 && $scope.res_finalResult.function.args[i].is_array==0){
                for(var j=0;j<$scope.res_finalResult.function.args[i].value.length;j++){
                    if($scope.res_finalResult.function.args[i].value[j]<-2147483648 || $scope.res_finalResult.function.args[i].value[j]>2147483647){
                        bootbox.alert("Значення змінної <b>"+$scope.res_finalResult.function.args[i].arg_name+'</b> виходить за межі розмірності Integer в '+(j+1)+' юніттесті');
                        return false;
                    }
                    if($scope.res_finalResult.function.args[i].etalon_value[j]<-2147483648 || $scope.res_finalResult.function.args[i].etalon_value[j]>2147483647){
                        bootbox.alert("Еталоне значення змінної <b>"+$scope.res_finalResult.function.args[i].arg_name+'</b> виходить за межі розмірності Integer в '+(j+1)+' юніттесті');
                        return false;
                    }
                }
            }
            if($scope.res_finalResult.function.args[i].type==0 && $scope.res_finalResult.function.args[i].is_array==1){
                for(var j=0;j<$scope.res_finalResult.function.args[i].value.length;j++){
                    for(var k=0;k<$scope.res_finalResult.function.args[i].value[j].length;k++) {
                        if ($scope.res_finalResult.function.args[i].value[j][k] < -2147483648 || $scope.res_finalResult.function.args[i].value[j][k] > 2147483647) {
                            bootbox.alert("Значення "+(k+1)+"-го елемента змінної <b>" + $scope.res_finalResult.function.args[i].arg_name + '</b> виходить за межі розмірності Integer в ' + (j + 1) + ' юніттесті');
                            return false;
                        }
                        if ($scope.res_finalResult.function.args[i].etalon_value[j][k] < -2147483648 || $scope.res_finalResult.function.args[i].etalon_value[j][k] > 2147483647) {
                            bootbox.alert("Значення "+(k+1)+"-го елемента змінної <b>" + $scope.res_finalResult.function.args[i].arg_name + '</b> виходить за межі розмірності Integer в ' + (j + 1) + ' юніттесті');
                            return false;
                        }
                    }
                }
            }
        }
        if($scope.res_finalResult.etalon=='' ){
            if($scope.res_finalResult.function.type==0 && $scope.res_finalResult.function.array_type==0) {
                for (var i = 0; i < $scope.res_finalResult.function.results.length; i++) {
                    if($scope.res_finalResult.function.results[i]<-2147483648 || $scope.res_finalResult.function.results[i]>2147483647){
                        bootbox.alert("Вихідне значення виходить за межі розмірності Integer в "+(i+1)+' юніттесті');
                        return false;
                    }
                }
            }
            if($scope.res_finalResult.function.type==0 && $scope.res_finalResult.function.array_type==1) {
                for (var i = 0; i < $scope.res_finalResult.function.results.length; i++) {
                    for (var j = 0; j < $scope.res_finalResult.function.results[i].length; j++) {
                        if ($scope.res_finalResult.function.results[i][j] < -2147483648 || $scope.res_finalResult.function.results[i][j] > 2147483647) {
                            bootbox.alert((j+1)+"-й елемент вихідного значення виходить за межі розмірності Integer в " + (i + 1) + ' юніттесті');
                            return false;
                        }
                    }
                }
            }
        }
        if(returnUnique($scope.res_finalResult.function.args).length!=$scope.res_finalResult.function.args.length){
            bootbox.alert("Назви змінних не можуть бути однакові");
            $('html, body').animate({
                scrollTop: $("#title").offset().top
            }, 1000);
            $("#params").addClass('invalidParams');
        }else{
            $scope.res_finalResult.task=uid;
            sendTaskJsonService.sendJson(url,$scope.res_finalResult, idTask);
        }

        function returnUnique(arr) {
            var obj = new Object;
            for (var i = 0, i_max = $scope.res_finalResult.function.args.length; i < i_max; i++) {
                obj[$scope.res_finalResult.function.args[i].arg_name] = '';
            }
            return Object.keys(obj);
        }
    };

    //pattern validation

    $scope.updatePattern = function(type,size,index){
        if(size==null){
            switch (type) {
                case 0:
                    $scope.args[index].pattern=/^[-]?\d+$/;
                    break;
                case 1:
                    $scope.args[index].pattern=/^[-]?[0-9]+(\.[0-9]+)?$/;
                    break;
                case 2:
                    $scope.args[index].pattern=/^(true|false)$/;
                    for (var i=0;i<$scope.function.unit_test_num;i++){
                        $scope.function.args[index].compare_mark[i]=2;
                    }
                    break;
                case 3:
                    $scope.args[index].pattern=/./;
                    break;
                case 4:
                    $scope.args[index].pattern=/^(.)$/;
                    break;
                default:
                    $scope.args[index].pattern=/./;
            }
        }else{
            switch (type) {
                case 0:
                    $scope.args[index].pattern=new RegExp("^([-]?\\d+,){" + (size-1) + "}[-]?\\d+$");
                    break;
                case 1:
                    $scope.args[index].pattern=new RegExp("^([-]?[0-9]+(\\.[0-9]+)?,){" + (size-1) + "}([-]?[0-9]+(\\.[0-9]+)?)$");
                    break;
                case 2:
                    $scope.args[index].pattern=new RegExp("^(true,|false,|[01],){" + (size-1) + "}(true|false)$");
                    for (var i=0;i<$scope.function.unit_test_num;i++){
                        $scope.function.args[index].compare_mark[i]=2;
                    }
                    break;
                case 3:
                    $scope.args[index].pattern=new RegExp("^[^,]+(,[^,]+){"+(size-1)+"}$");
                    break;
                case 4:
                    $scope.args[index].pattern=new RegExp("^(.,){" + (size-1) + "}(.)$");
                    break;
                default:
                    $scope.args[index].pattern=/./;
            }
        }
    };
    $scope.updateResultPattern = function(type,size){
        if(size==null){
            switch (type) {
                case 0:
                    $scope.resultPattern=/^[-]?\d+$/;
                    break;
                case 1:
                    $scope.resultPattern=/^[-]?[0-9]+(\.[0-9]+)?$/;
                    break;
                case 2:
                    $scope.resultPattern=/^(true|false)$/;
                    for (var i=0;i<$scope.function.unit_test_num;i++){
                        $scope.function.compare_mark[i]=2;
                    }
                    break;
                case 3:
                    $scope.resultPattern=/./;
                    break;
                case 4:
                    $scope.resultPattern=/^(.)$/;
                    break;
                default:
                    $scope.resultPattern=/./;
            }
        }else{
            switch (type) {
                case 0:
                    $scope.resultPattern=new RegExp("^([-]?\\d+,){" + (size-1) + "}[-]?\\d+$");
                    break;
                case 1:
                    $scope.resultPattern=new RegExp("^([-]?[0-9]+(\\.[0-9]+)?,){" + (size-1) + "}([-]?[0-9]+(\\.[0-9]+)?)$");
                    break;
                case 2:
                    $scope.resultPattern=new RegExp("^(true,|false,|[01],){" + (size-1) + "}(true|false)$");
                    for (var i=0;i<$scope.function.unit_test_num;i++){
                        $scope.function.compare_mark[i]=2;
                    }
                    break;
                case 3:
                    $scope.resultPattern=new RegExp("^[^,]+(,[^,]+){"+(size-1)+"}$");
                    break;
                case 4:
                    $scope.resultPattern=new RegExp("^(.,){" + (size-1) + "}(.)$");
                    break;
                default:
                    $scope.resultPattern=/./;
            }
        }
    };
    //pattern validation when edit load
    $scope.loadPattern = function(type,size,index){
        if(size==null){
            switch (type) {
                case 0:
                    $scope.editedJson.function.args[index].pattern=/^[-]?\d+$/;
                    break;
                case 1:
                    $scope.editedJson.function.args[index].pattern=/^[-]?[0-9]+(\.[0-9]+)?$/;
                    break;
                case 2:
                    $scope.editedJson.function.args[index].pattern=/^(true|false)$/;
                    break;
                case 3:
                    $scope.editedJson.function.args[index].pattern=/./;
                    break;
                case 4:
                    $scope.editedJson.function.args[index].pattern=/^(.)$/;
                    break;
                default:
                    $scope.editedJson.function.args[index].pattern=/./;
            }
        }else{
            switch (type) {
                case 0:
                    $scope.editedJson.function.args[index].pattern=new RegExp("^([-]?\\d+,){" + (size-1) + "}[-]?\\d+$");
                    break;
                case 1:
                    $scope.editedJson.function.args[index].pattern=new RegExp("^([-]?[0-9]+(\\.[0-9]+)?,){" + (size-1) + "}([-]?[0-9]+(\\.[0-9]+)?)$");
                    break;
                case 2:
                    $scope.editedJson.function.args[index].pattern=new RegExp("^(true,|false,|[01],){" + (size-1) + "}(true|false)$");
                    break;
                case 3:
                    $scope.editedJson.function.args[index].pattern=new RegExp("^[^,]+(,[^,]+){"+(size-1)+"}$");
                    break;
                case 4:
                    $scope.editedJson.function.args[index].pattern=new RegExp("^(.,){" + (size-1) + "}(.)$");
                    break;
                default:
                    $scope.editedJson.function.args[index].pattern=/./;
            }
        }
    };
    $scope.loadResultPattern = function(type,size){
        if(size==null){
            switch (type) {
                case 0:
                    $scope.resultPattern=/^[-]?\d+$/;
                    break;
                case 1:
                    $scope.resultPattern=/^[-]?[0-9]+(\.[0-9]+)?$/;
                    break;
                case 2:
                    $scope.resultPattern=/^(true|false)$/;
                    break;
                case 3:
                    $scope.resultPattern=/./;
                    break;
                case 4:
                    $scope.resultPattern=/^(.)$/;
                    break;
                default:
                    $scope.resultPattern=/./;
            }
        }else{
            switch (type) {
                case 0:
                    $scope.resultPattern=new RegExp("^([-]?\\d+,){" + (size-1) + "}[-]?\\d+$");
                    break;
                case 1:
                    $scope.resultPattern=new RegExp("^([-]?[0-9]+(\\.[0-9]+)?,){" + (size-1) + "}([-]?[0-9]+(\\.[0-9]+)?)$");
                    break;
                case 2:
                    $scope.resultPattern=new RegExp("^(true,|false,|[01],){" + (size-1) + "}(true|false)$");
                    break;
                case 3:
                    $scope.resultPattern=new RegExp("^[^,]+(,[^,]+){"+(size-1)+"}$");
                    break;
                case 4:
                    $scope.resultPattern=new RegExp("^(.,){" + (size-1) + "}(.)$");
                    break;
                default:
                    $scope.resultPattern=/./;
            }
        }
    };

    $scope.updateResultPattern($scope.function.type,$scope.function.size);
    $scope.positiveIntPattern=/^[1-9]\d*$/;

    $scope.updateCompare = function(a){
        if(a.first==null)
            a.first=0;
        if(a.second==null)
            a.second=a.first;
    }
}