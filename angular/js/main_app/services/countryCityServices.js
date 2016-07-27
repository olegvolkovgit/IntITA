/**
 * Created by Wizlight on 15.07.2016.
 */
angular
    .module('mainApp')
    .service('countryCity', [
        '$http',
        function($http) {
            this.getCountriesList = function () {
                var promise = $http({
                    url: basePath + "/studentReg/getCountriesList",
                    method: "POST",
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    var list=response.data;
                    var index;
                    //up Ukraine to top
                    $.each( list, function( key, value ) {
                        if(value.id==1){
                            index=key;
                            return false;
                        }
                    });
                    if(index){
                        var top=list[index];
                        list.splice(index,1);
                        list.unshift(top);
                    }

                    return list;
                }, function errorCallback() {
                    alert("Виникла помилка при завантажені списку країн. Зв'яжіться з адміністратором сайту.");
                });
                return promise;
            };

            this.getCitiesList = function (idCountry) {
                var promise = $http({
                    url: basePath + "/studentReg/getCitiesList",
                    method: "POST",
                    data: $.param({id: idCountry}),
                    headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response.data;
                }, function errorCallback() {
                    alert("Виникла помилка при завантажені списку міст. Зв'яжіться з адміністратором сайту.");
                });
                return promise;
            };
        }
    ]);
