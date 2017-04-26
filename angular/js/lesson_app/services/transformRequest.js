angular
    .module('lessonApp')
    .factory('transformRequest', ['$filter', function ($filter) {
        /* https://github.com/knowledgecode/jquery-param/blob/master/jquery-param.js */
        return function transformRequest(a) {
            var s = [], rbracket = /\[\]$/,
                isArray = function (obj) {
                    return Object.prototype.toString.call(obj) === '[object Array]';
                },
                add = function (k, v) {
                    v = typeof v === 'function' ? v() : v === null ? '' : v === undefined ? '' : v;
                    if (v instanceof Date) {
                        v = $filter('date')(v, 'yyyy-MM-dd HH:mm:ss')
                    }
                    s[s.length] = encodeURIComponent(k) + '=' + encodeURIComponent(v);
                },
                buildParams = function (prefix, obj) {
                    var i, len, key;

                    if (prefix) {
                        if (isArray(obj)) {
                            for (i = 0, len = obj.length; i < len; i++) {
                                if (rbracket.test(prefix)) {
                                    add(prefix, obj[i]);
                                } else {
                                    buildParams(prefix + '[' + (typeof obj[i] === 'object' ? i : '') + ']', obj[i]);
                                }
                            }
                        } else if (obj && String(obj) === '[object Object]') {
                            for (key in obj) {
                                buildParams(prefix + '[' + key + ']', obj[key]);
                            }
                        } else {
                            add(prefix, obj);
                        }
                    } else if (isArray(obj)) {
                        for (i = 0, len = obj.length; i < len; i++) {
                            add(obj[i].name, obj[i].value);
                        }
                    } else {
                        for (key in obj) {
                            buildParams(key, obj[key]);
                        }
                    }
                    return s;
                };

            return buildParams('', a).join('&').replace(/%20/g, '+');
        }

    }]);