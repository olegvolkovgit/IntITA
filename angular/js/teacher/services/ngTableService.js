/**
 * Created by Adm on 08.09.2017.
 * Service for Ngtable
 * @param url Url
 * @method setUrl Sets url to request
 * @method getData Gets data from url
 * Usage ngTableService.setUrl(url_to_set)
 * After that you can call method getData
 */
angular
    .module('teacherApp')
    .service('NgTableDataService',
        function ($resource) {
            var _url = null;
            return {
                setUrl: function (url) {
                    _url = url;
                },
                getData: function (params) {
                    if (_url === null)
                    {
                        console.warn('Url not set, please use setUrl first!');
                        return false;
                    }
                    var resource = $resource(_url);
                    return resource.get(params).$promise.then(
                        function (data) {
                            return data
                        }
                    )
                }

            }
        }
    );

