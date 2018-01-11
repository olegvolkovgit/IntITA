'use strict';

(function (angular, factory) {
    if (typeof define === 'function' && define.amd) {
        define(['angular', 'ckeditor'], function (angular) {
            return factory(angular);
        });
    } else {
        return factory(angular);
    }
}(angular || null, function (angular) {
    var app = angular.module('ngCkeditor', ['ngBootbox']);
    var $defer, loaded = false;

    app.run(['$q', '$timeout', function ($q, $timeout) {
        $defer = $q.defer();

        if (angular.isUndefined(CKEDITOR)) {
            throw new Error('CKEDITOR not found');
        }
        CKEDITOR.disableAutoInline = true;
        function checkLoaded() {
            if (CKEDITOR.status === 'loaded') {
                loaded = true;
                $defer.resolve();
            } else {
                checkLoaded();
            }
        }

        CKEDITOR.on('loaded', checkLoaded);
        $timeout(checkLoaded, 100);
    }]);

    app.directive('ckeditor', ['$timeout', '$q', '$http','$compile', '$ngBootbox', function ($timeout, $q, $http, $compile, $ngBootbox) {

        return {
            restrict: 'AC',
            require: ['ngModel', '^?form'],
            scope: false,
            link: function (scope, element, attrs, ctrls) {
                var ngModel = ctrls[0];
                var form = ctrls[1] || null;
                var EMPTY_HTML = '<p></p>',
                    isTextarea = element[0].tagName.toLowerCase() === 'textarea',
                    data = [],
                    isReady = false;

                if (!isTextarea) {
                    element.attr('contenteditable', true);
                }

                var onLoad = function () {
                    var options = {
                        toolbar: 'full',
                        toolbar_full: [ //jshint ignore:line
                            { name: 'saveClose', items : [ 'customSave','close' ] },
                            '/',
                            { name: 'document', items : [ 'Source','-' ] },
                            { name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
                            { name: 'editing', items : [ ] },
                            { name: 'forms', items : [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'HiddenField' ] },
                            { name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
                            { name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
                            { name: 'links', items : [ 'Link','Unlink','Anchor' ] },
                            { name: 'insert', items : [ 'Mathjax','EqnEditor','Image','Table','HorizontalRule','SpecialChar','PageBreak' ] },
                            { name: 'styles', items : [ 'Font','FontSize' ] },
                            { name: 'colors', items : [ 'TextColor','BGColor' ] },
                            { name: 'tools', items : [ 'Maximize', 'ShowBlocks'] }
                        ],
                        toolbar_task: [ //jshint ignore:line
                            { name: 'document', items : [ 'Source','-' ] },
                            { name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
                            { name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
                            { name: 'paragraph', items : [ 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'] },
                            { name: 'links', items : [ 'Link','Unlink'] },
                            { name: 'insert', items : [ 'Mathjax','EqnEditor','Image','Youtube','Table','HorizontalRule','SpecialChar'] },
                            { name: 'styles', items : [ 'Font','FontSize' ] },
                            { name: 'colors', items : [ 'TextColor','BGColor' ] },
                        ],
                        toolbar_answer: [ //jshint ignore:line
                            { name: 'document', items : [ 'Source','-' ] },
                            { name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
                            { name: 'paragraph', items : [ 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'] },
                            { name: 'links', items : [ 'Link','Unlink'] },
                            { name: 'insert', items : [ 'Mathjax','EqnEditor','SpecialChar'] },
                            { name: 'styles', items : [ 'Font','FontSize' ] },
                            { name: 'colors', items : [ 'TextColor','BGColor' ] },
                        ],
                        toolbar_skipTask: [ //jshint ignore:line
                            { name: 'document', items : [ 'Source','-' ] },
                            { name: 'colors', items : [ 'skipWord1' ] },
                            { name: 'colors', items : [ 'skipWord0' ] },
                            { name: 'colors', items : [ 'RemoveFormat' ] },

                        ],
                        toolbar_agreement: [
                            { name: 'document', items : [ 'Source','-' ] },
                            { name: 'basicstyles', items : [ 'Table','Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
                            { name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','RightSpan','-','BidiLtr','BidiRtl' ] },
                            { name: 'styles', items : [ 'Font','FontSize' ] },
                            '/',
                            { name: 'agreement', items : [ 'a_number','a_date','a_description','a_summa','a_invoices','a_service_hours','a_sum_string'] },
                            '/',
                            { name: 'user', items : [ 'u_user_passport','u_user_passport_issued','u_user_passport_date','u_user_inn','u_user_data_address','u_name','u_user_phone','u_user_email'] },
                            // '/',
                            { name: 'corporate', items : [ 'c_title','c_representative_position','c_representative_position_accusative','c_representative_name_accusative','c_representative_short_name',
                                'c_representative_name','c_edpnou','c_checking_account','c_bank_name', 'c_bank_code','c_legal_address','c_contacts',
                                'c_license','c_license_issued','c_license_issued_date'] },
                        ],
                        toolbar_main: [ //jshint ignore:line
                            { name: 'document', items : [ 'Source','-' ] },
                            { name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
                            { name: 'editing', items : [ ] },
                            { name: 'forms', items : [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'HiddenField' ] },
                            { name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
                            { name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
                            { name: 'links', items : [ 'Link','Unlink','Anchor' ] },
                            { name: 'insert', items : [ 'Image','Table','HorizontalRule','SpecialChar','PageBreak' ] },
                            { name: 'styles', items : [ 'Font','FontSize' ] },
                            { name: 'colors', items : [ 'TextColor','BGColor' ] },
                        ],
                    };
                    options = angular.extend(options, scope[attrs.ckeditor]);

                    var instance = (isTextarea) ? CKEDITOR.replace(element[0], options) : CKEDITOR.inline(element[0], options),
                        configLoaderDef = $q.defer();

                    element.bind('$destroy', function () {
                        if (instance && CKEDITOR.instances[instance.name]) {
                            CKEDITOR.instances[instance.name].destroy();
                        }
                    });
                    var setModelData = function (setPristine) {
                        var data = instance.getData();
                        if (data === '') {
                            data = null;
                        }
                        $timeout(function () { // for key up event
                            if (setPristine !== true || data !== ngModel.$viewValue) {
                                ngModel.$setViewValue(data);
                            }

                            if (setPristine === true && form) {
                                form.$setPristine();
                            }
                        }, 0);
                    }, onUpdateModelData = function (setPristine) {
                        if (!data.length) {
                            return;
                        }

                        var item = data.pop() || EMPTY_HTML;
                        isReady = false;
                        instance.setData(item, function () {
                            setModelData(setPristine);
                            isReady = true;
                        });
                    };

                    //instance.on('pasteState',   setModelData);
                    instance.on('change', setModelData);
                    instance.on('blur', setModelData);
                    //instance.on('key',          setModelData); // for source view

                    instance.on('instanceReady', function () {
                        scope.$broadcast('ckeditor.ready');
                        scope.$apply(function () {
                            onUpdateModelData(true);
                        });

                        instance.document.on('keyup', setModelData);
                    });
                    //custom save
                    instance.addCommand("customSave", {
                        exec: function() {
                            // id=openCKE**** - 7-position *
                            var idEl = element.attr('id').substring(7);
                            $http({
                                url: basePath+'/revision/editLectureElement',
                                method: "POST",
                                data: $.param({html_block: scope.editRedactor, idElement: idEl,
                                    idRevision: idRevision, idPage: idPage}),
                                headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'}
                            })
                                .success(function (response) {
                                    if(response.length==0){
                                        scope.editSaving=true;
                                        $ngBootbox.alert(scope.saveMsg)
                                            .then(function() {
                                            });
                                    } else {
                                        $ngBootbox.alert(response)
                                            .then(function() {
                                            });
                                    }
                                })
                                .error(function () {
                                    alert(scope.errorMsg);
                                })
                        }
                    });

                    instance.ui.addButton('customSave', {
                        label: "Save",
                        command: 'customSave',
                        toolbar: 'tools',
                        icon: 'plugins/save.png'
                    });
                    //custom save
                    //custom close
                    instance.addCommand("customClose", {
                        exec: function() {
                            // id=openCKE**** - 7-position *
                            var order = element.attr('id').substring(7);

                            angular.element('#t' + order).show();
                            angular.element('#openCKE' + order).remove();
                            angular.element('#buttons' + order).remove();

                            $.fn.yiiListView.update('blocks_list', {
                                complete: function () {
                                    var template = angular.element('#blockList').html();
                                    angular.element('#blockList').empty();
                                    angular.element('#blockList').append(($compile(template)(scope)));
                                    setTimeout(function() {
                                        MathJax.Hub.Queue(["Typeset",MathJax.Hub]);
                                    });
                                }
                            });
                        }
                    });

                    instance.ui.addButton('close', {
                        label: "close",
                        command: 'customClose',
                        toolbar: 'tools',
                        icon: 'plugins/close.png'
                    });
                    //custom close
                    instance.on('customConfigLoaded', function () {
                        configLoaderDef.resolve();
                    });

                    ngModel.$render = function () {
                        data.push(ngModel.$viewValue);
                        if (isReady) {
                            onUpdateModelData();
                        }
                    };
                };

                if (CKEDITOR.status === 'loaded') {
                    loaded = true;
                }
                if (loaded) {
                    onLoad();
                } else {
                    $defer.promise.then(onLoad);
                }
            }
        };
    }])
    app.directive('crmCkeditor', ['$timeout', '$q', '$http','$compile', '$ngBootbox', function ($timeout, $q, $http, $compile, $ngBootbox) {

        return {
            restrict: 'AC',
            require: ['ngModel', '^?form'],
            scope: false,
            link: function (scope, element, attrs, ctrls) {
                var ngModel = ctrls[0];
                var form = ctrls[1] || null;
                var EMPTY_HTML = '<p></p>',
                    isTextarea = element[0].tagName.toLowerCase() === 'textarea',
                    data = [],
                    isReady = false;

                if (!isTextarea) {
                    element.attr('contenteditable', true);
                }

                var onLoad = function () {
                    var options = {
                        toolbar: 'main',
                        toolbar_main: [ //jshint ignore:line
                            { name: 'document', items : [ 'Source','-' ] },
                            { name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
                            { name: 'editing', items : [ ] },
                            { name: 'forms', items : [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'HiddenField' ] },
                            { name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
                            { name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
                            { name: 'links', items : [ 'Link','Unlink','Anchor' ] },
                            { name: 'insert', items : [ 'Image','Table','HorizontalRule','SpecialChar','PageBreak' ] },
                            { name: 'styles', items : [ 'Font','FontSize' ] },
                            { name: 'colors', items : [ 'TextColor','BGColor','mentions'] },
                        ],
                    };
                    options = angular.extend(options, scope[attrs.ckeditor]);

                    initMention(jQuery(element[0]).attr('id'),'@',2);
                    // initMention(jQuery(element[0]).attr('id'),'#',3);
                    initUsers(jQuery(element[0]).attr('id'));
                    initTasks(jQuery(element[0]).attr('id'));

                    var instance = (isTextarea) ? CKEDITOR.replace(element[0], options) : CKEDITOR.inline(element[0], options),
                        configLoaderDef = $q.defer();

                    element.bind('$destroy', function () {
                        if (instance && CKEDITOR.instances[instance.name]) {
                            CKEDITOR.instances[instance.name].destroy();
                        }
                    });
                    var setModelData = function (setPristine) {
                        var data = instance.getData();
                        if (data === '') {
                            data = null;
                        }
                        $timeout(function () { // for key up event
                            if (setPristine !== true || data !== ngModel.$viewValue) {
                                ngModel.$setViewValue(data);
                            }

                            if (setPristine === true && form) {
                                form.$setPristine();
                            }
                        }, 0);
                    }, onUpdateModelData = function (setPristine) {
                        if (!data.length) {
                            return;
                        }

                        var item = data.pop() || EMPTY_HTML;
                        isReady = false;
                        instance.setData(item, function () {
                            setModelData(setPristine);
                            isReady = true;
                        });
                    };

                    //instance.on('pasteState',   setModelData);
                    instance.on('change', setModelData);
                    instance.on('blur', setModelData);
                    //instance.on('key',          setModelData); // for source view

                    instance.on('instanceReady', function () {
                        scope.$broadcast('ckeditor.ready');
                        scope.$apply(function () {
                            onUpdateModelData(true);
                        });
                        instance.document.on('keyup', setModelData);
                        // instance.on('key', function (e) { getContentLists(e.data.domEvent.$.key, instance)});
                    });

                    ngModel.$render = function () {
                        data.push(ngModel.$viewValue);
                        if (isReady) {
                            onUpdateModelData();
                        }
                    };
                };

                function getContentLists(key, instance) {
                    if(key=='#'){
                        instance.insertHtml('<select id="hash-tasks"></select>');
                        $jq("#hash-tasks").select2({
                            ajax: {
                                url:  basePath+"/_teacher/crm/_tasks/tasks/getTasksList",
                                dataType: 'json',
                                delay: 250,
                                data: function (params) {
                                    return {
                                        q: params.term, // search term
                                    };
                                },
                                processResults: function (data, params) {
                                    // parse the results into the format expected by Select2
                                    // since we are using custom formatting functions we do not need to
                                    // alter the remote JSON data, except to indicate that infinite
                                    // scrolling can be used
                                    return {
                                        results: data.items,
                                    };
                                },
                                cache: true
                            },
                            placeholder: 'завдання',
                            escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
                            templateResult: formatRepo,
                            templateSelection: formatRepoSelection
                        });
                    }else if(key=='@'){
                        console.log('Users list');
                    }
                }

                function formatRepo (repo) {
                    if (repo.loading) {
                        return repo.name;
                    }
                    return repo.name;
                }

                function formatRepoSelection (repo) {
                    return repo.name || repo.text;
                }

                if (CKEDITOR.status === 'loaded') {
                    loaded = true;
                }
                if (loaded) {
                    onLoad();
                } else {
                    $defer.promise.then(onLoad);
                }
            }
        };
    }]);

    return app;
}));

(function() {
    CKEDITOR.keystrokeHandler.prototype = {
        attach: function(domObject) {
            //domObject.on( 'keydown', onInputBoxKeyDown, this );
            domObject.on('keypress', window.onInputBoxKeyPress, this);
        }
    };
})();