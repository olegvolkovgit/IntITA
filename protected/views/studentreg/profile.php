<? $css_version = 1; ?>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'profile.css'); ?>"/>
<script
    src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/main_app/controllers/profileCtrl.js'); ?>"></script>
<?php
/* @var $this StudentregController
 * @var $post StudentReg
 * @var $user RegisteredUser
 * @var $form CActiveForm
 * @var $addressString string*
 * @var $markProvider
 * @var $owner
 */
$this->breadcrumbs = array(Yii::t('breadcrumbs', '0054'));
?>
<script>
    basePath = '<?=Config::getBaseUrl();?>';
    userId = '<?=$post->id;?>';
    lang = '<?php echo CommonHelper::getLanguage();?>';
</script>
<div class="formStudProf" ng-cloak ng-controller="profileCtrl">
    <div class="studProfInf">
        <table class="titleProfile">
            <tr>
                <td>
                    <h2><?php $post->getProfileRole(); ?></h2>
                </td>
                <?php if ($owner) { ?>
                    <td>
                        <a class="editLink" href="<?php echo Yii::app()->createUrl('studentreg/edit'); ?>">
                            <img src="<?php echo StaticFilesHelper::createPath('image', 'common', 'profileedit.png'); ?>"/>
                        </a>
                    </td>
                    <td>
                        <a class="editLink" href="<?php echo Yii::app()->createUrl('studentreg/edit'); ?>"><?php echo Yii::t('profile', '0096'); ?></a>
                    </td>
                <?php } ?>
            </tr>
        </table>
        <img class='avatarimg' src="<?php echo StaticFilesHelper::createPath('image', 'avatars', $post->avatar); ?>"/>
        <div class="userNameMini">
            <h1>{{profileData.nickname}}</h1>
            <h1>{{profileData.firstName}}</h1>
            <h1>{{profileData.secondName}}</h1>
        </div>
        <table class='profileInfo'>
            <tr>
                <td>
                    <?php if ($owner) { ?>
                        <a href="<?php echo Yii::app()->createUrl('/_teacher/cabinet/index'); ?>"><?php echo Yii::t('profile', '0815'); ?></a>
                    <?php } ?>
                    <div class="userName">
                        <h1>{{profileData.nickname}}</h1>
                        <h1>{{profileData.firstName}}</h1>
                        <h1>{{profileData.secondName}}</h1>
                    </div>
                    <div class="spoilerMini" ng-click="spoiler('spoilerContentMini','mini')">
                        {{spoilerTitleMini}}
                        <span id='trg1'>&#9660;</span>
                    </div>
                    <div id="spoilerContentMini">
                        <div class="aboutInfo">
                            <p>
                                <span class="colorP">
                                <?php if ($addressString != "")
                                    echo $addressString;
                                ?>
                                </span>
                            </p>
                        </div>
                        <div class="aboutInfo">
                            <p ng-if="profileData.aboutMy"><span
                                    class="colorP"><?php echo Yii::t('profile', '0100') ?></span>{{profileData.aboutMy}}</p>
                        </div>
                        <div class="aboutInfo">
                            <p ng-if="profileData.email"><span class="colorP"><?php echo Yii::t('profile', '0101') ?></span>{{profileData.email}}
                            </p>
                        </div>
                        <div class="spoiler" ng-click="spoiler('spoilerContent','middle')">
                            {{spoilerTitle}}
                            <span id='trg2'>&#9660;</span>
                        </div>
                        <div id="spoilerContent">
                            <div class="aboutInfo">
                                <p ng-if="profileData.phone"><span class="colorP"><?php echo Yii::t('profile', '0102') ?></span>{{profileData.phone}}
                                </p>
                            </div>
                            <div class="aboutInfo">
                                <p ng-if="profileData.skype"><span class="colorP"><?php echo 'Skype:' ?></span>{{profileData.skype}}
                                </p>
                            </div>
                            <div class="aboutInfo">
                                <p ng-if="profileData.education"><span
                                        class="colorP"><?php echo Yii::t('profile', '0103') ?></span>{{profileData.education}}
                                </p>
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
                                <p ng-if="profileData.aboutUs"><span
                                        class="colorP"><?php echo Yii::t('profile', '0105') ?></span>{{profileData.aboutUs}}</p>
                            </div>
                            <div class="aboutInfo">
                                <p ng-if="profileData.educform && !profileData.teacher"><span
                                        class="colorP"><?php echo Yii::t('profile', '0106') ?></span>{{profileData.educform}}
                                </p>
                            </div>
                            <div class="aboutInfo">
                                <span ng-if="networks.length" class="colorP"><?php echo Yii::t('user', '0779') ?>:</span>
                            </div>
                            <div class="aboutInfo" ng-repeat="network in networks track by $index">
                                <span class='networkLink'><a href="{{networks[$index][0]}}" target='_blank'>{{networks[$index][1]}}</a></span>
                            </div>
                            <br>
                            <div class="aboutInfo">
                                <p ng-if="profileData.trainer"><span
                                        class="colorP"><?php echo Yii::t('profile', '0901') ?>:</span><a ng-href={{profileData.trainer.link}} target="_blank">{{profileData.trainer.name}}</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <div class="profileActivity">
        <div class="tabs">
            <ul>
                <li>
                    <?= ($owner) ? Yii::t('profile', '0108') : Yii::t('profile', '0822'); ?>
                </li>
                <li>
                    <?= ($owner) ? Yii::t('profile', '0113') : Yii::t('profile', '0823'); ?>
                </li>
                <li>
                    <?= ($owner) ? Yii::t('profile', '0116') : Yii::t('profile', '0824'); ?>
                </li>
            </ul>
            <hr class="lineUnderTab">
            <div class="tabsContent">
                <div id="myCourse">
                    <?php
                    if($user->isStudent()) $this->renderPartial('_mycourse', array('user' => $user, 'owner'=>$owner));
                    ?>
                </div>
                <div id="myRatting">
                    <?php $this->renderPartial('_myRatting', array('user' => $user,'owner'=>$owner)); ?>
                </div>
                <div id="myMark">
                    <p class="tabHeader"><?php echo ($owner) ? Yii::t('profile', '0116') : Yii::t('profile', '0824'); ?></p>
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
<script
    src="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/bootbox.min.js'); ?>"></script>
<link
    href="<?php echo StaticFilesHelper::fullPathTo('css', 'bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>"
    rel="stylesheet">
<link rel="stylesheet" type="text/css"
      href="<?php echo StaticFilesHelper::fullPathTo('css', 'bootstrapRewrite.css') ?>"/>
