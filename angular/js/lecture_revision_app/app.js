/**
 * Created by Wizlight on 04.12.2015.
 */
'use strict';

/* App Module */
angular
    .module('lectureRevisionApp', ['revisionServices','directive.loading']);

angular
    .module('lecturePreviewRevisionApp', ['ui.router','hljs','ui.codemirror','revisionServices','directive.loading','ipCookie','service.taskJson','revisionSendMessage']);

angular
    .module('revisionTreesApp', ['directive.loading','revisionSendMessage']);

angular
    .module('revisionEdit', ['ngCkeditor','ngBootbox','hljs','directive.loading','service.taskJson']);