<?php /* @var $this Controller */
$header = new Header();
?>
<!DOCTYPE html>
<html ng-app xmlns:og="https://ogp.me/ns#">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="en">

    <meta property="og:type" content="website" />
    <meta property="og:image:width" content="200"/>


    <link href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap.css'); ?>" rel="stylesheet">
    <link href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap-theme.css'); ?>" rel="stylesheet">

    <link href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">

    <!-- for tabs -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="<?php echo Config::getBaseUrl(); ?>/css/fontface.css"/>
    <!-- for tabs -->
    <!-- layouts style -->
    <link rel="stylesheet" type="text/css" href="<?php echo Config::getBaseUrl(); ?>/css/style.css"/>

    <link rel="stylesheet" type="text/css" href="<?php echo Config::getBaseUrl(); ?>/css/admin.css"/>
        <!-- steps style -->
    <link rel="shortcut icon" href="<?php echo Config::getBaseUrl(); ?>/css/images/favicon.ico"
          type="image/x-icon"/>
    <!-- jQuery -->
    <script type="text/javascript" src="<?php echo Config::getBaseUrl();?>/scripts/jquery-1.8.3.js"></script>
    <script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/openDialog.js"></script>
    <link rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'regform.css'); ?>"/>
    <!-- jQuery -->
    <!-- passEye, jQuery -->

    <!-- trimEmail -->

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div id="main-wrapper">
    <div id="mainheader">
        <div id='headerUnderline'>
            <div id="navigation" class="down">
                <div class="main">
                    <div id="logo_img" class="down">
                        <a href="<?php echo Yii::app()->createUrl('site/index'); ?>">
                            <img id="logo" src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'Logo_small.png'); ?>"/>
                        </a>
                    </div>
                    <div id="lang" class="down">
                        <?php
                        if(Yii::app()->session['lg']==NULL) Yii::app()->session['lg']='ua';
                        foreach (array("ua", "en", "ru") as $val) {
                            ?>
                            <a href="<?php echo Yii::app()->createUrl('site/changeLang', array('lg'=>$val)); ?>" <?php echo (Yii::app()->session['lg'] == $val) ? 'class="selectedLang"' : ''; ?>><?php echo $val; ?></a>
                        <?php
                        }
                        ?>
                    </div>
                    <div id="enterButton">
                        <div id="button_border" class="down">
                        </div>
                        <?php if (Yii::app()->user->isGuest) {
                            echo CHtml::link($header->getEnterButton(), '#', array('id' => 'enter_button', 'class' => 'down', 'onclick' => 'openSignIn();',));
                        } else {
                            ?>
                            <a id="enter_button" href="<?php echo Config::getBaseUrl(); ?>/site/logout"
                               class="down"><?php echo $header->getLogoutButton(); ?></a>
                        <?php } ?>
                    </div>
                    <div id="menulist">
                        <ul>
                            <li><a href="<?php echo Config::getBaseUrl().'/courses'; ?>"><?php echo Yii::t('header', '0016'); ?></a></li>
                            <li><a href="<?php echo Config::getBaseUrl().'/teachers'; ?>"><?php echo Yii::t('header', '0021'); ?></a></li>
                            <li><a href="<?php echo Config::getBaseUrl().'/graduate'; ?>"><?php echo Yii::t('header', '0137'); ?></a></li>
                            <li><a href="<?php echo Config::getBaseUrl().'/forum'; ?>" target="_blank"><?php echo Yii::t('header', '0017'); ?></a></li>
                            <li><a href="<?php echo Config::getBaseUrl().'/aboutus'; ?>"><?php echo Yii::t('header', '0018'); ?></a></li>
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

        <?php if (!Yii::app()->user->isGuest) {
            $post = Yii::app()->user->model;
            $statusInfo = $this->beginWidget('UserStatusWidget', ['registeredUser'=>post]);
            $statusInfo->endWidget();
        }
        ?>
    </div>
    <div id="contentBoxMain" style="margin-left: 50px">
        <?php echo $content; ?>
        <!--Auth form-->
        <?php echo $this->decodeWidgets('{{w:AuthorizationFormWidget|dialog=true;id=authFormDialog;action=../site/signInSignUp}}'); ?>
        <!--Auth form-->
        <!--forgot pass modal-->
        <?php
        $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
            'id' => 'forgotpass',
            'themeUrl' => Config::getBaseUrl().'/css',
            'cssFile' => 'jquery-ui.css',
            'theme' => 'my',
            'options' => array(
                'width' => 540,
                'autoOpen' => false,
                'modal' => true,
                'resizable' => false
            ),
        ));
        $this->renderPartial('application.views.site._forgotpass');
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
                            <a href="https://plus.google.com/u/0/116490432477798418410/posts" target="_blank" title="Google+">
                                <img
                                    src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'googlePlus.png'); ?>"/>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="https://www.facebook.com/pages/INTITA/320360351410183" target="_blank" title="Facebook">
                                <img
                                    src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'facebook.png'); ?>"/>
                            </a>
                        </td>
                        <td>
                            <a href="https://www.linkedin.com/company/intita?trk=biz-companies-cym" target="_blank" title="Linkedin">
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
                        <li><a href="<?php echo Config::getBaseUrl().'/courses'; ?>"><?php echo Yii::t('header', '0016'); ?></a></li>
                        <li><a href="<?php echo Config::getBaseUrl().'/teachers'; ?>"><?php echo Yii::t('header', '0021'); ?></a></li>
                        <li><a href="<?php echo Config::getBaseUrl().'/graduate'; ?>"><?php echo Yii::t('header', '0137'); ?></a></li>
                        <li><a href="<?php echo Config::getBaseUrl().'/forum'; ?>" target="_blank"><?php echo Yii::t('header', '0017'); ?></a></li>
                        <li><a href="<?php echo Config::getBaseUrl().'/aboutus'; ?>"><?php echo Yii::t('header', '0018'); ?></a></li>
                    </ul>
                </div>
            </div>
            <div class="rightfooter">
                <a onclick='goUp()' ><img src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'go_up.png'); ?>"></a>
            </div>
        </div>
    </div>
</div>
<!-- footer -->
<!-- Humburger script -->
<script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/hamburgermenu.js"></script>
<script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/goToTop.js"></script>
<div id="rocket">
    <img src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'rocket.png'); ?>"/>
</div>
<div id="exhaust">
    <img src="<?php echo StaticFilesHelper::createPath('image', 'mainpage', 'exhaust.png'); ?>"/>
</div>
</body>
</html>
<script async type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/jquery.passEye.js"></script>
<script async type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/trimField.js"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', '_admin/oldAdmin.js'); ?>"></script>

