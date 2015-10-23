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
                        if(Yii::app()->user->isGuest) {
                            echo CHtml::button(Yii::t('module', '0279'), array('id' => "paymentButtonModule", 'onclick' => 'openSignIn();'));
                        } else{
                             echo CHtml::button(Yii::t('module', '0279'), array('id' => "paymentButtonModule",
                                'onclick' => 'redirectToProfile();',
                                'submit' => array('studentreg/profile'),
                                'params' => array(
                                    'module' => $post->module_ID,
                                    'idUser' => Yii::app()->user->getId(),
                                    'course' => (isset($_GET['idCourse'])?$_GET['idCourse']:0
                                    )
                                )
                             ));
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
                            echo CHtml::button(Yii::t('module', '0280'), array('id' => "paymentButtonCourse",
                                'onclick' => 'redirectToProfile();',
                                'submit' => array('studentreg/profile'),
                                'params' => array(
                                    'idUser' => Yii::app()->user->getId(),
                                    'course' => $_GET['idCourse'])
                            ));
                        }
                        ?>
                    </div>
                </td>
                <?php }?>
            </tr>
        </table>
        <?php  $this->renderPartial('_lectures', array('dataProvider' => $dataProvider, 'canEdit' => $editMode, 'module' =>$post, "idCourse"=>$idCourse));?>
    </div>
</div>

<script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/jquery.cookie.js"></script>

<script>
    function redirectToProfile(){
        $.cookie('openProfileTab', 5, {'path': "/"});
    }
</script>