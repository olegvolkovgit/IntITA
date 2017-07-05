/**
 * Created by Админ on 20.06.2017.
 */
angular
    .module('mainApp')
    .controller('filterTeacherCtrl', function($scope){
        $scope.selectFilter = function(){

            if($scope.input === undefined){
                $scope.input = '';
            }
            if($scope.selector === undefined){
                $scope.selector = 'rating';
            }

            $.fn.yiiListView.update(
                // this is the id of the CListView
                'ajaxListTeacher',
                {
                    url:'teachers/UpdateAjaxFilter',
                    data: {
                        selector: $scope.selector,
                        input: $scope.input
                    }
                }
            )
        };

        $scope.searchInput = function(){

            if($scope.selector === undefined){
                $scope.selector = 'rating';
            }
            if($scope.input === undefined){
                $scope.input = '';
            }

            setTimeout(function () {
                $.fn.yiiListView.update(
                    // this is the id of the CListView
                    'ajaxListTeacher',
                    {
                        url:'teachers/UpdateAjaxFilter',
                        data: {
                            selector: $scope.selector,
                            input: $scope.input
                        }
                    }
                )
            },
            // this is the delay
            300);
        };
    });
