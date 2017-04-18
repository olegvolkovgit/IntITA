angular
    .module('lessonApp')
    .controller('starsBlockCtrl', function ($scope, $http) {

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

        // $scope.sendData = function(ratings){
        $scope.sendData = function(ratings, lecture_id, courses_id){

            event.preventDefault();
            $scope.result = {
                ratings: ratings,
                lecture_id: lecture_id,
                courses_id: courses_id
            };
                console.log($scope.result);

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
    });