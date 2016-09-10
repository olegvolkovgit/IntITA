<?php
/* @var $this Controller */
$header = new Header();
?>
<!DOCTYPE html>
<html id="ng-app" ng-app="mainApp" xmlns:ng="https://angularjs.org">
<head>
    <!--[if lte IE 8]>
    <body class="ie8">
    <![endif]-->
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
    <script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'jquery-1.8.3.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'openDialog.js'); ?>"></script>
    <!--[if lte IE 8]>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/json3.min.js'); ?>"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.29/angular.min.js"></script>
    <script>
        document.createElement('ng-include');
        document.createElement('ng-switch');
        document.createElement('ng-if');
        document.createElement('ng-pluralize');
        document.createElement('ng-view');

        // needed to enable CSS reference
        document.createElement('ng:view');
    </script>
    <script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'labelForIe.js'); ?>"></script>
    <![endif]-->
    <!-- for tabs -->
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/angular.min.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/app.js'); ?>"></script>
    <script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/angular-bootstrap/ui-bootstrap-tpls-1.3.3.js'); ?>"></script>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body itemscope itemtype="https://schema.org/Product">

<div id="main-wrapper" >
    <div id="mainheader">
        <?php $this->renderPartial('/site/_hamburgermenu'); ?>
        <div id='headerUnderline'>
            <div id="navigation" class="down">
                <div class="main">
                    <div id="logo_img" class="down">
                        <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">
                            <img id="logo"
                                 src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'Logo_small.png'); ?>"/>
                        </a>
                    </div>
                    <div id="lang" class="down">
                        <?php
                        if (Yii::app()->session['lg'] == NULL) Yii::app()->session['lg'] = 'ua';
                        foreach (array("ua", "en", "ru") as $val) {
                            ?>
                            <a href="<?php echo Yii::app()->createUrl('site/changeLang', array('lg' => $val)); ?>" <?php echo (Yii::app()->session['lg'] == $val) ? 'class="selectedLang"' : ''; ?>><?php echo $val; ?></a>
                        <?php
                        }
                        ?>
                    </div>
                    <div id="enterButton">
                        <div id="button_border" class="down">
                        </div>
                        <?php if (Yii::app()->user->isGuest) {
                            echo CHtml::link($header->getEnterButton(), '', array('id' => 'enter_button', 'class' => 'down', 'onclick' => 'openSignIn();',));
                        } else {
                            ?>
                            <a id="enter_button" href="<?php echo Config::getBaseUrl(); ?>/site/logout"
                               class="down"><?php echo $header->getLogoutButton(); ?></a>
                        <?php } ?>
                    </div>
                    <div id="menulist">
                        <ul>
                            <li>
                                <a href="<?php echo Config::getBaseUrl() . '/courses'; ?>"><?php echo Yii::t('header', '0016'); ?></a>
                            </li>
                            <li>
                                <a href="<?php echo Config::getBaseUrl() . '/teachers'; ?>"><?php echo Yii::t('header', '0021'); ?></a>
                            </li>
                            <li>
                                <a href="<?php echo Config::getBaseUrl() . '/graduate'; ?>"><?php echo Yii::t('header', '0137'); ?></a>
                            </li>
                            <li><a href="<?php echo Config::getBaseUrl() . '/forum'; ?>"
                                   target="_blank"><?php echo Yii::t('header', '0017'); ?></a></li>
                            <li>
                                <a href="<?php echo Config::getBaseUrl() . '/aboutus'; ?>"><?php echo Yii::t('header', '0018'); ?></a>
                            </li>
                            <li>
                                <a href="<?php echo Yii::app()->createUrl('/_teacher/cabinet/index'); ?>"><?php echo Yii::t('profile', '0815'); ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main">
        <div style="height: 5px; width: auto"></div>
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
    <div style="height: 90px;display: block;border-bottom: 1px solid #44bdf6;">
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
                            <a href="https://youtube.com" target="_blank" title="Youtube">
                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/youtube.png"/>
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
                            <a href="https://vk.com/intita" target="_blank" title="Vkontakte">
                                <img
                                    src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'vkontakte.png'); ?>"/>
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="centerfooter">
                <div class="footerlogo">
                    <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">
                        <img
                            src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'Logo_small.png'); ?>">
                    </a>
                </div>
                <div class="footercontact">
                    <p>
                        <?php $footer = new Footer();
                        echo $footer->getTel(); ?><br/>
                        <?php echo $footer->getMobile(); ?><br/>
                        <?php echo $footer->getEmail(); ?><br/>
                        <?php echo $footer->getSkype(); ?><br/>
                    </p>
                </div>
                <div class="footermenu">
                    <ul>
                        <li>
                            <a href="<?php echo Config::getBaseUrl() . '/courses'; ?>"><?php echo Yii::t('header', '0016'); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo Config::getBaseUrl() . '/teachers'; ?>"><?php echo Yii::t('header', '0021'); ?></a>
                        </li>
                        <li>
                            <a href="<?php echo Config::getBaseUrl() . '/graduate'; ?>"><?php echo Yii::t('header', '0137'); ?></a>
                        </li>
                        <li><a href="<?php echo Config::getBaseUrl() . '/forum'; ?>"
                               target="_blank"><?php echo Yii::t('header', '0017'); ?></a></li>
                        <li>
                            <a href="<?php echo Config::getBaseUrl() . '/aboutus'; ?>"><?php echo Yii::t('header', '0018'); ?></a>
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
</div>
<!-- footer -->
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/select.min.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/select-tpls.min.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/main_app/controllers.js'); ?>"></script>
<!-- Humburger script -->
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'hamburgermenu.js'); ?>"></script>
<script type="text/javascript" src="<?php echo StaticFilesHelper::fullPathTo('js', 'goToTop.js'); ?>"></script>
<!-- trimEmail-->
<script async src="<?php echo StaticFilesHelper::fullPathTo('js', 'trimField.js'); ?>"></script>
<!-- trimEmail -->
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
</body>
</html>
