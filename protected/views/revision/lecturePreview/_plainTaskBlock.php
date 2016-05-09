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
                        <div ng-non-bindable>
                            <?php echo $data['html_block']; ?>
                        </div>
                    </div>
                    <form class="sendAnswer" id="sendAnswer" name="plainTaskForm">
                        <textarea placeholder='<?php echo Yii::t('lecture', '0663'); ?>' name="answer"
                                  id="code<?php echo $data['block_order']; ?>" ng-model="plainTask" required></textarea>
                        <div>
                            <span id="flashMsg"
                                  ng-class="{'hideFlash' : !(plainTaskForm.answer.$pristine || plainTaskForm.answer.$error.required) }">
                                <?php echo Yii::t('validation', '0805'); ?>
                            </span>
                        </div>
                    </form>
                    <div>
                        <button class="taskSubmit" style="background: grey" <?php echo "disabled"; ?> >
                            <?php echo $buttonName; ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } else {
    echo 'До цієї сторінки лекції завдання не додано.';
} ?>