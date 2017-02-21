'use strict';

/* App Module */
angular
    .module('courseRevisionsApp', ['courseRevisionServices','courseRevisionSendMessage']);

angular
    .module('lectureRevisionApp', ['revisionServices','service.revisionsActions']);

angular
    .module('lecturePreviewRevisionApp', [
            'ui.router','hljs','ui.codemirror','revisionServices','ipCookie','service.taskJson','revisionSendMessage','service.revisionsActions'
    ]);

angular
    .module('revisionTreesApp', ['revisionSendMessage','service.revisionsActions']);

angular
    .module('revisionEdit', ['ngCkeditor','ngBootbox','hljs','service.taskJson','revisionServices']);

angular
    .module('moduleRevisionsApp', ['moduleRevisionServices','angular-loading-bar','moduleRevisionSendMessage']);

// General app
angular
    .module('revisionApp', [
            'courseRevisionsApp',
            'lectureRevisionApp',
            'lecturePreviewRevisionApp',
            'revisionTreesApp',
            'revisionEdit',
            'moduleRevisionsApp',
            'chatIntITAMessenger',
            'angular-loading-bar'
    ]);