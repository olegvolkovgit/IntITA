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
                        var result=JSON.parse(response.data.json.replace(/\n/g, "\\n"));
                        var type, arg_type;
                        var variable = [];
                        for(var i=0;i<result.function.args.length;i++){
                            type=result.function.args[i]['type'];
                            switch (type) {
                                case 0:
                                    arg_type = 'integer';
                                    break;
                                case 1:
                                    arg_type = 'float';
                                    break;
                                case 2:
                                    arg_type = 'bool';
                                    break;
                                case 3:
                                    arg_type = 'string';
                                    break;
                            }
                            variable.push({
                                arg:result.function.args[i]['arg_name'],
                                type:arg_type,
                                array:result.function.args[i]['is_array'],
                                size:result.function.args[i]['size'],
                            });
                        }
                        return variable;
                    }
                }, function errorCallback() {
                    bootbox.alert("Вибачте, але на сайті виникла помилка і додати задачу до заняття наразі неможливо. Спробуйте додати пізніше або зв'яжіться з адміністратором сайту.");
                });
                return promise;
            };
        }
    ]);