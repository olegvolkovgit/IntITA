/**
 * Created by Wizlight on 06.02.2016.
 */
angular
    .module('mainApp')
    .directive('editTitle', editTitle)
    .directive('cancelEdit', cancelEdit)

function editTitle() {
    return {
        restrict: 'EA',
        link: function(scope, $element){
            $element.on('click', function(){
                angular.element(document.querySelectorAll(".moduleTitle")).show();
                angular.element(document.querySelectorAll(".editTitle")).hide();
                $element.parent().hide();
                $element.parent().next().show();
            });
        }
    }
};

function cancelEdit() {
    return {
        link: function (scope, $element) {
            $element.on("click", function () {
                $element.parent().hide();
                $element.parent().prev().show();
            })
        }
    }
};