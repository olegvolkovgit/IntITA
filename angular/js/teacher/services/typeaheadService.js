/**
 * Created by adm on 31.08.2016.
 */
angular
    .module('teacherApp').factory('typeAhead',function($http){
    return {
        getData: function (url,query){
            return $http.get(url,{
                params:{query:query}
            }).then(function(response){
                    if (response.data.results)
                        return response.data.results.map(function(item){
                            return item;
                        });
                });
        }
    }
});





