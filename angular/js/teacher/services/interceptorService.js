/**
 * Created by adm on 08.09.2016.
 */
// angular
//     .module('teacherApp')
//     .service('errorInterceptor', function ($q) {
//         var service = this;
//         service.responseError = function (response) {
//             if (response.status == 403 || response.status == 50) {
//                 window.location = basePath + '/cabinet';
//             }
//             return $q.reject(response);
//         };
//     }).config(['$httpProvider', function ($httpProvider) {
//     $httpProvider.interceptors.push('errorInterceptor');
// }])