<? $css_version = 1; ?>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'profile.css'); ?>"/>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/main_app/controllers/profileCtrl.js'); ?>"></script>
<?php
/* @var $this StudentregController */
/* @var $post StudentReg */
/* @var $user RegisteredUser */
/* @var $form CActiveForm */
$this->breadcrumbs = array(Yii::t('breadcrumbs', '0054'));
?>
<script>
    basePath = '<?=Config::getBaseUrl();?>';
    userId = '<?=$post->id;?>';
</script>
<div class="formStudProf" ng-cloak ng-controller="profileCtrl">
    <div class="studProfInf">
        <table class="titleProfile">
            <tr>
                <td>
                    <h2><?php $post->getProfileRole(); ?></h2>
                </td>
            </tr>
        </table>
        <img class='avatarimg' src="<?php echo StaticFilesHelper::createPath('image', 'avatars', $post->avatar); ?>"/>

        <table class='profileInfo'>
            <tr>
                <td>
                    <h1>{{profileData.nickname}}</h1>
                    <h1>{{profileData.firstName}}</h1>
                    <h1>{{profileData.secondName}}</h1>

                    <div class="aboutInfo">
                        <p>
                            <?php echo $post::getAdressYears($post->birthday, $post->address); ?>
                        </p>
                    </div>
                    <div class="aboutInfo">
                        <p ng-if="profileData.aboutMy"><span class="colorP"><?php echo Yii::t('profile', '0100') ?></span>{{profileData.aboutMy}}</p>
                    </div>
                    <div class="aboutInfo">
                        <p ng-if="profileData.email"><span class="colorP"><?php echo Yii::t('profile', '0101') ?></span>{{profileData.email}}</p>
                    </div>
                    <div class="aboutInfo">
                        <p ng-if="profileData.phone"><span class="colorP"><?php echo Yii::t('profile', '0102') ?></span>{{profileData.phone}}</p>
                    </div>
                    <div class="aboutInfo">
                        <p ng-if="profileData.skype"><span class="colorP"><?php echo 'Skype:' ?></span>{{profileData.skype}}</p>
                    </div>
                    <div class="aboutInfo">
                        <p ng-if="profileData.education"><span class="colorP"><?php echo Yii::t('profile', '0103') ?></span>{{profileData.education}}</p>
                    </div>
                    <div class="aboutInfo">
                        <p ng-if="profileData.interests">
                            <span class="colorP"><?php echo Yii::t('profile', '0104') ?></span>
                            <span class="interestBG" ng-repeat="interest in interests track by $index">
                                {{interest}}
                            </span>
                        </p>
                    </div>
                    <div class="aboutInfo">
                        <p ng-if="profileData.aboutUs"><span class="colorP"><?php echo Yii::t('profile', '0105') ?></span>{{profileData.aboutUs}}</p>
                    </div>
                    <div class="aboutInfo">
                        <p ng-if="profileData.educform && !profileData.teacher"><span class="colorP"><?php echo Yii::t('profile', '0106') ?></span>{{profileData.educform}}</p>
                    </div>
                    <div class="aboutInfo">
                        <span ng-if="networks.length" class="colorP"><?php echo Yii::t('user', '0779') ?>:</span>
                    </div>
                    <div class="aboutInfo"  ng-repeat="network in networks track by $index">
                        <span class='networkLink'><a href="{{networks[$index][0]}}" target='_blank'>{{networks[$index][1]}}</a></span>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="profileActivity">
        <div class="tabs">
            <ul>
                <li>
                    <?php echo 'Курси'; ?>
                </li>
                <li>
                    <?php echo Yii::t('profile', '0109'); ?>
                </li>
                <li>
                    <?php echo 'Рейтинг'; ?>
                </li>
                <li>
                    <?php echo 'Оцінювання'; ?>
                </li>
            </ul>
            <hr class="lineUnderTab">
            <div class="tabsContent">
                <div id="myCourse">
                    <?php $this->renderPartial('_mycourse', array('paymentsCourses' => $paymentsCourses)); ?>
                </div>
                <div id="timetable">
                    <?php $this->renderPartial('_timetable', array('dataProvider' => $dataProvider, 'user' => $post, 'owner' => $owner)); ?>
                </div>
                <div id="myRatting">
                    <?php $this->renderPartial('_myRatting', array('user' => $user)); ?>
                </div>
                <div id="myMark">
                    <p class="tabHeader"><?php echo Yii::t('profile', '0116'); ?></p>
                    <?php
                    $this->widget('zii.widgets.CListView', array(
                        'dataProvider' => $markProvider,
                        'itemView' => '_myMark',
                        'template' => '{items}{pager}',
                        'emptyText' => Yii::t('profile', '0548'),
                        'pager' => array(
                            'firstPageLabel' => '<<',
                            'lastPageLabel' => '>>',
                            'prevPageLabel' => '<',
                            'nextPageLabel' => '>',
                            'header' => '',
                        ),
                    ));
                    ?>
                </div>
            </div>
        </div>
    </div>
</div><!-- form -->
<!-- Scripts for open tabs-->
<script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/jquery.cookie.js"></script>
<script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/openProfileTab.js"></script>
<script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/openTab.js"></script>
<script type="text/javascript">
    lang = '<?php if (CommonHelper::getLanguage() == 'ua') echo 'uk'; else echo CommonHelper::getLanguage();?>';
</script>
<script src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/js/bootstrap.min.js');?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/bootbox.min.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'profileDialogs.js'); ?>"></script>
<link href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo StaticFilesHelper::fullPathTo('css', 'bootstrapRewrite.css') ?>"/>
<!-- Scripts for open tabs -->