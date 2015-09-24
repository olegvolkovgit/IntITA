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
                        <?php echo CHtml::button(Yii::t('module', '0279'),  array('id' => "paymentButton", 'onclick' => 'openSignIn();'));
                        ?>
                    </div>
                </td>
                <td>
                    <div class="startCourse">
                        <?php echo CHtml::button(Yii::t('module', '0280'), array('id' => "paymentButton", 'onclick' => 'openSignIn();')); ?>
                    </div>
                </td>
            </tr>
        </table>
        <?php  $this->renderPartial('_lectures', array('dataProvider' => $dataProvider, 'canEdit' => $editMode, 'module' =>$post, "idCourse"=>$idCourse));?>
    </div>
</div>