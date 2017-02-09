angular.module('IntITAMessenger', [])
    .controller('chat-controller', function($scope) {

        var busy = false;
        $scope.dragstart = function() {
            $scope.$apply(function() {
                busy = true;
            });
            console.log('dragstart', arguments);
            var res_elem = $('.draggable');
            res_elem.addClass("disable-animation");
            $("iframe").addClass("disable-mouse");
        };

        $scope.drag = function() {
            console.log('drag', arguments);
        };

        $scope.dragend = function() {
            console.log('dragend', arguments);
            if (!arguments[0]) this.dropped = false;
            var res_elem = $('.draggable');
            res_elem.removeClass("disable-animation");
            $("iframe").removeClass("disable-mouse");
            var res_elem = $('.draggable');
            localStorage.setItem("chatX", res_elem.css("left"));
            localStorage.setItem("chatY", res_elem.css("top"));

            $scope.$apply(function() {
                busy = false;
            });
        };

        $scope.dragenter = function(dropmodel) {
            console.log('dragenter', arguments);
            this.active = dropmodel;
        };

        $scope.dragover = function() {
            console.log('dragover', arguments);
        };

        $scope.dragleave = function() {
            console.log('dragleave', arguments);
            this.active = undefined;
        };

        $scope.drop = function(dragmodel, model) {
            console.log('drop', arguments);
            this.dropped = model;
        };

        $scope.isDropped = function(model) {
            return this.dropped === model;
        };

        $scope.isActive = function(model) {
            return this.active === model;
        };
        $scope.minimizeteMin = function() {
            if ($scope.state == 1 && busy == false) {
                $scope.state = 0;
                return;
            }
        }
        $scope.minimizete = function() {
            if ($scope.state == 1) {
                $scope.state = 0;
                return;
            }
            $scope.state = 1;
        }
        $scope.fullScreen = function() {
            if ($scope.state == 1) {
                $scope.state = 0;
                return;
            }
            if ($scope.state == 2) {
                $scope.state = 0;
                return;
            }
            $scope.state = 2;

        }

        function resizeFunc(e) {
            var elem = $(".dnd-container");
            var res_elem = $('.draggable');
            var offset = res_elem.position();
            if (elem.height() < offset.top + res_elem.height() || offset.top < 0) {
                res_elem.css({ top: (elem.height() - res_elem.height()) + 'px' });
            }
            if (elem.width() < offset.left + res_elem.width() || offset.left < 0) {
                res_elem.css({ left: (elem.width() - res_elem.width()) + 'px' });
            }
            localStorage.setItem("chatX", res_elem.css("left"));
            localStorage.setItem("chatY", res_elem.css("top"));
        }
        $(window).resize(resizeFunc);


        //  $(document).ready(resizeFunc);

        $(document).ready(function() {
            $scope.state = 0;
            var res_elem = $('.draggable');
            var x = localStorage.getItem("chatX");
            var y = localStorage.getItem("chatY");
            if (x == undefined || y == undefined) {
                var elem = $(".dnd-container");
                res_elem.css({ top: (elem.height() - 600) + 'px' });
                res_elem.css({ left: (elem.width() - 400) + 'px' });
            } else {
                res_elem.css({ top: y });
                res_elem.css({ left: x });
            }

            $scope.$apply(function() {

                $scope.$watch('state', function() {
                    localStorage.setItem("chatState", $scope.state);
                    var res_elem = $('.draggable');
                    if ($scope.state == 2) {
                        res_elem.removeClass("normal");
                    } else {
                        setTimeout(function() {
                            resizeFunc();
                            res_elem.addClass("normal");
                        }, 600);
                    }
                })

                if (localStorage.getItem("chatState") == undefined)
                {
                    $scope.state = 0;
                    $(".chat").removeClass("mini");
                }
                else {
                    $scope.state = parseInt(localStorage.getItem("chatState"));
                    if ($scope.state != 1) {
                        $(".chat").removeClass("mini");
                    }
                }
                $(".chat").draggable({ /*handle: ".handle"*/ cancel: ".ignore", containment: "parent", start: $scope.dragstart, stop: $scope.dragend });

                $scope.init = true;
            });

        });
    });
