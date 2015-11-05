<?php
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
                        <?php
                        if(Yii::app()->user->isGuest && $post->status == 0 && $post->cancelled == 0) {
                            echo CHtml::button(Yii::t('module', '0279'), array('id' => "paymentButtonModule", 'onclick' => 'openSignIn();'));
                        } elseif($post->status == 1 && $post->cancelled == 0){
                            ?>
                            <a id="paymentButtonModule" onclick="redirectToProfile()"
                               href="<?php echo Yii::app()->createUrl('studentreg/profile', array(
                                   'idUser' => Yii::app()->user->getId(),
                                   'course' => (isset($_GET['idCourse']))?$_GET['idCourse']:0,
                                   'module' => $post->module_ID
                               ));?>"><?php echo Yii::t('module', '0279');?></a>
                        <?php
                        }
                        ?>
                    </div>
                </td>
                <?php if(isset($_GET['idCourse']) && $_GET['idCourse'] > 0){?>
                <td>
                    <div class="startCourse">
                        <?php
                        if(Yii::app()->user->isGuest) {
                            echo CHtml::button(Yii::t('module', '0280'), array('id' => "paymentButtonCourse", 'onclick' => 'openSignIn();'));
                        } else{
                            ?>
                            <a id="paymentButtonCourse" onclick="redirectToProfile()"
                               href="<?php echo Yii::app()->createUrl('studentreg/profile', array(
                                   'idUser' => Yii::app()->user->getId(),
                                   'course' => $_GET['idCourse'],
                               ));?>"><?php echo Yii::t('course', '0328');?></a>
                        <?php
                        }
                        ?>
                    </div>
                </td>
                <?php }?>
            </tr>
        </table>
        <?php
        $this->renderPartial('_lectures', array('dataProvider' => $dataProvider, 'canEdit' => $editMode, 'module' =>$post, "idCourse"=>$idCourse));?>
    </div>
</div>

<script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/jquery.cookie.js"></script>

<script>
    function redirectToProfile(){
        $.cookie('openProfileTab', 5, {'path': "/"});
    }
</script>