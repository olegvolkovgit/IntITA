<?php if($data['id_type'] == 5 || $data['id_type'] == 6){?>
    <div class="element">
        <div class="lessonTask">
            <div class="lessonBG">
                <div class="instrTaskImg">
                    <div ng-class="{quizDone: pageData[(currentPage || lastAccessPage)-1].isQuizDone}"></div>
                </div>
                <div class="content"  ng-controller="taskCtrl">
                    <div ng-init="interpreterServer=<?php echo htmlspecialchars(json_encode(Config::getInterpreterServer())); ?>" ng-model="interpreterServer" ></div>
                    <img style="display: none" id="ajaxLoad" src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'ajax.gif'); ?>" />
                    <div class="instrTaskText" id="<?php echo "t" . $data['block_order'];?>" >
                        <br/>
                        <div ng-non-bindable>
                            <?php echo $data['html_block'];?>
                        </div>
                    </div>
                    <form class="sendAnswer" id="sendAnswer" name="taskForm">
                        <textarea class='lectureTextarea' placeholder='<?php echo Yii::t('lecture','0663'); ?>' name="code" id="code<?php echo $data['block_order'];?>" ng-model="userCode" required></textarea>
                        <div>
                            <span id="flashMsg"
                                  ng-class="{'hideFlash' : !(taskForm.code.$pristine || taskForm.code.$error.required) }">
                                Відповідь не може бути пустою
                            </span>
                        </div>
                    </form>
                    <button class="taskSubmit" <?php if ($user == 0 || $editMode) echo " disabled";?>
                                ng-click="sendTaskAnswer('<?php echo Task::getTaskId($data['id_block']);?>',
                            '<?php echo Task::getTaskLang($data['id_block']);?>',interpreterServer,$event,'<?php echo $user ?>')" >
                            <?php echo $buttonName; ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php }else{
    echo 'До цієї сторінки лекції завдання не додано.';
}?>
