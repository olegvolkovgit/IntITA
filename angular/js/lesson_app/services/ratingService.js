angular
    .module('lessonApp')
    .factory('ratingService', ['$resource', 'transformRequest',
        function($resource, transformRequest){
            return $resource(
                '',
                {},
                {
                    getOldRating: {
                        url: '/lesson/getOldRating',
                        params: {
                            id_lecture: idLecture
                        }
                    },
                    nextLecture: {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;',
                                     'X-Requested-With' : 'XMLHttpRequest'  // Needed by Yii to look at it as ajax request.
                        },
                        url: '/lesson/nextLecture',
                        params: {
                            params: 'params'
                        },
                        transformRequest: transformRequest.bind(null)
                    },
                    averageRating: {
                        url: '/lesson/averageRatingLecture',
                        params: {
                            idModule: idModule
                        }
                    },
                    saveRatingModule: {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;',
                                    'X-Requested-With' : 'XMLHttpRequest'  // Needed by Yii to look at it as ajax request.
                        },
                        url: '/lesson/saveRatingModule',
                        params: {
                            params: 'params'
                        },
                        transformRequest : transformRequest.bind(null)
                    }
                });
        }]);