<?php
/* @var $data LectureElement */
if ($data['id_type'] == 6) {
    ?>
    <div class="element" ng-controller="plainTaskCtrl">
        <div class="lessonTask">
            <div class="lessonBG">
                <div class="instrTaskImg">
                    <div ng-class="{quizDone: pageData[(currentPage || lastAccessPage)-1].isQuizDone}"></div>
                </div>
                <div class="content">
                    <div class="instrTaskText" id="<?php echo "t" . $data['block_order']; ?>">
                        <br/>
                        <?php echo $data['html_block']; ?>
                    </div>
                    <form class="sendAnswer" id="sendAnswer" name="plainTaskForm">
                        <textarea placeholder='<?php echo Yii::t('lecture', '0663'); ?>' name="answer"
                                  id="code<?php echo $data['block_order']; ?>" ng-model="plainTask" required></textarea>
                        <div>
                            <span id="flashMsg"
                                  ng-class="{'hideFlash' : !(plainTaskForm.answer.$pristine || plainTaskForm.answer.$error.required) }">
                                Відповідь не може бути пустою
                            </span>
                        </div>
                    </form>
                    <div>
                        <button class="taskSubmit" <?php if ($user == 0 || $editMode) echo " disabled"; ?>
                                ng-click="sendPlainTaskAnswer(<?php echo $data->id_block ?>)">
                            <?php echo Yii::t('lecture', '0089'); ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } else {
    echo 'До цієї сторінки лекції завдання не додано.';
} ?>