angular
    .module('lessonApp')
    .controller('starsBlockCtrl', function ($scope, $http) {

        $http({
            url: '/lesson/getOldRating',
            method: 'POST',
            data: $.param({
                id_lecture: idLecture
            }),
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With' : 'XMLHttpRequest'    // Needed by Yii to look at it as ajax request.
            }
        }).success(function(data){
            if(data != null){
                $scope.ratings[0].rate = data.understand_rating;
                $scope.ratings[1].rate = data.interesting_rating;
                $scope.ratings[2].rate = data.accessibility_rating;
                $scope.res.comment = data.comment;
            }
        }).error(function(error, status){
            $scope.data.error = { message: error, status: status};
            console.log($scope.data.error.status);
        });

        $scope.ratings = [
            {
                description: 'заняття викладене зрозуміло'
            },
            {
                description: 'матеріал подано цікаво'
            },
            {
                description: 'завдання в міру вимогливі'
            }
        ];

        $scope.res={
            ratings: $scope.ratings
        };

        $scope.max = 10;
        $scope.isReadonly = false;

        $scope.hoveringOver = function(value, index) {
            $scope.ratings[index].overStar = value;
            $scope.ratings[index].number = value;
        };

        $scope.ratingStates = [
            {stateOn: 'glyphicon-star', stateOff: 'glyphicon-star-empty'}
        ];

        $scope.sendData = function(ratings, lecture_id, courses_id){

            event.preventDefault();  // отмена отправки данных по submit
            $scope.result = {
                ratings: ratings,
                lecture_id: lecture_id,
                courses_id: courses_id
            };

            $http({
                url: '/lesson/nextLecture',
                method: 'POST',
                data: $.param({
                        params: $scope.result
                    }) ,
                headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                            'X-Requested-With' : 'XMLHttpRequest'    // Needed by Yii to look at it as ajax request.
                }
            }).success(function(data) {
                location.href = data;  // redirect to new lecture
            }).error(function (error, status){
                $scope.data.error = { message: error, status: status};
                console.log($scope.data.error.status);
            });
        };
    })


    .controller('starsModuleCtrl', function($scope, $http){
        // get average rating on modules and set show on stars
        $http({
            url: '/lesson/averageRatingLecture',
            method: 'POST',
            data: $.param({
                idModule: idModule
            }),
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-Requested-With' : 'XMLHttpRequest'    // Needed by Yii to look at it as ajax request.
            }
        }).success(function(data) {
            $scope.ratings[0].rate = data.understand_rating;
            $scope.ratings[1].rate = data.interesting_rating;
            $scope.ratings[2].rate = data.accessibility_rating;
            $scope.res.comment = data.comment;
        }).error(function (error, status){
            $scope.data.error = { message: error, status: status};
            console.log($scope.data.error.status);
        });

        $scope.ratings = [
            {
                description: 'модуль викладений зрозуміло'
            },
            {
                description: 'матеріал подано цікаво'
            },
            {
                description: 'завдання в міру вимогливі'
            }
        ];

        $scope.res={
            ratings: $scope.ratings
        };

        $scope.max = 10;
        $scope.isReadonly = false;

        $scope.hoveringOver = function(value, index){
            $scope.ratings[index].overStar = value;
            $scope.ratings[index].number = value;
        };

        $scope.ratingStates = [
            {stateOn: 'glyphicon-star', stateOff: 'glyphicon-star-empty'}
        ];

        $scope.sendModuleRatingData = function (ratings) {

            // event.preventDefault();  // отмена перегрузки страницы по submit
            $scope.result = {
                ratings: ratings,
                idModule: idModule
            };
            console.log('result: ', $scope.result);

            $http({
                url: '/lesson/saveRatingModule',
                method: 'POST',
                data: $.param({
                        params: $scope.result
                }),
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-Requested-With' : 'XMLHttpRequest'    // Needed by Yii to look at it as ajax request.
                }
            }).success(function(data) {
                // location.href = data;  // redirect to new lecture
                $('.last').fadeOut(500);
            }).error(function (error, status){
                $scope.data.error = { message: error, status: status};
                console.log($scope.data.error.status);
            });
        }
    });