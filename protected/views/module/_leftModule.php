<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 12.05.2015
 * Time: 16:06
 */
if (AccessHelper::isAdmin()) $post->setScenario('canedit');
?>
<script>
    profilePath = "<?php echo Yii::app()->createUrl('studentreg/profile', array('idUser' => Yii::app()->user->getId()));?>";
</script>
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
                            echo CHtml::button(Yii::t('module', '0279'), array('id' => "paymentButton", 'onclick' => 'openSignIn();'));
                        } else{
                            echo CHtml::button(Yii::t('module', '0279'), array('id' => "paymentButton", 'onclick' => 'redirectToProfile(profilePath);'));
                        }
                        ?>
                    </div>
                </td>
                <td>
                    <div class="startCourse">
                        <?php
                        if(Yii::app()->user->isGuest) {
                            echo CHtml::button(Yii::t('module', '0280'), array('id' => "paymentButton", 'onclick' => 'openSignIn();'));
                        } else{
                            echo CHtml::button(Yii::t('module', '0280'), array('id' => "paymentButton", 'onclick' => 'redirectToProfile(profilePath);'));
                        }
                        ?>
                    </div>
                </td>
            </tr>
        </table>
        <?php  $this->renderPartial('_lectures', array('dataProvider' => $dataProvider, 'canEdit' => $editMode, 'module' =>$post, "idCourse"=>$idCourse));?>
    </div>
</div>

<script type="text/javascript" src="<?php echo Config::getBaseUrl(); ?>/scripts/jquery.cookie.js"></script>

<script>
    function redirectToProfile(profilePath){
        $.cookie('openProfileTab', 5, {'path': "/"});
        document.location.href = profilePath;
    }
</script>