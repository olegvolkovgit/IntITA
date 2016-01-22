<?php if($data['id_type'] == 5 || $data['id_type'] == 6){?>
    <div class="element">
        <div class="lessonTask">
            <div class="lessonBG">
                <div class="instrTaskImg">
                    <div ng-class="{quizDone: pageData[(currentPage || lastAccessPage)-1].isQuizDone}"></div>
                </div>
                <div class="content">
                    <div class="instrTaskText" id="<?php echo "t" . $data['block_order'];?>" >
                        <br/>
                        <?php echo $data['html_block'];?>
                    </div>
                    <form class="sendAnswer" id="sendAnswer">
                        <textarea class='lectureTextarea' placeholder='<?php echo Yii::t('lecture','0663'); ?>' name="code" id="code<?php echo $data['block_order'];?>"></textarea>
                    </form>
                    <div ng-controller="taskCtrl">
                        <button class="taskSubmit" <?php if ($user == 0 || $editMode) echo " disabled";?>
                                ng-click="sendTaskAnswer('<?php echo $user.date("Y-m-d-h-i-sa");?>',
                            'code<?php echo $data['block_order'];?>',
                            '<?php echo Task::getTaskId($data['id_block']);?>',
                            '<?php echo Task::getTaskLang($data['id_block']);?>')" >
                            <?php echo Yii::t('lecture','0089'); ?>
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php }else{
    echo 'До цієї сторінки лекції завдання не додано.';
}?>
