/**
 * Created by Wizlight on 06.01.2016.
 */
angular
    .module('lessonEdit')
    .directive('editBlock', function ($compile, $ngBootbox) {
        return {
            link: function (scope, element) {
                element.bind('click', function () {
                    if (angular.element('.openCKE').length) {
                        $ngBootbox.alert(scope.editMsg)
                            .then(function() {
                            });
                        return;
                    }
                    var idEl = element.attr('id').substring(1);
                    scope.getBlockHtml(idEl, element);
                    element.hide();
                });
            }
        };
    })
    .directive('editCode', function ($compile, $ngBootbox) {
        return {
            link: function (scope, element) {
                element.bind('click', function () {
                    if (angular.element('.openCKE').length) {
                        $ngBootbox.alert(scope.editMsg)
                            .then(function() {
                            });
                        return;
                    }
                    var idEl = element.attr('id').substring(1);
                    scope.getCodeHtml(idEl, element);
                    element.hide();
                });
            }
        };
    })
    .directive('upBlock', function ($compile, $http) {
        return {
            link: function (scope, element) {
                element.bind('click', function () {
                    var idEl = element.parent().attr('id').substring(1);
                    $http({
                        url: basePath + '/revision/upLectureElement',
                        method: "POST",
                        data: $.param({idElement:idEl, idPage:idPage, idRevision: idRevision}),
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                    })
                        .success(function () {
                            $.fn.yiiListView.update('blocks_list', {
                                complete: function () {
                                    var template = angular.element('#blockList').html();
                                    angular.element('#blockList').empty();
                                    angular.element('#blockList').append(($compile(template)(scope)));
                                    setTimeout(function () {
                                        MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
                                    });
                                }
                            });
                        })
                        .error(function () {
                            alert(scope.errorMsg);
                        });
                });
            }
        };
    })
    .directive('downBlock', function ($compile, $http) {
        return {
            link: function (scope, element) {
                element.bind('click', function () {
                    var idEl = element.parent().attr('id').substring(1);
                    $http({
                        url: basePath + '/revision/downLectureElement',
                        method: "POST",
                        data: $.param({idElement:idEl, idPage:idPage, idRevision: idRevision}),
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                    })
                        .success(function () {
                            $.fn.yiiListView.update('blocks_list', {
                                complete: function () {
                                    var template = angular.element('#blockList').html();
                                    angular.element('#blockList').empty();
                                    angular.element('#blockList').append(($compile(template)(scope)));
                                    setTimeout(function () {
                                        MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
                                    });
                                }
                            });
                        })
                        .error(function () {
                            alert(scope.errorMsg);
                        });
                });
            }
        };
    })
    .directive('deleteBlock', function ($compile, $http, $ngBootbox) {
        return {
            link: function (scope, element) {
                element.bind('click', function () {
                    $ngBootbox.confirm(scope.deleteMsg)
                        .then(function() {
                            var idEl = element.parent().attr('id').substring(1);
                            $http({
                                url: basePath + '/revision/deleteLectureElement',
                                method: "POST",
                                data: $.param({idElement:idEl, idPage:idPage, idRevision: idRevision}),
                                headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                            })
                                .success(function () {
                                    $.fn.yiiListView.update('blocks_list', {
                                        complete: function () {
                                            var template = angular.element('#blockList').html();
                                            angular.element('#blockList').empty();
                                            angular.element('#blockList').append(($compile(template)(scope)));
                                            setTimeout(function () {
                                                MathJax.Hub.Queue(["Typeset", MathJax.Hub]);
                                            });
                                        }
                                    });
                                })
                                .error(function () {
                                    alert(scope.errorMsg);
                                });
                        }, function() {
                        });
                });
            }
        };
    });