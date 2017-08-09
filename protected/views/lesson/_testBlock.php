<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 03.12.2015
 * Time: 17:36
 */
$optionsNum = TestsAnswers::getOptionsNum($data['id_block']);
$options = TestsAnswers::getOptions($data['id_block']);
$testType = Tests::getTestType($data['id_block']);
?>
<div>
    <div class="lessonTest">
        <div class="instrTestImg">
            <div ng-class="{quizDone: pageData[(currentPage || lastAccessPage)-1].isQuizDone}"></div>
        </div>
        <div class="contentTest">
            <div class="instrTestText" id="<?php echo "t" . $data['block_order']; ?>">
                <div ng-non-bindable>
                    <?php echo $data['html_block']; ?>
                </div>
            </div>
            <br>
            <div ng-non-bindable>
            <table class='answerTable' id="<?php echo "answers" . $data['block_order']; ?>">
                <?php if ($testType == 1) {
                    for ($i = 1; $i <= $optionsNum; $i++) {
                        ?>
                        <tr>
                            <td>
                                <input id="<?php echo TestsAnswers::getAnswerKey($data['id_block'])[$i - 1]; ?>"
                                       type="radio"
                                       name="radioanswer" class="answer"
                                >
                            </td>
                            <td>
                                <?php echo $options[$i - 1]["answer"]; ?>
                            </td>
                        </tr>
                    <?php }
                } elseif ($testType == 2) {
                    for ($j = 1; $j <= $optionsNum; $j++) {
                        ?>
                        <tr>
                            <td>
                                <input id="<?php echo TestsAnswers::getAnswerKey($data['id_block'])[$j - 1]; ?>"
                                       type="checkbox"
                                       name="checkboxanswer" class="answer"
                                >
                            </td>
                            <td>
                                <?php echo $options[$j - 1]["answer"]; ?>
                            </td>
                        </tr>
                    <?php }
                }
                ?>
            </table>
            </div>
            <div ng-controller="testCtrl">
                <img style="display: none" id="ajaxLoad" src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'ajax.gif'); ?>" />
                <button class="testSubmit" ng-click='sendTestAnswer(
                <?php echo $data['block_order']; ?>,
                "<?php echo Tests::getTypeButton($testType); ?>",
                <?php echo Tests::getTestId($data['id_block']) ?>,
                <?php echo $testType; ?>,
                <?php echo ($editMode) ? 1 : 0; ?>
                    );' <?php if (0) {
                    echo "disabled";
                } ?> >
                    <?php echo $buttonName; ?>
                </button>
            </div>
        </div>
    </div>
</div>
