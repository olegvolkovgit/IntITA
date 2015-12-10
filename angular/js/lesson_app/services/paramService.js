/**
 * Created by Wizlight on 01.12.2015.
 */
angular
    .module('lessonApp')
    .service('paramService', [
        '$injector','$rootScope', '$state', '$stateParams',
        function($injector, $rootScope, $state, $stateParams) {
            "use strict";

            this.getStartParam = function($rootScope, $state, $stateParams) {
                $rootScope.editMode = editMode;
                $rootScope.isAdmin = parseInt(isAdmin);
                $rootScope.lastAccessPage = parseInt(lastAccessPage);
                $rootScope.finishedLecture = parseInt(finishedLecture);

                $rootScope.$state = $state;
                $rootScope.$stateParams = $stateParams;
            };
        }
    ]);