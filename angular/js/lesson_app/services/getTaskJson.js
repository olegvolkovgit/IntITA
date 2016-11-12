/**
 * Created by Wizlight on 21.01.2016.
 */
angular
    .module('lessonApp')
    .service('getTaskJson', [
        '$http',
        function($http) {
            this.getJson = function (id,url) {
                var json={
                    "operation": "getJson",
                    "task": id
                };
                var promise = $http({
                    url: url,
                    method: "POST",
                    data: JSON.stringify(json),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    if(response.data.status=='success'){
                        //replace space symbols for json
                        var oldSymbol = ['\n','\t','\r'];
                        var newSymbol = ['\\n','\\t','\\r'];
                        for (var i in oldSymbol) {
                            response.data.json=response.data.json.replace( RegExp( oldSymbol[i], "g" ), newSymbol[i]);
                        }

                        var result=JSON.parse(response.data.json);
                        var type, arg_type,res_type;
                        var variable = [];
                        for(var i=0;i<result.function.args.length;i++){
                            type=result.function.args[i]['type'];
                            arg_type=getType(type);
                            variable.push({
                                arg:result.function.args[i]['arg_name'],
                                type:arg_type,
                                array:result.function.args[i]['is_array'],
                                size:result.function.args[i]['size'],
                            });
                        }
                        res_type=getType(result.function.type);
                        var fullData = {
                            res_type:res_type,
                            res_array:result.function.array_type,
                            res_size:result.function.size,
                            input_variables:variable
                        };
                        return fullData;
                    }
                }, function errorCallback() {
                    bootbox.alert("Вибачте, але на сайті виникла помилка і додати задачу до заняття наразі неможливо. Спробуйте додати пізніше або зв'яжіться з адміністратором сайту.");
                });
                return promise;
            };
        }
    ]);

function getType(type) {
    switch (type) {
        case 0:
            return 'integer';
            break;
        case 1:
            return 'float';
            break;
        case 2:
            return 'bool';
            break;
        case 3:
            return 'string';
            break;
    }
}
