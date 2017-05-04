'use strict';

/* Services */

angular
  .module('teacherApp')
  .factory('cityService', ['$resource',
    function ($resource) {
      var url = basePath + '/cities';
      return $resource(
        '',
        {},
        {
          get : {
            url: url + '/get',
            method: "GET"
          },
          typeahead: {
            url: url + '/typeahead',
            method: "GET",
            isArray:true
          }
        });
    }]);
