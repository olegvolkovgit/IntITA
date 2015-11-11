<?php
$optionsNum = TestsHelper::getOptionsNum($data['id_block']);
$options = TestsHelper::getOptions($data['id_block']);
$testType = TestsHelper::getTestType($data['id_block']);
?>
<div>
    <div class="lessonTest">
        <div class="instrTestImg">
            <img src="<?php echo LectureHelper::getTestIcon($user, $data['id_block'], $editMode); ?>">
        </div>
        <div class="contentTest">
            <div class="instrTestText" id="<?php echo "t" . $data['block_order']; ?>" >
                <?php echo $data['html_block']; ?>
            </div>
            <br>

            <div id="<?php echo "answers" . $data['block_order']; ?>">
                <?php if ($testType == 1) {
                    for ($i = 1; $i <= $optionsNum; $i++) {
                        ?>
                        <input id="<?php echo TestsHelper::getAnswerKey($data['id_block'])[$i - 1]; ?>" type="radio"
                               name="radioanswer" class="answer" value="<?php echo $options[$i - 1]["answer"]; ?>">
                        <label><?php echo $options[$i - 1]["answer"]; ?></label><br>
                    <?php }
                } elseif ($testType == 2) {
                    for ($j = 1; $j <= $optionsNum; $j++) {
                        ?>
                        <input id="<?php echo TestsHelper::getAnswerKey($data['id_block'])[$j - 1]; ?>" type="checkbox"
                               name="checkboxanswer" class="answer" value="<?php echo $options[$j - 1]["answer"]; ?>">
                        <label><?php echo $options[$j - 1]["answer"]; ?></label> <br>
                    <?php }
                }
                ?>
            </div>
            <button class="testSubmit" onclick='sendTestAnswer(
                $("<?php echo "#answers" . $data['block_order'] . ' '; ?> <?php echo TestsHelper::getTypeButton($testType); ?>"),
            <?php echo $user; ?>,
            <?php echo TestsHelper::getTestId($data['id_block']) ?>,
            <?php echo $testType; ?>,
            <?php echo ($editMode) ? 1 : 0; ?>
                );' <?php if ($editMode) {
                echo "disabled";
            } ?> >
                <?php echo Yii::t('lecture', '0089'); ?>
            </button>
        </div>
    </div>
</div>

