<?php
/* @var $content*/
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php echo Config::getBaseUrl(); ?>/css/images/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'regform.css'); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo Config::getBaseUrl(); ?>/css/style.css"/>
    <script src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/jquery/dist/jquery.min.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/datatables/media/js/jquery.dataTables.min.js'); ?>"></script>
    <!-- lodash -->
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/lodash/lodash.min.js'); ?>"></script>

    <!-- Angular  -->
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/angular.min.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/angular-datatables.min.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/angular-ui-router.min.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/daypilot-all.min.js'); ?>"></script>

    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/angular-resource/angular-resource.min.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/checklist-model/checklist-model.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/ng-img-crop/compile/minified/ng-img-crop.js'); ?>"></script>
    <link href="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/ng-img-crop/compile/minified/ng-img-crop.css'); ?>" rel="stylesheet"/>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/angular-sanitize/angular-sanitize.min.js'); ?>"></script>

    <!-- Select multiple -->
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/select-tpls.min.js'); ?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/select.min.css') ?>">

    <!-- ngTable -->
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/ng-table/ng-table.min.js'); ?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/ng-table/ng-table.min.css') ?>">

    <!-- ngToast -->
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/ng-toast/ngToast.min.js'); ?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/ng-toast/ngToast.min.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/ng-toast/ngToast-animations.min.css') ?>">
    <!-- ngCkeditor -->
    <script src="<?php echo StaticFilesHelper::fullPathTo('js', 'ckeditor/ckeditor.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/ng-ckeditor.js'); ?>"></script>

    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/angular-bootstrap/ui-bootstrap-tpls-2.5.0.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/angular-locale_uk-ua.js'); ?>"></script>

    <script src="<?php echo StaticFilesHelper::fullPathTo('js', 'cabinet/authForm.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/paymentsSchemes.js'); ?>"></script>
    <script async type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/trimField.js"></script>
    <title><?php echo Yii::app()->name; ?></title>

    <link href="<?php echo StaticFilesHelper::fullPathTo('css', 'courseSchema.css'); ?>" rel="stylesheet">
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap-theme.css'); ?>" rel="stylesheet">
    <!-- Bootstrap Core CSS -->

    <!-- application less -->
    <link href="<?php echo StaticFilesHelper::fullPathTo('css', '_teacher/modal.less'); ?>" rel="stylesheet/less" type="text/css" />
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/less.min.js'); ?>"></script>

    <script>
        basePath = '<?=Config::getBaseUrl()?>';
        baseChatPath = '<?=Config::getFullChatPath()?>';
        var $jq = jQuery.noConflict();
    </script>

    <link href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <link href="<?php echo StaticFilesHelper::fullPathTo('css', '_teacher/main.css'); ?>" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/metisMenu/dist/metisMenu.min.css');?>" rel="stylesheet">
    <!-- Timeline CSS -->
    <link href="<?php echo StaticFilesHelper::fullPathTo('css', 'dist/css/timeline.css');?>" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo StaticFilesHelper::fullPathTo('css', 'dist/css/sb-admin-2.css');?>" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/morrisjs/morris.css');?>" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/font-awesome/css/font-awesome.min.css');?>" rel="stylesheet" type="text/css">

    <link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'roles.css'); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'jquery-ui.min.css') ?>"/>
    <!-- Angular datatable css -->
    <link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('angular', 'css/angular-datatables.css') ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('js', '/bootstrap-datetimepicker/css/bootstrap-datetimepicker.css'); ?>">
    <link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'consultations.css') ?>" />

    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/MathJax/MathJax.js?config=TeX-AMS-MML_HTMLorMML'); ?>"></script>
    <!--TeacherApp-->
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/app.js'); ?>"></script>

    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/crm/app.js'); ?>"></script>
    <?php if (!Yii::app()->user->isGuest) { ?>
        <script src="<?php echo Config::getBaseUrl()."/crmChat/js/ITA.js" ?>"></script>
    <?php } ?>
    <!--Angular directives-->
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/directives/cabinetDirectives.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/directives/ajaxLoader.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/directives/invoiceTable.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/directives/agreementDetailed.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/directives/operationsTable.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/directives/addExternalPayment.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/directives/findExternalPayment.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/directives/invoiceDetailed.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/directives/blockWindowLoader.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/directives/externalPaymentsTable.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/directives/internalPaymentsTable.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/directives/userSpecialOfferTable.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/directives/courseSpecialOfferTable.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/directives/moduleSpecialOfferTable.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/directives/defaultSchemasTable.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/directives/companyCard.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/directives/companyRepresentatives.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/directives/companyOneRepresentative.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/directives/companyServices.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/directives/accountant/organizationCourses.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/directives/companyCheckingAccounts.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/directives/companyOneCheckingAccount.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/directives/agreementTemplate.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/directives/customValidators.js'); ?>"></script>

    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/crm/directives/modalDirective.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/crm/directives/crmTaskDirective.js'); ?>"></script>

    <!--Angular routers-->
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/cabinetRouter.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/routers/adminRouter.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/routers/superAdminRouter.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/routers/directorRouter.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/routers/auditorRouter.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/routers/freeLecturesRouter.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/routers/authorRouter.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/routers/accountantRouter.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/routers/contentManagerRouter.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/routers/consultantRouter.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/routers/teacherConsultantRouter.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/routers/trainerRouter.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/routers/studentRouter.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/routers/tenantRouter.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/routers/messagesRouter.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/routers/modulesRouter.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/routers/sharedLinksRouter.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/routers/responseRouter.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/routers/graduatesRouter.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/routers/interfaceMessagesRouter.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/routers/siteConfigRouter.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/routers/requestsRouter.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/routers/superVisorRouter.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/routers/newsletterRouter.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/routers/schedulerTasks.js'); ?>"></script>

    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/crm/routers/crmRouter.js'); ?>"></script>

    <!--Angular controllers-->
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/controllers.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/controllers/adminRoleCtrl.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/controllers/accountantControllers.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/controllers/directorControllers.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/controllers/superAdminControllers.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/controllers/auditorControllers.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/controllers/freeLecturesController.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/controllers/contentManagerControllers.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/controllers/authorControllers.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/controllers/consultantControllers.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/controllers/teacherConsultantControllers.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/controllers/trainerControllers.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/controllers/studentControllers.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/controllers/tenantControllers.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/controllers/verifyContentController.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/controllers/moduleManageController.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/controllers/courseManageController.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/controllers/lectureController.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/controllers/sharedLinksController.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/controllers/graduatesController.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/controllers/responseController.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/controllers/interfaceMessagesController.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/controllers/usersController.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/controllers/sliderControllers.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/controllers/roleAttributesController.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/controllers/levelsController.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/controllers/siteConfigController.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/controllers/requestsController.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/controllers/paymentsCtrl.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/controllers/superVisorControllers.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/controllers/newsletterController.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/controllers/mailTemplatesController.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/controllers/teachersControllers.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/controllers/roleController.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/controllers/schedulerTasksController.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/controllers/careersControllers.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/controllers/addressControllers.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/controllers/specializationsControllers.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/controllers/calendarController.js'); ?>"></script>

    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/crm/controllers/tasksControllers.js'); ?>"></script>

    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/ngBootbox.min.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('js', 'CheckFile.js');?>"></script>

    <script  src="<?php echo StaticFilesHelper::fullPathTo('js', 'bootstrap-datetimepicker/js/bootstrap-datetimepicker.js'); ?>"></script>

    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/services/interceptorService.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/services/agreementsService.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/services/operationsService.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/services/invoicesService.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/services/graduatesService.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/services/interfaceMessagesService.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/services/userService.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/services/externalSourcesService.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/services/externalPaymentsService.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/services/levelsService.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/services/siteConfigService.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/services/typeaheadService.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/services/paymentSchemaService.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/services/usersService.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/services/responseService.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/services/teacherService.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/services/companiesService.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/services/internalPaymentsService.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/services/courseSpecialOfferService.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/services/moduleSpecialOfferService.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/services/userSpecialOfferService.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/services/defaultSchemasService.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/services/courseService.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/services/moduleService.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/services/superVisorService.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/services/roleAttributeService.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/services/roleService.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/services/studentService.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/services/careerService.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/services/teacherConsultantService.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/services/tagsService.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/services/accountantService.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/services/organizationService.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/services/cityService.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/services/trainerService.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/services/auditorService.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/services/translitService.js'); ?>"></script>

    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/crm/services/modalService.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/crm/services/taskServices.js'); ?>"></script>

    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/services/helpers/transformRequest.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/teacher/services/helpers/lodash.js'); ?>"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/loading-bar.min.js'); ?>"></script>
    <link rel='stylesheet' href="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/loading-bar.min.css'); ?>" type='text/css' media='all' />

</head>
    <body ng-app="teacherApp">
    <toast style="left:0px"></toast>

    <div id="contentBoxMain">
        <?php echo $content; ?>
    </div>
    <!--IntITAMessenger-->
        <?php if (!Yii::app()->user->isGuest) { ?>
            <div ita-messenger="" path="<?php echo Config::getFullChatPath() ?>" class="dnd-container"></div>
        <?php } ?>
    <!--IntITAMessenger-->
    </body>
</html>