'use strict';

/* Services */

angular
    .module('mainApp')
    .service('documentsServices', ['$resource', 'transformRequest',
        function($resource, transformRequest) {
            return $resource(
                '',
                {
                },
                {
                    getDocumentsTypes: {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        url: basePath + "/studentreg/getDocumentsTypes",
                        isArray: true,
                    },
                    saveData: {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        url: basePath + "/studentreg/saveDocumentData",
                        transformRequest : transformRequest.bind(null)
                    },
                    getAllUserDocuments: {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        url: basePath + "/studentreg/getAllUserDocuments",
                        isArray: true,
                    },
                    getEditableDocument: {
                        method: 'POST',
                        headers: {'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'},
                        url: basePath + "/studentreg/getEditableDocument",
                        transformRequest : transformRequest.bind(null)
                    },
                }
            );
        }
    ]);