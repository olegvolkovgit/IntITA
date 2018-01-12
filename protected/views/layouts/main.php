
<?php
/* @var $this Controller */
$header = new Header();
?>
<!DOCTYPE html>
<html id="ng-app" ng-app="mainApp" xmlns:ng="https://angularjs.org">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="en">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="<?php echo Config::getBaseUrl(); ?>">
    <meta name="twitter:image"
          content="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'intitaLogo.jpg'); ?>">
    <meta property="og:image"
          content="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'intitaLogo.jpg'); ?>">
    <!-- for tabs -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- fonts -->
    <link rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'fontface.css'); ?>"/>
    <!-- fonts -->
    <!-- layouts style -->
    <link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'style.css') ?>"/>
    <link rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'regform.css');; ?>"/>
    <!--   hamburger menu style -->
    <link rel="stylesheet" type="text/css"
          href="<?php echo StaticFilesHelper::fullPathTo('css', 'hamburgerMenu.css'); ?>"/>
    <link rel="shortcut icon" href="<?php echo StaticFilesHelper::fullPathTo('css', 'images/favicon.ico'); ?>"
          type="image/x-icon"/>
    <script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'openDialog.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'jquery.min.js'); ?>"></script>
    <!-- trimEmail-->
    <script async src="<?php echo StaticFilesHelper::fullPathTo('js', 'trimField.js'); ?>"></script>
    <!-- trimEmail -->
    <!-- pdf generator -->
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/jspdf/dist/jspdf.min.js'); ?>"></script>
    <!-- for tabs -->
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/angular.min.js'); ?>"></script>

    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/angular-touch/angular-touch.min.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/angular-carousel/dist/angular-carousel.min.js'); ?>"></script>
    <link href="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/angular-carousel/dist/angular-carousel.min.css'); ?>" rel="stylesheet"/>

    <script src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/bootbox.min.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/angular-file-upload/dist/angular-file-upload.min.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/ng-img-crop/compile/minified/ng-img-crop.js'); ?>"></script>
    <link href="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/ng-img-crop/compile/minified/ng-img-crop.css'); ?>" rel="stylesheet"/>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/angular-sanitize/angular-sanitize.min.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/angular-select/select.min.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/paymentsSchemes.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/angular-resource/angular-resource.min.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/angular-animate/angular-animate.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/lodash/lodash.min.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/app.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/main_app/services/transformRequest.js'); ?>"></script>
    <link rel='stylesheet' href="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/loading-bar.min.css'); ?>" type='text/css' media='all' />
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/loading-bar.min.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/ngBootbox.min.js'); ?>"></script>

    <?php if (!Yii::app()->user->isGuest) { ?>
        <script src="<?php echo Config::getFullChatPath()."/js/ITA.js" ?>"></script>
    <?php } ?>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/angular-bootstrap/ui-bootstrap-tpls-2.5.0.js'); ?>"></script>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <script>
        lang = lg = '<?php echo (Yii::app()->session['lg'] == NULL) ? 'ua' : Yii::app()->session['lg'];?>';
        basePath = '<?php echo Config::getBaseUrl(); ?>';
        studentProjectPath = '<?php echo Config::getStudentsProjectsUrl();?>';
    </script>
</head>

<body itemscope itemtype="https://schema.org/Product">
<?php $switch_navigation = Header::model()->currentPage(); ?>

<div id="main-wrapper" >
    <div id="mainheader">
        <?php $this->renderPartial('/site/_hamburgermenu'); ?>
        <div id='headerUnderline'>
            <table id="navigation" class="down">
                <tr class="main">
                    <td id="logo_img" class="down">
                        <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">
                            <img id="logo"
                                 src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'Logo_small.png'); ?>"/>
                        </a>
                    </td>
                    <td id="menulist">
                        <ul>
                            <li class = <?php echo ($switch_navigation == Header::COURSES_ACTIVE)? 'current_page_active': ''?> >
                                <a href="<?php echo Config::getBaseUrl() . '/courses'; ?>"><?php echo Yii::t('header', '0016'); ?></a>
                            </li>
                            <li class = <?php echo ($switch_navigation == Header::TEACHERS_ACTIVE)? 'current_page_active': ''?> >
                                <a href="<?php echo Config::getBaseUrl() . '/teachers'; ?>"><?php echo Yii::t('header', '0021'); ?></a>
                            </li>
                            <li class = <?php echo ($switch_navigation == Header::GRADUATES_ACTIVE)? 'current_page_active': ''?> >
                                <a href="<?php echo Config::getBaseUrl() . '/graduate'; ?>"><?php echo Yii::t('header', '0137'); ?></a>
                            </li>
<!--                            <li><a href="--><?php //echo Config::getBaseUrl() . '/crmForum'; ?><!--"-->
<!--                                   target="_blank">--><?php //echo Yii::t('header', '0017'); ?><!--</a></li>-->
                            <li class = <?php echo ($switch_navigation == Header::ABOUTUS_ACTIVE)? 'current_page_active': ''?> >
                                <a href="<?php echo Config::getBaseUrl() . '/aboutus'; ?>"><?php echo Yii::t('header', '0018'); ?></a>
                            </li>
                            <?php if (!Yii::app()->user->isGuest) { ?>
                            <li>
                                <a href="<?php echo Yii::app()->createUrl('/_teacher/cabinet/index'); ?>"><?php echo Yii::t('profile', '0815'); ?></a>
                            </li>
                            <?php } ?>
                            <?php if (!Yii::app()->user->isGuest && (Yii::app()->controller->id == 'site') && (Yii::app()->controller->action->id == 'index') || (!Yii::app()->user->isGuest && (Yii::app()->controller->id == 'aboutus')) ){ ?>
                                <li>
                                    <a href="<?php echo Yii::app()->createUrl('/studentreg/profile', array('idUser' => Yii::app()->user->id)); ?>"><?php echo Yii::t('breadcrumbs', '0054')?></a>
                                </li>
                            <?php } ?>
                            <li>
                                <a href="http://www.robotamolodi.org/" target="_blank"><?php echo Yii::t('header', '0902'); ?></a>
                            </li>
                            <li>
                                <a href="http://profitday.info/upcomingevents" target="_blank"><?php echo Yii::t('header', '0912'); ?></a>
                            </li>
                            <li>
                                <a href="<?php echo Mainpage::getPartnerLink() ?>" target="_blank"><?php echo Yii::t('header', '0981'); ?></a>
                            </li>
                        </ul>
                    </td>
                    <td class="emptyTd"></td>
                    <td id="enterButton">
                        <div id="button_border" class="down">
                        </div>
                        <?php if (Yii::app()->user->isGuest) {
                            echo CHtml::link($header->getEnterButton(), '', array('id' => 'enter_button', 'class' => 'down', 'onclick' => 'openSignIn();',));
                        } else {
                            ?>
                            <a id="enter_button" href="<?php echo Config::getBaseUrl(); ?>/site/logout"
                               class="down"><?php echo $header->getLogoutButton(); ?></a>
                        <?php } ?>
                    </td>
                    <td id="lang" class="down">
                        <div class="languageRow">
                            <?php
                            if (Yii::app()->session['lg'] == NULL) Yii::app()->session['lg'] = 'ua';
                            foreach (array("ua", "en", "ru") as $val) {
                                ?>
                                <a href="<?php echo Yii::app()->createUrl('site/changeLang', array('lg' => $val)); ?>" <?php echo (Yii::app()->session['lg'] == $val) ? 'class="selectedLang"' : ''; ?>><?php echo $val; ?></a>
                                <?php
                            }
                            ?>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="main">
        <div style="height: 5px; width: auto"></div>
        <div class="breadcrumbs">
            <?php if (isset($this->breadcrumbs)): ?>
                <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                    'links' => $this->breadcrumbs,
                    'homeLink' => CHtml::link(Yii::t('breadcrumbs', '0049'), Config::getBaseUrl()),
                    'htmlOptions' => array(
                        'class' => 'my-cool-breadcrumbs'
                    )
                )); ?><!-- breadcrumbs -->
            <?php endif ?>
            <?php if (!Yii::app()->user->isGuest && !(Yii::app()->controller->id == 'site' && Yii::app()->controller->action->id == 'index')
                && !(Yii::app()->controller->id == 'aboutus') && !(Yii::app()->controller->id == 'lesson')
            ) {
                $post = Yii::app()->user->model;
                $statusInfo = $this->beginWidget('UserStatusWidget', ['bigView' => true ,'registeredUser'=>$post]);
                $this->endWidget();
            }
            ?>
        </div>
    </div>
    <div id="contentBoxMain">
        <?php echo $content; ?>
        <!--Form Auth-->
        <?php echo $this->decodeWidgets('{{w:AuthorizationFormWidget|dialog=true;id=authFormDialog}}'); ?>
        <!--Form Auth-->
        <!--forgot pass modal-->
        <?php
        $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
            'id' => 'forgotpass',
            'themeUrl' => Config::getBaseUrl() . '/css',
            'cssFile' => 'jquery-ui.css',
            'theme' => 'my',
            'options' => array(
                'width' => 540,
                'autoOpen' => false,
                'modal' => true,
                'resizable' => false
            ),
        ));
        $this->renderPartial('/site/_forgotpass');
        $this->endWidget('zii.widgets.jui.CJuiDialog');
        ?>
        <!--forgot pass modal-->
    </div>
</div>
<div id="mainfooter">
    <div ng-cloak class="bannersArea">
        <div class="bannersCarousel" ng-controller="bannersSliderCtrl">
            <ul rn-carousel rn-carousel-index="1" rn-carousel-auto-slide rn-carousel-pause-on-hover rn-carousel-buffered rn-carousel-transition="hexagon" rn-carousel-duration="{{slides.slideTime}}">
                <li ng-repeat="slide in slides.banners track by slide.id" ng-class="'id-' + slide.id">
                    <div ng-style="{'background-image': 'url(' + slide.file_path + ')','background-size':'contain', 'background-repeat':'no-repeat' }"  class="bannerImage">
                        &nbsp;
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="footercontent">
        <div class="leftfooter">
            <table>
                <tr>
                    <td>
                        <a href="https://twitter.com/INTITA_EDU" target="_blank" title="Twitter">
                            <img
                                src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'twitter.png'); ?>"/>
                        </a>
                    </td>
                    <td>
                        <a href="https://www.youtube.com/channel/UC2EMqcr4pEBuTGEJBaFgOzw" target="_blank" title="Youtube">
                            <img src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'youtube.png'); ?>"/>
                        </a>
                    </td>
                    <td>
                        <a href="https://plus.google.com/u/0/116490432477798418410/posts" target="_blank"
                           title="Google+">
                            <img
                                src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'googlePlus.png'); ?>"/>
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <a href="https://www.facebook.com/pages/INTITA/320360351410183" target="_blank"
                           title="Facebook">
                            <img
                                src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'facebook.png'); ?>"/>
                        </a>
                    </td>
                    <td>
                        <a href="https://www.linkedin.com/company/intita?trk=biz-companies-cym" target="_blank"
                           title="Linkedin">
                            <img
                                src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'inl.png'); ?>"/>
                        </a>
                    </td>
                    <td>
                        <a href="https://www.instagram.com/intitaedu/" target="_blank" title="Instagram">
                            <img
                                src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'instagram.png'); ?>"/>
                        </a>
                    </td>
                </tr>
            </table>
        </div>
        <div class="centerfooter">
            <div class="leftpart">
                <div class="footerlogo">
                    <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">
                        <img id="footerLogo" src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'Logo_small.png'); ?>">
                        <img id="footerLogo800" src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'Logo_small800.png'); ?>">
                    </a>
                </div>
                <div class="footercontact">
                    <p>
                        <span><?php $footer = new Footer(); echo $footer->getTel(); ?></span><br/>
                        <span><?php echo $footer->getMobile(); ?></span><br/>
                        <span><?php echo $footer->getEmail(); ?></span><br/>
<!--                        <span>--><?php //echo $footer->getSkype(); ?><!--</span><br/>-->
                    </p>
                </div>
            </div>

            <div class="footermenu">
                <ul>
                    <li class = <?php echo ($switch_navigation == Header::COURSES_ACTIVE)? 'current_page_active': ''?> >
                        <a href="<?php echo Config::getBaseUrl() . '/courses'; ?>"><?php echo Yii::t('header', '0016'); ?></a>
                    </li>
                    <li class = <?php echo ($switch_navigation == Header::TEACHERS_ACTIVE)? 'current_page_active': ''?> >
                        <a href="<?php echo Config::getBaseUrl() . '/teachers'; ?>"><?php echo Yii::t('header', '0021'); ?></a>
                    </li>
                    <li class = <?php echo ($switch_navigation == Header::GRADUATES_ACTIVE)? 'current_page_active': ''?> >
                        <a href="<?php echo Config::getBaseUrl() . '/graduate'; ?>"><?php echo Yii::t('header', '0137'); ?></a>
                    </li>
<!--                    <li><a href="--><?php //echo Config::getBaseUrl() . '/crmForum'; ?><!--"-->
<!--                           target="_blank">--><?php //echo Yii::t('header', '0017'); ?><!--</a></li>-->
                    <li class = <?php echo ($switch_navigation == Header::ABOUTUS_ACTIVE)? 'current_page_active': ''?>>
                        <a href="<?php echo Config::getBaseUrl() . '/aboutus'; ?>"><?php echo Yii::t('header', '0018'); ?></a>
                    </li>
                    <?php if (!Yii::app()->user->isGuest) { ?>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('/_teacher/cabinet/index'); ?>"><?php echo Yii::t('profile', '0815'); ?></a>
                        </li>
                    <?php } ?>
                    <?php if (!Yii::app()->user->isGuest){ ?>
                        <li>
                            <a href="<?php echo Yii::app()->createUrl('/studentreg/profile', array('idUser' => Yii::app()->user->id)); ?>"><?php echo Yii::t('breadcrumbs', '0054')?></a>
                        </li>
                    <?php } ?>
                    <li>
                        <a href="http://www.robotamolodi.org/" target="_blank"><?php echo Yii::t('header', '0902'); ?></a>
                    </li>
                    <li>
                        <a href="http://profitday.info/upcomingevents" target="_blank"><?php echo Yii::t('header', '0912'); ?></a>
                    </li>
                    <li>
                        <a href="<?php echo Mainpage::getPartnerLink() ?>" target="_blank"><?php echo Yii::t('header', '0981'); ?></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="rightfooter">
            <a onclick='goUp()'><img
                    src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'go_up.png'); ?>"></a>
        </div>
    </div>
</div>
<!-- footer -->
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/select.min.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/select-tpls.min.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/main_app/controllers.js'); ?>"></script>
<!-- Humburger script -->
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'hamburgermenu.js'); ?>"></script>
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'goToTop.js'); ?>"></script>
<div id="rocket">
    <img src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'rocket.png'); ?>"/>
</div>
<div id="exhaust">
    <img src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'exhaust.png'); ?>"/>
</div>

<!-- jQuery -->
<!-- passEye, jQuery -->
<script async src="<?php echo StaticFilesHelper::fullPathTo('js', 'jquery.passEye.js'); ?>"></script>
<!-- passEye, jQuery -->
<!-- Placeholder for old browser -->
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'placeholder.min.js'); ?>"></script>
<!-- Placeholder for old browser -->
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-83801032-1', 'auto');
    ga('send', 'pageview');
</script>
<!--IntITAMessenger-->
<?php if (!Yii::app()->user->isGuest) { ?>
    <div ita-messenger="" path="<?php echo Config::getFullChatPath() ?>" class="dnd-container"></div>
<?php } ?>
<!--IntITAMessenger-->
</body>
</html>
