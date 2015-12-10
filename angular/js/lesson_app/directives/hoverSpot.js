/**
 * Created by Wizlight on 10.12.2015.
 */
//Change tooltips when lecture spots hover
angular
    .module('lessonApp')
    .directive('hoverSpot', hoverSpot);

function hoverSpot() {
    return {
        link: function (scope, element, attrs) {
            attrs.$observe('id', function () {
                if (attrs.id == 'pagePressed') {
                    angular.element('#pointer').css('margin-top', -12);
                    angular.element('#pointer').css('margin-left', attrs.hoverSpot * 35 + 6);
                    angular.element('#pointer').show();
                }
            });
            element.on("mouseenter", function () {
                var tooltipHtml = '<p>' + $(this).attr("title") + '</p>';
                if ($(this).is('.pageNoAccess')) {
                    tooltipHtml = '<p class="titleNoAccess">' + $(this).attr("title") + '<span class="noAccess"> (' + partNotAvailable + ')</span></p>';
                }
                angular.element('#pointer').hide();
                angular.element('#arrowCursor').show();
                angular.element('#arrowCursor').css('margin-top', -12);
                angular.element('#arrowCursor').css('margin-left', attrs.hoverSpot * 35 + 6);
                angular.element('#tooltip').html(tooltipHtml);
                angular.element('#labelBlock').hide();
                angular.element('#tooltip').css('display', 'inline-block');
            });
            element.on("mouseleave", function () {
                var position = angular.element(document.querySelector('#pagePressed')).prop('offsetLeft');
                angular.element('#pointer').css('margin-top', -12);
                angular.element('#pointer').css('margin-left', position.left + 6);
                angular.element('#pointer').show();
                angular.element('#arrowCursor').hide();
                angular.element('#tooltip').hide();
                angular.element('#labelBlock').show();
            })
        }
    }
};
