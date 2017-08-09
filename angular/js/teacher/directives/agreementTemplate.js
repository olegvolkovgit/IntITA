angular
    .module('teacherApp')
    .directive('compile', ['$compile', function ($compile) {
        return function(scope, element, attrs) {
            scope.$watch(
                function(scope) {
                    // watch the 'compile' expression for changes
                    return scope.$eval(attrs.compile);
                },
                function(value) {
                    // when the 'compile' expression changes
                    // assign it into the current DOM
                    element.html(value);

                    // compile the new DOM and link it to the current
                    // scope.
                    // NOTE: we only compile .childNodes so that
                    // we don't get into infinite loop compiling ourselves
                    $compile(element.contents())(scope);
                }
            );
        };
    }])

    .directive('aNumber', function() {
        return {
            template: '{{writtenAgreement.agreement.number}}'
        };
    })
    .directive('aDate', function() {
        return {
            template: '{{date | date}}'
        };
    })
    .directive('aDescription', function() {
        return {
            template: '{{writtenAgreement.agreement.service.description}}'
        };
    })
    .directive('aSumma', function() {
        return {
            template: '{{writtenAgreement.agreement.summa}}'
        };
    })
    .directive('aInvoices', function() {
        return {
            template: '<span ng-repeat="invoice in writtenAgreement.agreement.invoice track by $index">'+
            'платіж №{{$index+1}} : сума {{invoice.summa}} без ПДВ до дати {{invoice.payment_date | limitTo: 10}}<br></span>'
        };
    })

    .directive('uUserDoc', function() {
        return {
            template: '<span ng-repeat="document in writtenAgreement.documents track by $index">'+
            '<span ng-if="document.type==1">{{document.last_name}} {{document.first_name}} {{document.middle_name}}, {{document.documentType.title_ua | lowercase}} {{document.number}} виданий {{document.issued}} {{document.issued_date}}, </span>'+
            '<span ng-if="document.type==2">{{document.documentType.title_ua | lowercase}} {{document.number}}, </span></span>'
        };
    })
    .directive('uUserDataAddress', function() {
        return {
            template: '<span ng-repeat="document in writtenAgreement.documents track by $index">'+
            '<span ng-if="document.type==1">{{document.last_name}} {{document.first_name}} {{document.middle_name}}, ' +
            '{{document.registration_address}}</span></span>'
        };
    })
    .directive('uName', function() {
        return {
            template: '<span ng-repeat="document in writtenAgreement.documents track by $index"><span ng-if="document.type==1">' +
            '{{document.last_name}} {{document.first_name}} {{document.middle_name}}</span></span>'
        };
    })

    .directive('cTitle', function() {
        return {
            template: '{{writtenAgreement.agreement.corporateEntity.title}}'
        };
    })
    .directive('cRepresentativesData', function() {
        return {
            template: '<span ng-repeat="resprsentative in writtenAgreement.agreement.corporateEntity.actualRepresentatives track by $index">' +
            '{{resprsentative.position_accusative | lowercase}} {{resprsentative.representative.full_name_accusative}}, </span>'
        };
    })
    .directive('cEdpnou', function() {
        return {
            template: '{{writtenAgreement.agreement.corporateEntity.EDPNOU}}'
        };
    })
    .directive('cCheckingAccount', function() {
        return {
            template: '{{writtenAgreement.agreement.corporateEntity.latestCheckingAccount.checking_account}}'
        };
    })
    .directive('cBankName', function() {
        return {
            template: '{{writtenAgreement.agreement.corporateEntity.latestCheckingAccount.bank_name}}'
        };
    })
    .directive('cBankCode', function() {
        return {
            template: '{{writtenAgreement.agreement.corporateEntity.latestCheckingAccount.bank_code}}'
        };
    })
    .directive('cLegalAddress', function() {
        return {
            template: '{{writtenAgreement.agreement.corporateEntity.legal_address}}'
        };
    })
    .directive('cContacts', function() {
        return {
            template: '{{writtenAgreement.agreement.corporateEntity.contacts}}'
        };
    })

    .directive('cRepresentativesPositionName', function() {
        return {
            template: '<p ng-repeat="resprsentative in writtenAgreement.agreement.corporateEntity.actualRepresentatives track by $index">' +
            '{{resprsentative.position}}_________________/{{resprsentative.representative.full_name_short}}/</p>'
        };
    })


