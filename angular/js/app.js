'use strict';

/* App Module */
angular
    .module('lessonApp', ['ui.bootstrap', 'ngRoute','ipCookie']);
angular
    .module('mainApp', ['mainApp.directives','ui.bootstrap','oi.select','ngResource','paymentsSchemes.directives']);