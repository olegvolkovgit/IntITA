/**
 * Created by Quicks on 15.12.2015.
 */
angular
    .module('teacherApp', [
        'datatables',
        'ui.bootstrap',
        'ngBootbox',
        'directive.loading',
        'ngResource',
        'ngTable',
        'angular-loading-bar',
        
        'messagesRouter',
        'cabinetRouter', 
        'adminRouter',
        'authorRouter',
        'consultantRouter',
        'teacherConsultantRouter',
        'trainerRouter',
        'studentRouter',
        'tenantRouter',
        'accountantRouter',
        'contentManagerRouter',
        'modulesRouter',
        'graduatesRouter',
        'sharedLinksRouter',
        'responseRouter',
        'interfaceMessagesRouter'
    ]);