'use strict';

/* Services */

(function () {
    var lodash = _.noConflict();
    angular
        .module('teacherApp')
        .factory('lodash', [function () {
            return lodash;
        }]);
})();

