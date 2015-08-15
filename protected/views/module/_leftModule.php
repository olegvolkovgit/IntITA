<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 12.05.2015
 * Time: 16:06
 */
if (AccessHelper::isAdmin()) $post->setScenario('canedit');
?>
<div class="leftModule">
    <div class="headerLeftModule">
        <?php
        if (AccessHelper::isAdmin())
        $this->renderPartial('_moduleInfoForAdmin', array('post'=>$post));
        else $this->renderPartial('_moduleInfo', array('post'=>$post));
        ?>
        <table>
            <tr>
                <td>
                    <div class="startModule">
                        <?php $labelButton = Yii::t('module', '0279')?>
                        <?php echo CHtml::link($labelButton, '#'); ?>
                    </div>
                </td>
                <td>
                    <div class="startCourse">
                        <?php $labelButton = Yii::t('module', '0280')?>
                        <?php echo CHtml::link($labelButton, '#'); ?>
                    </div>
                </td>
            </tr>
        </table>
        <?php  $this->renderPartial('_lectures', array('dataProvider' => $dataProvider, 'canEdit' => $editMode, 'module' =>$post, "idCourse"=>$idCourse));?>
    </div>
</div>