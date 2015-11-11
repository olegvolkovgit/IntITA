angular
    .module('lessonEdit')
    .controller('CKEditorCtrl', CKEditorCtrl)

function CKEditorCtrl($compile, $scope, $http) {
    $scope.editorOptions = {
        language: lang
    };
    $scope.editorOptions1 = {
        language: lang
    };
    $scope.$on("ckeditor.ready", function (event) {
        $scope.isReady = true;
    });

    $scope.getBlockHtml = function (blockOrder, idLecture) {
        $http({
            url: '/lesson/editBlock',
            method: "POST",
            data: $.param({order: blockOrder, lecture: idLecture}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        })
            .success(function (response) {
                $scope.editRedactor = response;
            })
            .error(function () {
                alert($scope.errorMsg);
            })
    };
    $scope.save = function (order) {
        $http({
            url: '/lesson/saveBlock',
            method: "POST",
            data: $.param({content: $scope.editRedactor, idLecture: idLecture, order: order}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
        })
            .success(function () {
                alert($scope.saveMsg);
            })
            .error(function () {
                alert($scope.errorMsg);
            })
    };

    $scope.upBlock = function (idLecture, order) {
        $http({
            url: '/lesson/upElement',
            method: "POST",
            data: $.param({idLecture: idLecture, order: order}),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        })
            .success(function (scope) {
                $.fn.yiiListView.update('blocks_list', {
                    complete: function () {
                        var template = document.getElementById("blockList").innerHTML;
                        angular.element('#blockList').remove();
                        $scope.callMenu(template);
                        ($compile(template)(scope)).insertAfter(angular.element('#red'));
                        $scope.$apply();
                        alert(template);
                    }
                });
                alert('update');
            })
            .error(function () {
                alert('Error');
            })
    };
}

angular
    .module('lessonEdit')
    .directive('closeRedactor', function ($compile) {
        return {
            link: function (scope, element) {
                element.bind('click', function () {
                    var order = element.attr('id').substring(1);

                    angular.element('#t' + order).show();
                    angular.element('#openCKE' + order).remove();
                    angular.element('#buttons' + order).remove();

                    $.fn.yiiListView.update('blocks_list', {
                        complete: function () {
                            var template = angular.element('#blockList').html();
                            angular.element('#blockList').empty();
                            angular.element('#blockList').append(($compile(template)(scope)));
                        }
                    });
                });
            }
        };
    })
    .directive('editBlock', function ($compile) {
        return {
            link: function (scope, element) {
                element.bind('click', function () {
                    if (angular.element('.openCKE').length) {
                        alert(scope.editMsg);
                        return;
                    }
                    var orderBlock = element.attr('id').substring(1);
                    var template = '<textarea ng-cloak class="openCKE" ' +
                        'id="openCKE' + orderBlock + '" ng-init="editRedactor = getBlockHtml(' + orderBlock + ',' + idLecture + ');"  ' +
                        'ckeditor="editorOptions1" name="editor" ng-model="editRedactor">' +
                        '</textarea>' +
                        '<div id=buttons' + orderBlock + '><button ng-click="save(' + orderBlock + ')">{{saveBtn}}</button>' +
                        '<button close-redactor id=c' + orderBlock + '>{{closeBtn}}</button></div>';
                    ($compile(template)(scope)).insertAfter(element);
                    element.hide();
                });
            }
        };
    })
    .directive('upBlock', function ($compile, $http) {
        return {
            link: function (scope, element) {
                element.bind('click', function () {
                    var order = element.parent().attr('id').substring(1);
                    $http({
                        url: '/lesson/upElement',
                        method: "POST",
                        data: $.param({idLecture: idLecture, order: order}),
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                    })
                        .success(function () {
                            $.fn.yiiListView.update('blocks_list', {
                                complete: function () {
                                    var template = angular.element('#blockList').html();
                                    angular.element('#blockList').empty();
                                    angular.element('#blockList').append(($compile(template)(scope)));
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
                    var order = element.parent().attr('id').substring(1);
                    $http({
                        url: '/lesson/downElement',
                        method: "POST",
                        data: $.param({idLecture: idLecture, order: order}),
                        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                    })
                        .success(function () {
                            $.fn.yiiListView.update('blocks_list', {
                                complete: function () {
                                    var template = angular.element('#blockList').html();
                                    angular.element('#blockList').empty();
                                    angular.element('#blockList').append(($compile(template)(scope)));
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
    .directive('deleteBlock', function ($compile, $http) {
        return {
            link: function (scope, element) {
                element.bind('click', function () {
                    if (confirm(scope.deleteMsg)) {
                        var order = element.parent().attr('id').substring(1);
                        $http({
                            url: '/lesson/deleteElement',
                            method: "POST",
                            data: $.param({idLecture: idLecture, order: order}),
                            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                        })
                            .success(function () {
                                $.fn.yiiListView.update('blocks_list', {
                                    complete: function () {
                                        var template = angular.element('#blockList').html();
                                        angular.element('#blockList').empty();
                                        angular.element('#blockList').append(($compile(template)(scope)));
                                    }
                                });
                            })
                            .error(function () {
                                alert(scope.errorMsg);
                            });
                    }
                });
            }
        };
    });