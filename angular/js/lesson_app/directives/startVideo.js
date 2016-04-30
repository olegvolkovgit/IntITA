/**
 * Created by Wizlight on 06.02.2016.
 */
angular
    .module('lessonApp')
    .directive('startVideo', startVideo);

function startVideo() {
    return {
        link: function (scope, element, attrs) {
            element.on("mouseenter", function () {
                $('.startVideoHover').css('opacity',1);
            });
            element.on("mouseleave", function () {
                $('.startVideoHover').css('opacity',0);
            });
            element.on("click", function () {
                element.html(attrs.startVideo);


              
            })
        }
    }
};
