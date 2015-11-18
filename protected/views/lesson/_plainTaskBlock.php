<?php if($data['id_type'] == 6){?>
    <div class="element">
        <div class="lessonTask">
            <div class="lessonBG">
                <div class="instrTaskImg">
                    <img src="<?php echo PlainTask::getPlainTaskIcon($user, $data['id_block'], $editMode);?>">
                </div>
                <div class="content">
                    <div class="instrTaskText" id="<?php echo "t" . $data['block_order'];?>" onclick="function(){order = this.id;}">
                        <br/>
                        <?php echo $data['html_block'];?>
                    </div>
                    <form class="sendAnswer" id="sendAnswer">
                        <textarea placeholder='<?php echo Yii::t('lecture','0663'); ?>' name="answer" id="code<?php echo $data['block_order'];?>"></textarea>
                    </form>
<!--                    --><?php //var_dump($data);die; ?>
                    <button class="taskSubmit" <?php if ($user == 0 || $editMode) echo " disabled";?>
                            onclick="sendPlainTaskAnswer(<?php echo $data->id_block?>)" >
                        <?php echo Yii::t('lecture','0089'); ?>
                    </button>
                </div>

            </div>
        </div>
    </div>
<?php }else{
    echo 'До цієї сторінки лекції завдання не додано.';
}?>