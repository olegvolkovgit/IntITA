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
<?php if (!isset($tab)) $tab=''; ?>
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
            <input id="tab1" type="radio" name="tabs" checked>
            <label class="tabsUp1" for="tab1" title="<?php echo Yii::t('profile', '0108'); ?>"><?php echo Yii::t('profile', '0108'); ?></label>
            <input id="tab2" type="radio" name="tabs" >
            <label for="tab2" title="<?php echo Yii::t('profile', '0109'); ?>"><?php echo Yii::t('profile', '0109'); ?></label>
<!--            <input id="tab3" type="radio" name="tabs" >-->
<!--            <label for="tab3" title="--><?php //echo Yii::t('profile', '0110'); ?><!--">--><?php //echo Yii::t('profile', '0110'); ?><!--</label>-->
            <input id="tab6" type="radio" name="tabs">
            <label  for="tab6" title="<?php echo Yii::t('profile', '0113'); ?>"><?php echo Yii::t('profile', '0113'); ?></label>
<!--            <input id="tab4" type="radio" name="tabs">-->
<!--            <label for="tab4" title="--><?php //echo Yii::t('profile', '0111'); ?><!--">--><?php //echo Yii::t('profile', '0111'); ?><!--</label>-->
<!--            <input id="tab5" type="radio" name="tabs" >-->
<!--            <label for="tab5" title="--><?php //echo Yii::t('profile', '0112'); ?><!--">--><?php //echo Yii::t('profile', '0112'); ?><!--</label>-->
            <div class="lineUnderTab"></div>
<!--            <input id="tab7" type="radio" name="tabs">-->
<!--            <label for="tab7" title="--><?php //echo Yii::t('profile', '0114'); ?><!--">--><?php //echo Yii::t('profile', '0114'); ?><!--</label>-->
            <input id="tab8" type="radio" name="tabs" <?php echo $tab?>>
            <label class="tabsDown1" for="tab8" title="<?php echo Yii::t('profile', '0115'); ?>"><?php echo Yii::t('profile', '0115'); ?></label>
            <input id="tab9" type="radio" name="tabs">
            <label class="tabsDown" for="tab9" title="<?php echo Yii::t('profile', '0116'); ?>"><?php echo Yii::t('profile', '0116'); ?></label>
            <input id="tab10" type="radio" name="tabs">
            <label class="tabsDown" style="background-image:url(<?php echo Yii::app()->request->baseUrl; ?>/css/images/financeico.png);background-repeat: no-repeat;background-position:10px 3px;" for="tab10" title="<?php echo Yii::t('profile', '0117'); ?>"><?php echo Yii::t('profile', '0117'); ?></label>
            <div class="lineUnderTab"></div>
            <section id="myCourse">
                <?php $this->renderPartial('_mycourse'); ?>
            </section>
            <section id="timetable">
                <?php $this->renderPartial('_timetable', array('dataProvider' => $dataProvider,'user'=>$post)); ?>
            </section>
<!--            <section id="consultation">-->
<!--                --><?php //$this->renderPartial('_consultation', array('dataProvider' => $dataProvider,'user'=>$post)); ?>
<!--            </section>-->
<!--            <section id="exams">-->
<!--                --><?php //$this->renderPartial('_exams'); ?>
<!--            </section>-->
<!--            <section id="projects">-->
<!--                --><?php //$this->renderPartial('_projects'); ?>
<!--            </section>-->
            <section id="myRatting">
                <?php $this->renderPartial('_myRatting'); ?>
            </section>
<!--            <section id="myDownload">-->
<!--                --><?php //$this->renderPartial('_myDownload'); ?>
<!--            </section>-->
            <section id="mylettersSend">
                <?php $this->renderPartial('_mylettersSend', array('letter'=>$letter,'sentLettersProvider'=>$sentLettersProvider,'receivedLettersProvider'=>$receivedLettersProvider)); ?>
            </section>
            <section id="myMark">
                <p class="tabHeader"><?php echo Yii::t('profile', '0116'); ?></p>
                <?php
                $this->widget('zii.widgets.CListView', array(
                    'dataProvider'=>$markProvider,
                    'itemView'=>'_myMark',
                    'template'=>'{items}{pager}',
                    'emptyText'=>'Оцінювань немає',
                    'pager' => array(
                        'firstPageLabel'=>'<<',
                        'lastPageLabel'=>'>>',
                        'prevPageLabel'=>'<',
                        'nextPageLabel'=>'>',
                        'header'=>'',
                    ),
                ));
                ?>
            </section>
            <section id="finances">
                <?php $this->renderPartial('_finances', array('paymentsCourses'=>$paymentsCourses,'paymentsModules'=>$paymentsModules)); ?>
            </section>
        </div>
    </div>
</div><!-- form -->