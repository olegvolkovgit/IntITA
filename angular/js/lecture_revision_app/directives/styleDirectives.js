/**
 * Created by Wizlight on 06.01.2016.
 */
angular
    .module('revisionEdit')
    .directive('selectedButton', function () {
        return {
            link: function (scope, element) {
                element.bind('click', function () {
                    var button = angular.element(document.querySelector(".selectedButton"));
                    if (button.length == 1) button.removeClass("selectedButton");
                    element.addClass("selectedButton");
                });
            }
        };
    });