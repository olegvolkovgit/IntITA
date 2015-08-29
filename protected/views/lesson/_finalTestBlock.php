<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 16.07.2015
 * Time: 20:09
 */
?>
<div class="element">
<?php
$optionsNum = TestsHelper::getOptionsNum($data['id_block']);
$options = TestsHelper::getOptions($data['id_block']);
$testType = TestsHelper::getTestType($data['id_block']);
?>
    <div>
        <?php $this->renderPartial('_editToolbar', array(
            'idLecture' => $data['id_lecture'],
            'order' =>  $data['block_order'],
            'idBlock' => $data['id_block'],
            'editMode' => $editMode,
        ));
        ?>

        <div class="lessonTest">
<!--            <img class="lessonButFinal"-->
<!--                 src="--><?php //echo StaticFilesHelper::createPath('image', 'lecture', 'lessButton.png'); ?><!--">-->
<!---->
<!--            <div class="lessonButFinal" unselectable="on">--><?php //echo Yii::t('lecture', '0566');?><!--</div>-->
<!--            <div class="lessonLine"></div>-->
            <div class="lessonBG">
                <div class="instrTestImg">
                    <img src="<?php echo LectureHelper::getTestIcon($user, $data['id_block'], $editMode); ?>">
                </div>
                <div class="contentTest">
                    <div class="instrTestText" id="<?php echo "t" .  $data['block_order'];?>" onclick="function(){order = this.id;}">
                        <?php echo $data['html_block']; ?>
                    </div>
                    <br>
                    <div id="<?php echo "answers" .  $data['block_order'];?>">
                        <?php if($testType == 1){
                            for($i = 1;$i <= $optionsNum; $i++){?>
                                <input id="<?php echo TestsHelper::getAnswerKey($data['id_block'])[$i-1]; ?>" type="radio" name="radioanswer" class="answer" value="<?php echo $options[$i-1]["answer"]; ?>"> <?php echo $options[$i-1]["answer"]; ?><br>
                            <?php }
                        } elseif ($testType == 2){
                            for($j = 1; $j <= $optionsNum; $j++){?>
                                <input id="<?php echo TestsHelper::getAnswerKey($data['id_block'])[$j-1]; ?>" type="checkbox" name="checkboxanswer"  class="answer" value="<?php echo $options[$j-1]["answer"]; ?>"> <?php echo $options[$j-1]["answer"]; ?><br>
                            <?php }
                        }
                        ?>
                    </div>
                    <button class="testSubmit" onclick='sendTestAnswer(
                        $("<?php echo "#answers" .  $data['block_order'].' ';?> <?php echo TestsHelper::getTypeButton($testType);?>"),
                        <?php echo $user;?>,
                        <?php echo TestsHelper::getTestId($data['id_block'])?>,
                        <?php echo $testType;?>,
                        <?php echo ($editMode)?1:0;?>
                        );' <?php if($editMode || $user == 0){ echo "disabled";}?> >
                        <?php echo Yii::t('lecture', '0089'); ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
