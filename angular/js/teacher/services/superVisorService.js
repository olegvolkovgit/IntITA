'use strict';

/* Services */

angular
    .module('teacherApp')
    .factory('superVisorService', ['$resource','transformRequest',
        function ($resource, transformRequest) { 
            var url = basePath+'/_teacher/_supervisor/superVisor';
            return $resource(
                '',
                {},
                {
                    offlineGroupsList: {
                        url: url + '/getOfflineGroupsList',
                        method: 'GET',
                    },
                    offlineSubgroupsList: {
                        url: url + '/getOfflineSubgroupsList',
                        method: 'GET',
                    },
                    offlineStudentsList: {
                        url: url + '/getOfflineStudentsList',
                        method: 'GET',
                    },
                    studentsWithoutGroupList: {
                        url: url + '/getStudentsWithoutGroupList',
                        method: 'GET',
                    },
                    offlineGroupSubgroupsList: {
                        url: url + '/getGroupsOfflineSubgroupsList',
                        method: 'GET',
                    },
                    getSpecializationsList: {
                        url: url + '/getSpecializationsList',
                        isArray:true
                    },
                    courseAccessList: {
                        url: url + '/getCourseAccessList',
                        method: 'GET',
                    },
                    moduleAccessList: {
                        url: url + '/getModuleAccessList',
                        method: 'GET',
                    },
                    subgroupData: {
                        url: url + '/getSubgroupData',
                        method: 'GET',
                    },
                    groupData: {
                        url: url + '/getGroupData',
                        method: 'GET',
                    },
                    trainersStudentsList: {
                        url: url + '/getTrainersStudentsList',
                        method: 'GET',
                    },
                    setTrainer: {
                        url: url + '/setTrainer',
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        transformRequest : transformRequest.bind(null)
                    },
                    removeTrainer: {
                        url: url + '/removeTrainer',
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        transformRequest : transformRequest.bind(null)
                    },
                    courseModuleAccessList: {
                        url: url + '/getCourseModuleAccessList',
                        method: 'GET',
                    },
                    lecturesRatingList: {
                        url: url + '/getLecturesRatingList',
                        method: 'GET'
                    },
                    modulesRatingList: {
                        url: url + '/getModulesRatingList',
                        method: 'GET'
                    },
                    getAllReasons: {
                        url: url + '/getAllReasons',
                        method: 'GET',
                        isArray : true
                    }

                });
        }])
    .service('chatIntITAMessenger', ['$http',
        function($http) {
            this.updateGroup = function (id) {
                var url=baseChatPath+'/group_operations/update/'+id;
                var promise = $http({url: url, method: "GET", headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                   console.log(response);
                }, function errorCallback(response) {
                    console.log(response);
                    alert('Оновити чат групи не вдалося');
                });
                return promise;
            };
            this.updateSubgroup = function (id) {
                var url=baseChatPath+'/sub_group_operations/update/'+id;
                var promise = $http({url: url, method: "GET", headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response;
                }, function errorCallback(response) {
                    console.log(response);
                    bootbox.alert('Оновити чат підгрупи не вдалося');
                });
                return promise;
            };
            this.updateRoles = function (id) {
                var url=baseChatPath+'/roles_operations/update';
                var promise = $http({url: url, method: "GET", headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                }).then(function successCallback(response) {
                    return response;
                }, function errorCallback(response) {
                    console.log(response);
                    bootbox.alert('Оновити ролі не вдалося');
                });
                return promise;
            };
        }
    ]);