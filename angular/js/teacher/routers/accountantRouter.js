/**
 * Created by adm on 19.07.2016.
 */

var accountantUrl = basePath + "/_teacher/_accountant/";

angular
  .module('accountantRouter', ['ui.router']).config(function ($stateProvider, $urlRouterProvider) {

    $stateProvider
        .state('accountant', {
            url: "/accountant",
            cache         : false,
            controller: function($scope){
                $scope.changePageHeader('Бухгалтер');
            },
            templateUrl: accountantUrl+"accountant/index"
        })
        .state('accountant/agreements', {
            url: "/accountant/agreements",
            cache         : false,
            templateUrl: accountantUrl+"agreements/index"
        })
        .state('accountant/agreement/', {
            url: "/accountant/agreement/{agreementId:[0-9]*}",
            cache         : false,
            templateUrl: function ($stateParams) {
                return accountantUrl + "agreements/agreement/id/"+$stateParams.agreementId
            }
        })
        .state('accountant/invoices', {
            url: "/accountant/invoices",
            cache         : false,
            templateUrl: accountantUrl+"invoices/index"
        })
        .state('accountant/invoice/', {
            url: "/accountant/invoice/{invoiceId:[0-9]*}",
            cache         : false,
            templateUrl: accountantUrl+"invoices/invoice"
        })
        .state('accountant/operation', {
            url: "/accountant/operation",
            cache         : false,
            templateUrl: accountantUrl+"operation/index/"
        })
        .state('accountant/operation/create', {
            url: "/accountant/operation/create",
            cache         : false,
            templateUrl: accountantUrl+"operation/create/"
        })
        .state('accountant/company', {
            url: "/accountant/company",
            controller: 'companiesCtrl',
            cache         : false,
            templateUrl: accountantUrl+"company/index"
        })
        .state('accountant/representative', {
            url: "/accountant/representative",
            controller: 'representativesCtrl',
            cache         : false,
            templateUrl: accountantUrl+"representative/index"
        })
        .state('accountant/externalsources', {
            url: "/accountant/externalsources",
            cache         : false,
            templateUrl: accountantUrl+"externalSources/index"
        })
        .state('accountant/cancelreasontype', {
            url: "/accountant/cancelreasontype",
            cache         : false,
            templateUrl: accountantUrl+"cancelReasonType/index"
        })
        .state('accountant/addcompany', {
            url: "/accountant/addcompany",
            controller: 'oneCompanyCtrl',
            cache         : false,
            templateUrl: basePath + '/angular/js/teacher/templates/accountancy/company/oneCompany.html'
        })
        .state('accountant/addRepresentative', {
            url: "/accountant/addRepresentative",
            controller: 'oneRepresentativeCtrl',
            cache         : false,
            templateUrl: accountantUrl+"representative/renderAddForm"
        })
        .state('accountant/viewCompany', {
            url: "/accountant/viewCompany/{companyId:[0-9]*}",
            params : {
              activeTab : 0,
              header : 'Компанія'
            },
            controller: 'oneCompanyCtrl',
            cache         : false,
            templateUrl: basePath + '/angular/js/teacher/templates/accountancy/company/oneCompany.html'
        })
        .state('accountant/viewCompany/representatives', {
            url: "/accountant/viewCompany/{companyId:[0-9]*}/representatives",
            params : {
              activeTab : 1,
              header : 'Представники компанії'
            },
            controller: 'oneCompanyCtrl',
            cache         : false,
            templateUrl: basePath + '/angular/js/teacher/templates/accountancy/company/oneCompany.html'
        })
        .state('accountant/viewCompany/representatives/add', {
            url: "/accountant/viewCompany/{companyId:[0-9]*}/representatives/add",
            params : {
              activeTab : 3,
              header : 'Додати представника'
            },
            controller: 'oneCompanyCtrl',
            cache         : false,
            templateUrl: basePath + '/angular/js/teacher/templates/accountancy/company/oneCompany.html'
        })
        .state('accountant/viewCompany/representative/edit', {
            url: "/accountant/viewCompany/{companyId:[0-9]*}/representative/edit/{representativeId:[0-9]*}",
            params : {
              activeTab : 2,
              header : 'Редагувати представника'
            },
            controller: 'oneCompanyCtrl',
            cache         : false,
            templateUrl: basePath + '/angular/js/teacher/templates/accountancy/company/oneCompany.html'
        })
        .state('accountant/viewRepresentative/:id', {
            url: "/accountant/viewRepresentative/:id",
            controller: 'oneRepresentativeCtrl',
            cache         : false,
            templateUrl: function ($stateParams) {
                return accountantUrl+"representative/viewRepresentative/?id="+$stateParams.id;
            }
        })
        .state('accountant/paymentSchemas/schemas/template', {
            url: '/accountant/paymentSchemas/schemas/template',
            cache         : false,
            templateUrl: accountantUrl+"paymentSchema/schemasTemplates"
        })
        .state('accountant/paymentSchemas/schemas/apply', {
            url: '/accountant/paymentSchemas/schemas/apply',
            cache         : false,
            templateUrl: accountantUrl+"paymentSchema/applyTemplateView"
        })
        .state('accountant/paymentSchemas/schemas/appliedTemplates', {
            url: '/accountant/paymentSchemas/schemas/appliedTemplates',
            cache         : false,
            templateUrl: accountantUrl+"paymentSchema/appliedTemplatesList"
        })
        .state('accountant/paymentSchemas/schemas/template/:id', {
            url: '/accountant/paymentSchemas/schemas/template/:id',
            cache         : false,
            templateUrl: function ($stateParams) {
                return accountantUrl+"paymentSchema/viewSchemasTemplate/?id="+$stateParams.id;
            }
        })
        .state('accountant/paymentSchemas/schemas/createTemplate', {
            url: '/accountant/paymentSchemas/schemas/createTemplate',
            cache         : false,
            templateUrl: accountantUrl+"paymentSchema/templateCreate"
        })
        .state('accountant/externalsource/create', {
            url: "/accountant/externalsource/create",
            cache         : false,
            controller: function($scope){
                $scope.changePageHeader('Додати зовнішнє джерело коштів');
            },
            templateUrl: accountantUrl+"externalSources/create"
        })
        .state('accountant/externalsource/update/:id', {
            url: "/accountant/externalsource/update/:id",
            cache         : false,
            controller: function($scope){
                $scope.changePageHeader('Редагувати зовнішнє джерело коштів');
            },
            templateUrl: function ($stateParams) {
                return accountantUrl + "externalSources/update/id/" + $stateParams.id;
            }
        })
        .state('accountant/externalsource/view/:id', {
            url: "/accountant/externalsource/view/:id",
            cache         : false,
            controller: function($scope,$stateParams){
                $scope.changePageHeader('Джерело зовнішніх коштів №'+$stateParams.id);
            },
            templateUrl: function ($stateParams) {
                return accountantUrl+"externalSources/view/id/"+$stateParams.id;
            }
        })
        .state('accountant/documents', {
            url: "/accountant/documents",
            cache         : false,
            templateUrl: accountantUrl+"accountant/usersDocuments"
        })
        .state('accountant/paymentSchemas/schemas/displaypromotion', {
            url: '/accountant/paymentSchemas/schemas/displaypromotion',
            cache         : false,
            templateUrl: accountantUrl+"paymentSchema/displayPromotionSchemes"
        })
        .state('accountant/paymentSchemas/schemas/displaypromotionlist', {
            url: '/accountant/paymentSchemas/schemas/displaypromotionlist',
            cache         : false,
            templateUrl: accountantUrl+"paymentSchema/displayPromotionSchemesList"
        })
        .state('accountant/paymentSchemas/schemas/promotionupdate/:id', {
            url: "/accountant/paymentSchemas/schemas/promotionupdate/:id",
            cache         : false,
            controller: function($scope){
                $scope.changePageHeader('Редагувати зовнішнє джерело коштів');
            },
            templateUrl: function ($stateParams) {
                return accountantUrl+"paymentSchema/promotionupdate/id/" + $stateParams.id;
            }
        })
        .state('accountant/schemesrequests', {
            url: "/accountant/schemesrequests",
            cache         : false,
            templateUrl: accountantUrl+"paymentSchema/schemesrequests"
        })
        .state('accountant/paymentSchemas/schemas/apply/request/:request', {
            url: "/accountant/paymentSchemas/schemas/apply/request/:request",
            cache         : false,
            templateUrl: function ($stateParams) {
                return accountantUrl + "paymentSchema/applyTemplateView/request/" + $stateParams.request;
            }
        })
        .state('student/:studentId/agreements', {
            url: "/student/:studentId/agreements",
            cache: false,
            templateUrl: function ($stateParams) {
                return basePath + "/_teacher/_accountant/agreements/renderUserAgreements/idUser/"+$stateParams.studentId;
            }
        })
    }
);
