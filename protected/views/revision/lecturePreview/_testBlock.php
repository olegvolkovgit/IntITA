<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 03.12.2015
 * Time: 17:36
 */
$test=RevisionTests::model()->findByAttributes(array('id_lecture_element' => $data['id']));
$answers=$test->testAnswers();
$testType = $test->getTestType();
?>
<div>
    <div class="lessonTest">
        <div class="instrTestImg">
            <div></div>
        </div>
        <div class="contentTest">
            <div class="instrTestText">
                <div ng-non-bindable>
                    <?php echo $data['html_block']; ?>
                </div>
            </div>
            <br>
            <div ng-non-bindable>
            <table class='answerTable' id="<?php echo "answers" . $test->id; ?>">
                <?php if ($testType == 1) {
                    for ($i = 1; $i <= count($test->testAnswers()); $i++) {
                        ?>
                        <tr>
                            <td>
                                <input id="<?php echo $answers[$i-1]['id']; ?>"
                                       type="radio"
                                       name="radioanswer" class="answer"
                                >
                            </td>
                            <td>
                                <?php echo $answers[$i-1]['answer']; ?>
                            </td>
                        </tr>
                    <?php }
                } elseif ($testType == 2) {
                    for ($j = 1; $j <= count($test->testAnswers()); $j++) {
                        ?>
                        <tr>
                            <td>
                                <input id="<?php echo $answers[$j-1]['id']; ?>"
                                       type="checkbox"
                                       name="checkboxanswer" class="answer"
                                >
                            </td>
                            <td>
                                <?php echo $answers[$j-1]['answer']; ?>
                            </td>
                        </tr>
                    <?php }
                }
                ?>
            </table>
            </div>
            <div ng-controller="testCtrl">
                <button class="testSubmit" ng-click='sendTestAnswer(<?php echo $test->id ?>,<?php echo $testType; ?>);' >
                    <?php echo $buttonName; ?>
                </button>
            </div>
        </div>
    </div>
</div>
