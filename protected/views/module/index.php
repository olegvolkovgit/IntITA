<!-- Module style -->
<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/module.css" />
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>-->
<!-- Module style -->
<!-- BD -))) -->
<?php
$this->pageTitle = 'INTITA';
?>
<!-- BD -))) -->
<?php

$this->breadcrumbs=array(
    Yii::t('breadcrumbs', '0050')=>Yii::app()->request->baseUrl."/courses",Course::model()->findByPk($post->course)->course_name =>Yii::app()->request->baseUrl."/course",$post->module_name,
);
?>

<div class="ModuleBlock">
    <div class="leftModule">
        <div class="headerLeftModule">
            <table>
                <tr>
                    <td>
                        <img class="moduleImg" src="<?php echo Yii::app()->request->baseUrl.$post->module_img ?>" />
                    </td>
                    <td style="padding-left: 15px;">

                        <span id="titleModule"><?php echo Yii::t('module', '0211'); ?></span>
                        <?php echo $post->module_name;?>
                        <div>
                            <span id="titleModule"><?php echo Yii::t('module', '0214'); ?></span>
                            <?php echo "сильний початківець"?>

                            <?php
                            for ($i=0; $i<3; $i++)
                            {
                                ?><span>
                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/ratIco1.png"/>
                                </span><?php
                            }
                            for ($i=0; $i<2; $i++)
                            {
                                ?><span>
                                <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/ratIco0.png"/>
                                </span><?php
                            }
                            ?>
                        </div>
                        <div>
                            <span id="titleModule"><?php echo Yii::t('module', '0215'); ?></span>
                            <b>25 <?php echo Yii::t('module', '0216'); ?></b>, <?php echo Yii::t('module', '0217'); ?> - <b>2 <?php echo Yii::t('module', '0218'); ?></b> (3 <?php echo Yii::t('module', '0219'); ?>, 3 <?php echo Yii::t('module', '0220'); ?>)
                        </div>
                        <div>
                            <span id="titleModule"><?php echo Yii::t('module', '0221'); ?></span>
                           <span id="oldPrice"> <?php echo $post->module_price; ?> <?php echo Yii::t('module', '0222'); ?></span> 1500.00 <?php echo Yii::t('module', '0222'); ?> (<?php echo Yii::t('module', '0223'); ?>)
                        </div>
                        <div>
                            <div >
                                <span id="titleModule"><?php echo Yii::t('module', '0224'); ?></span>
                                <?php
                                for ($i = 0; $i < 9; $i++) {
                                    ?><span>
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/starFull.png">
                                    </span><?php
                                }
                                for ($i = 0; $i < 1; $i++) {
                                    ?><span>
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/images/starEmpty.png">
                                    </span><?php
                                }
                                ?>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
            <?php $this->renderPartial('_lectures', array('dataProvider' => $dataProvider, 'canEdit' => $editMode, 'module' =>$post));?>
        </div>
    </div>

    <div class="rightModule">
        <?php
        for ($i = 0; $i < count($teachers); $i++) {
            ?>
            <div class="teacherBox">
                <table>
                    <tr>
                        <td class="teacherBoxLeft">
                            <img  src="<?php echo Yii::app()->request->baseUrl.$teachers[$i]->foto_url; ?>"/>
                            <a href="<?php echo Yii::app()->request->baseUrl.$teachers[$i]->readMoreLink; ?>"><?php echo Yii::t('module', '0228'); ?> &#187;</a>
                        </td>
                        <td  class="teacherBoxRight" ">
                        <h2><?php echo Yii::t('module', '0227'); ?></h2>
                        <div style="line-height: 1.2;">
                            <?php echo $teachers[$i]->last_name." ".$teachers[$i]->first_name;?>
                            <br>
                            <?php echo $teachers[$i]->email;?>
                            <br>
                            <?php echo $teachers[$i]->tel;?>
                            <br>
                            <?php echo $teachers[$i]->skype;?>
                        </div>
                        </td>
                    </tr>
                </table>
            </div>
        <?php
        }
        ?>
    </div>
</div>


