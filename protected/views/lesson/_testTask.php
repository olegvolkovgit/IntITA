<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 16.07.2015
 * Time: 20:09
 */
?>
<?php
$optionsnum = 5;
$ask='Скільки ніг у корови?';
$testtype=2;
?>
    <div>
        <!--    --><?php //$this->renderPartial('_editToolbar', array(
        //        'idLecture' => $data['id_lecture'],
        //        'order' =>  $data['block_order'],
        //        'editMode' => $editMode,
        //    ));
        ?>

        <div class="lessonTest">
            <img class="lessonBut"
                 src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'lessButton.png'); ?>">

            <div class="lessonButName" unselectable="on">Тест</div>
            <div class="lessonLine"></div>
            <div class="lessonBG">
                <div class="instrTestImg">
                    <img src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'task.png'); ?>">
                </div>
                <div class="contentTest">
                    <div class="instrTestText" id="">
                        <?php echo $ask ?>
                    </div>
                    <div >
                        <?php if($testtype==1){
                            for($i=1;$i<=$optionsnum;$i++){?>
                                <input type="radio" name="radioanswer" value="<?php echo $i ?>"> Тестова відповідь №<?php echo $i ?><br><br>
                            <?php }
                        } elseif ($testtype==2){
                            for($j=1;$j<=$optionsnum;$j++){?>
                            <input type="checkbox" name="checkboxanswer" value="<?php echo $j ?>"> Тестова відповідь №<?php echo $j ?><br><br>
                        <?php }
                        }
                        ?>
                    </div>
                    <button class="testSubmit" onclick=''><?php echo Yii::t('lecture', '0089'); ?></button>
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