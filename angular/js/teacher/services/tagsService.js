'use strict';

/* Services */

angular
  .module('teacherApp')
  .factory('tagsService', ['$resource', 'transformRequest', '$httpParamSerializer',
    function ($resource, transformRequest, $httpParamSerializer) {
      var url = basePath;
      return $resource(
        '',
        {},
        {
          list: {
            url: url + '/module/getTagsList',
            method: 'GET',
            isArray: true
          },
          moduleTags: {
            url: url + '/module/getModuleTags',
            method: 'POST',
            isArray: true,
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
            transformRequest : transformRequest.bind(null)
          },
          addTagToModule: {
            url: url + '/module/addTag',
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
            transformRequest : transformRequest.bind(null),
            isArray: true
          },
          removeTagFromModule: {
            url: url + '/module/removeTag',
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
            transformRequest : transformRequest.bind(null),
            isArray: true
          }
        });
    }]);