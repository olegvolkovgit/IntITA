/**
 * Created by adm on 23.08.2016.
 */
angular
    .module('teacherApp')
    .factory('levels', ['$resource',
        function ($resource) {
            var url = basePath+'/_teacher/_super_admin/level/getlevelslist';
            return $resource(
                url,
                {
                    page: 'page',
                    limit: 'limit'
                },
                {
                    list: {
                        method: 'GET',
                        params: {
                            page: 'page',
                            limit: 'limit'
                        }
                    }
                });
        }]);
