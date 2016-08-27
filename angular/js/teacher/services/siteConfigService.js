/**
 * Created by adm on 25.08.2016.
 */
angular
    .module('teacherApp')
    .factory('siteConfig', ['$resource',
        function ($resource) {
            var url = basePath+'/_teacher/_admin/config/getconfiglist';
            return $resource(
                '',
                {},
                {
                    list: {
                        url: url,
                        method: 'GET',
                        params: {
                            page: 'page',
                            pageCount: 'pageCount',
                        }
                    }
                });
        }]);
