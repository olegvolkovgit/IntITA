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
                    $('#pointer').css('margin-top', -12);
                    $('#pointer').css('margin-left', attrs.hoverSpot * 35 + 6);
                    $('#pointer').show();
                }
            });
            element.on("mouseenter", function () {
                var tooltipHtml = '<p>' + $(this).attr("title") + '</p>';
                if ($(this).is('.pageNoAccess')) {
                    tooltipHtml = '<p class="titleNoAccess">' + $(this).attr("title") + '<span class="noAccess"> (' + partNotAvailable + ')</span></p>';
                }
                $('#pointer').hide();
                $('#arrowCursor').show();
                $('#arrowCursor').css('margin-top', -12);
                $('#arrowCursor').css('margin-left', attrs.hoverSpot * 35 + 6);
                $('#tooltip').html(tooltipHtml);
                $('#labelBlock').hide();
                $('#tooltip').css('display', 'inline-block');
            });
            element.on("mouseleave", function () {
                var position = angular.element(document.querySelector('#pagePressed')).prop('offsetLeft');
                $('#pointer').css('margin-top', -12);
                $('#pointer').css('margin-left', position.left + 6);
                $('#pointer').show();
                $('#arrowCursor').hide();
                $('#tooltip').hide();
                $('#labelBlock').show();
            })
        }
    }
};
