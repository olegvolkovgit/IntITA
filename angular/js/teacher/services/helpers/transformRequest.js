'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('transformRequest', [function () {
        return function transformRequest(data) {
            var result = [];
            for (var name in data) {
                if (typeof data[name] === 'function' ||
                    data[name] === null ||
                    data[name] === undefined ||
                    data[name] === NaN) {
                    continue;
                } else if (Array.isArray(data[name])) {
                    for (var index in data[name]) {
                        result.push(name + '[' + index + ']=' + transformRequest(data[name][index]));
                    }
                } else if (typeof data[name] === 'object') {
                    result.push(transformRequest(data[name]));
                } else {
                    result.push(name + '=' + data[name]);
                }
            }
            return result.join('&');
        }

    }]);
