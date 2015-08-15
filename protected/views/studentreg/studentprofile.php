<!-- studprofile style -->
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/profile.css" />
<!-- studprofile style -->
<?php
/* @var $this StudentprofileController */
/* @var $post Studentprofile */
/* @var $form CActiveForm */
?>
<?php
$this->pageTitle = 'INTITA';
?>
<?php
$this->breadcrumbs=array(Yii::t('breadcrumbs', '0054'),
);
?>
<?php if (!isset($tab)) $tab=0; ?>
<div class="formStudProf">
    <div class="studProfInf">
        <table class="titleProfile">
            <tr>
                <td>
                    <h2><?php $post::getProfileRole($post->id);?></h2>
                </td>
                <td>
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/profileedit.png"/>
                </td>
                <td>
                    <a href="<?php echo Yii::app()->request->baseUrl; ?>/studentreg/edit"><?php echo Yii::t('profile', '0096'); ?></a>
                </td>
            </tr>
        </table>
        <img class='avatarimg' src="<?php echo StaticFilesHelper::createPath('image', 'avatars', $post->avatar);?>"/>
        <table class='profileInfo'>
            <tr>
                <td>
                    <h1><?php echo $post->nickname;?></h1>
                    <h1><?php echo $post->firstName;?></h1>
                    <h1><?php echo $post->secondName;?></h1>
                    <div class="aboutInfo">
                        <p>
                            <?php echo $post::getAdressYears($post->birthday,$post->address); ?>
                        </p>
                    </div>
                    <div class="aboutInfo">
                        <p><?php $post::getAboutMy($post->aboutMy);?></p>
                    </div>
                    <div class="aboutInfo">
                        <p> <span class="colorP"><?php echo Yii::t('profile', '0101'); ?></span><?php echo $post->email;?></p>
                    </div>
                    <div class="aboutInfo">
                        <p><?php $post::getPhone($post->phone);?></p>
                    </div>
                    <div class="aboutInfo">
                        <p><?php $post::getEducation($post->education);?></p>
                    </div>
                    <div class="aboutInfo">
                        <p><?php $post::getInterests($post->interests);?></p>
                    </div>
                    <div class="aboutInfo">
                        <p><?php $post::getAboutUs($post->aboutUs);?></p>
                    </div>
                    <div class="aboutInfo">
                        <p><?php $post::getEducform($post->educform);?></p>
                    </div>
                    <div class="aboutInfo">
                        <?php $post::getNetwork($post);?>
                    </div>
                    <div class="aboutInfo">
                        <?php $post::getFacebookLink($post->facebook);?>
                    </div>
                    <div class="aboutInfo">
                        <?php $post::getGoogleLink($post->googleplus);?>
                    </div>
                    <div class="aboutInfo">
                        <?php $post::getLinkedinLink($post->linkedin);?>
                    </div>
                    <div class="aboutInfo">
                        <?php $post::getVkLink($post->vkontakte);?>
                    </div>
                    <div class="aboutInfo">
                        <?php $post::getTwitterLink($post->twitter);?>
                    </div>
<!--                    <div class="aboutInfo">-->
<!--                        <p>--><?php //$post::getCourses('Курси самогоних апаратів 6-го рівня');?><!--</p>-->
<!--                    </div>-->
                </td>
            </tr>
        </table>
    </div>
    <div class="profileActivity">
        <div class="tabs">
            <ul>
                <li>
                    <?php echo Yii::t('profile', '0108'); ?>
                </li>
                <li>
                    <?php echo Yii::t('profile', '0109'); ?>
                </li>
                <li>
                    <?php echo Yii::t('profile', '0113'); ?>
                </li>
            </ul>
                <hr class="lineUnderTab">
            <ul>
                <li>
                    <?php echo Yii::t('profile', '0115'); ?>
                </li>
                <li>
                    <?php echo Yii::t('profile', '0116'); ?>
                </li>
                <li>
                    <?php echo Yii::t('profile', '0117'); ?>
                </li>
            </ul>
            <hr class="lineUnderTab">
            <div class="tabsContent">
                <div id="myCourse">
                    <?php $this->renderPartial('_mycourse'); ?>
                </div>
                <div id="timetable">
                    <?php $this->renderPartial('_timetable', array('dataProvider' => $dataProvider,'user'=>$post)); ?>
                </div>
                <div id="myRatting">
                    <?php $this->renderPartial('_myRatting'); ?>
                </div>
                <div id="mylettersSend" >
                    <?php $this->renderPartial('_mylettersSend', array('letter'=>$letter,'sentLettersProvider'=>$sentLettersProvider,'receivedLettersProvider'=>$receivedLettersProvider)); ?>
                </div>
                <div id="myMark">
                    <p class="tabHeader"><?php echo Yii::t('profile', '0116'); ?></p>
                    <?php
                    $this->widget('zii.widgets.CListView', array(
                        'dataProvider'=>$markProvider,
                        'itemView'=>'_myMark',
                        'template'=>'{items}{pager}',
                        'emptyText'=>Yii::t('profile', '0548'),
                        'pager' => array(
                            'firstPageLabel'=>'<<',
                            'lastPageLabel'=>'>>',
                            'prevPageLabel'=>'<',
                            'nextPageLabel'=>'>',
                            'header'=>'',
                        ),
                    ));
                    ?>
                </div>
                <div id="finances">
                    <?php $this->renderPartial('_finances', array('paymentsCourses'=>$paymentsCourses,'paymentsModules'=>$paymentsModules)); ?>
                </div>
            </div>
        </div>
    </div>
</div><!-- form -->
<!-- Script for open tabs-->
<script>
    $(document).ready(function(){
    $(".tabs").lightTabs(<?php echo $tab?>);
    });
</script>
<!-- OpenTab-->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/scripts/openTab.js"></script>
<!-- OpenTab -->