'use strict';

/* Services */

angular
  .module('teacherApp')
  .factory('companiesService', ['$resource', 'transformRequest',
    function ($resource, transformRequest) {
      var url = basePath + '/_teacher/_accountant/company';
      return $resource(
        '',
        {},
        {
          list: {
            url: url + '/list',
            method: "GET"
          },
          get: {
            url: url + '/viewCompany',
            method: "GET"
          },
          representatives : {
            url: url + '/representatives',
            method: "GET",
          },
          servicesList : {
            url: url + '/servicesList',
            method: "GET",
          },
          saveRepresentative : {
            url: url + '/saveRepresentative',
            headers: {'Content-Type':'application/x-www-form-urlencoded;charset=utf-8;'},
            transformRequest: transformRequest.bind(null),
            method: 'POST',
          },
          upsert: {
            method: 'POST',
            headers: {'Content-Type':'application/x-www-form-urlencoded;charset=utf-8;'},
            transformRequest: transformRequest.bind(null),
            url: url + '/upsert'
          },
          bindService: {
            method: "POST",
            headers: {'Content-Type':'application/x-www-form-urlencoded;charset=utf-8;'},
            transformRequest: transformRequest.bind(null),
            url: url + '/bindService'
          },
          unBindService: {
            method: "POST",
            headers: {'Content-Type':'application/x-www-form-urlencoded;charset=utf-8;'},
            transformRequest: transformRequest.bind(null),
            url: url + '/unBindService'
          }
        });
    }]);
