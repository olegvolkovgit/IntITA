angular
    .module('lessonApp')
    .controller('starsBlockCtrl', function ($scope, $http, ratingService) {

        ratingService.getOldRating({'id_lecture': idLecture})
            .$promise
            .then(function successCallback(data) {
                    $scope.ratings[0].rate = data.understand_rating;
                    $scope.ratings[1].rate = data.interesting_rating;
                    $scope.ratings[2].rate = data.accessibility_rating;
                    $scope.ratings.comment = data.comment;
            }, function errorCallback(error, status) {
                $scope.data.error = { message: error, status: status};
                console.log($scope.data.error.status);
            });

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

            ratingService.nextLecture({'params': $scope.result})
                .$promise
                .then(function successCallback(data) {
                    location.href = data.url;
                }, function errorCallback(response){
                    console.log(response);
                    bootbox.alert("Операцію не вдалося виконати");
                });
        };
    })


    .controller('starsModuleCtrl', function($scope, $http, ratingService, progressServices){
        progressServices.createRatingUserModule(idModule);
             // get average rating on modules and set show on stars
        ratingService.averageRating({'idModule': idModule})
            .$promise
            .then(function successCallback(data) {
                    $scope.ratings[0].rate = data.understand_rating;
                    $scope.ratings[1].rate = data.interesting_rating;
                    $scope.ratings[2].rate = data.accessibility_rating;
                    $scope.ratings.comment = data.comment;
            }, function errorCallback(response) {
                console.log(response);
                bootbox.alert("Операцію не вдалося виконати");
            });

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
            event.preventDefault();  // отмена перегрузки страницы по submit
            $scope.result = {
                ratings: ratings,
                idModule: idModule
            };

            ratingService.saveRatingModule({'params': $scope.result})
                .$promise
                .then(function successCallback(data) {
                    location.reload();
                }, function errorCallback(response) {
                    console.log(response);
                    bootbox.alert("Операцію не вдалося виконати");
                })
        }
    });