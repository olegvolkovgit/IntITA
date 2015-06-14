<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 25.04.2015
 * Time: 0:58
 */
?>
<?php
if($teacherRat && $teacherRat->knowledge!==null && $teacherRat->behavior!==null && $teacherRat->motivation!==null){
    $knowldg= $teacherRat->knowledge;
    $behvr=$teacherRat->behavior;
    $motivtn=$teacherRat->motivation;
    $knowval=$knowldg;
    $behval=$behvr;
    $motivval=$motivtn;
} else{
    $knowldg='0';
    $behvr='0';
    $motivtn='0';
    $knowval=Null;
    $behval=Null;
    $motivval=Null;
}
?>
<?php if(AccessHelper::canAddResponse()){?>
<div class="lessonTask">
    <img class="lessonBut" src="<?php echo StaticFilesHelper::createPath('image', 'teachers', 'lessButton.png');?>">
    <div class="lessonButName" unselectable="on"><?php echo Yii::t('teacher', '0187'); ?></div>
    <div class="lessonLine"></div>
    <div class="responseBG">

        <div>
            <table style="padding-left: 35px; padding-top: 30px;">
                <tr>
                    <td align="right">
                        <b><?php echo  Yii::t('teacher', '0188'); ?></b>
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <?php echo Yii::t('teacher', '0189'); ?>
                    </td>
                    <td>
                        <div id="material" ></div>
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <?php echo Yii::t('teacher', '0190'); ?>
                    </td>
                    <td>
                        <div id="behavior"></div>
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <?php echo Yii::t('teacher', '0191'); ?>
                    </td>
                    <td>
                        <div id="motiv"></div>
                    </td>
                </tr>
            </table>
        </div>
        <div class="responseError">
            <?php if(Yii::app()->user->hasFlash('responseError')):
                echo Yii::app()->user->getFlash('responseError');
            endif; ?>
        </div>
        <div class="BBCode">
            <form  action="<?php echo Yii::app()->createUrl('profile/response', array('id' => $model->teacher_id));?>" method="post">
                <textarea class="editor" name="response"></textarea>
                <input type="hidden" id="rat1" name="material" value="<?php echo $knowval; ?>"/>
                <input type="hidden" id="rat2" name="behavior" value="<?php echo $behval; ?>"/>
                <input type="hidden" id="rat3" name="motiv" value="<?php echo $motivval; ?>"/>
                <input name="sendResponse" id="lessonTask1" type="submit" value="<?php echo Yii::t('teacher', '0192'); ?>">
                <?php if(Yii::app()->user->hasFlash('messageResponse')):
                    echo Yii::app()->user->getFlash('messageResponse');
                endif; ?>
            </form>
        </div>
    </div>
</div>
<?php } ?>
<script type="text/javascript">

    $.fn.raty.defaults.path = "<?php echo Yii::app()->request->baseUrl; ?>/images/rating/";

    $('#material').raty({
        score: <?php echo $knowldg; ?>,
        click: function(score) {
            document.getElementById('rat1').value = score;
        }
    });

    $('#behavior').raty({
        score: <?php echo $behvr; ?>,
        click: function(score) {
            document.getElementById('rat2').value = score;
        }
    });
    $('#motiv').raty({
        score: <?php echo $motivtn; ?>,
        click: function(score) {
            document.getElementById('rat3').value = score;
        }
    });
</script>
