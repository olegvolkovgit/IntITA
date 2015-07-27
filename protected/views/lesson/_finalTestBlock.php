<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 16.07.2015
 * Time: 20:09
 */
?>
<?php
$optionsNum = TestsHelper::getOptionsNum($data['id_block']);
$options = TestsHelper::getOptions($data['id_block']);
$testType = TestsHelper::getTestType($data['id_block']);
?>
    <div>
        <?php $this->renderPartial('_editToolbar', array(
            'idLecture' => $data['id_lecture'],
            'order' =>  $data['block_order'],
            'editMode' => $editMode,
        ));
        ?>

        <div class="lessonTest">
            <img class="lessonButFinal"
                 src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'lessButton.png'); ?>">

            <div class="lessonButFinal" unselectable="on"><?php echo Yii::t('lecture', '0566');?></div>
            <div class="lessonLine"></div>
            <div class="lessonBG">
                <div class="instrTestImg">
                    <img src="<?php echo LectureHelper::getTestIcon($user, $data['id_block'], $editMode); ?>">
                </div>
                <div class="contentTest">
                    <div class="instrTestText" id="<?php echo "t" .  $data['block_order'];?>" onclick="function(){order = this.id;}">
                        <?php echo $data['html_block']; ?>
                    </div>
                    <br>
                    <div >
                        <?php if($testType == 1){
                            for($i = 1;$i <= $optionsNum; $i++){?>
                                <input type="radio" name="radioanswer" class="answer" value="<?php echo $options[$i-1]["answer"]; ?>"> <?php echo $options[$i-1]["answer"]; ?><br>
                            <?php }
                        } elseif ($testType == 2){
                            for($j = 1; $j <= $optionsNum; $j++){?>
                                <input type="checkbox" name="checkboxanswer"  class="answer" value="<?php echo $options[$j-1]["answer"]; ?>"> <?php echo $options[$j-1]["answer"]; ?><br>
                            <?php }
                        }
                        ?>
                    </div>
                    <button class="testSubmit" onclick='sendTestAnswer(
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

<?php
// use editor WYSIWYG Imperavi
if ($editMode) {
    $this->widget('ImperaviRedactorWidget', array(
        'selector' => "#",
        'options' => array(
            'imageUpload' => $this->createUrl('files/upload'),
            'lang' => 'ua',
            'toolbar' => true,
            'iframe' => true,
            'css' => 'wym.css',
        ),
        'plugins' => array(
            'fullscreen' => array(
                'js' => array('fullscreen.js',),
            ),
            'video' => array(
                'js' => array('video.js',),
            ),
            'fontsize' => array(
                'js' => array('fontsize.js',),
            ),
            'fontfamily' => array(
                'js' => array('fontfamily.js',),
            ),
            'fontcolor' => array(
                'js' => array('fontcolor.js',),
            ),
            'save' => array(
                'js' => array('save.js',),
            ),
            'close' => array(
                'js' => array('close.js',),
            ),
        ),
    ));
}
?>