'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('transformRequest', ['$filter', function ($filter) {
        return function transformRequest(data) {
            var result = [];
            for (var name in data) {
                if (data.hasOwnProperty(name)) {
                    if (typeof data[name] === 'function' ||
                        data[name] === null ||
                        data[name] === undefined ||
                        isNaN(data[name])) {
                        continue;
                    } else if (Array.isArray(data[name])) {
                        for (var index in data[name]) {
                            result.push(name + '[' + index + ']=' + transformRequest(data[name][index]));
                        }
                    } else if (data[name] instanceof Date) {
                        result.push(name + '=' + $filter('date')(data[name], 'yyyy-MM-dd HH:mm:ss'));
                    } else if (typeof data[name] === 'object') {
                        result.push(transformRequest(data[name]));
                    } else {
                        result.push(name + '=' + data[name]);
                    }

                }
            }
            return result.join('&');
        }

    }]);
