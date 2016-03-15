<?php if($data['id_type'] == 5 || $data['id_type'] == 6){?>
    <?php
    $taskId=Task::getTaskId($data['id_block']);
    $intServer=htmlspecialchars(json_encode(Config::getInterpreterServer()));
    ?>
    <div class="element">
        <div class="lessonTask">
            <div class="lessonBG">
                <div class="instrTestImg">
                    <div ng-class="{quizDone: pageData[(currentPage || lastAccessPage)-1].isQuizDone}"></div>
                </div>
                <div class="content"  ng-controller="taskCtrl">
                    <img style="display: none" id="ajaxLoad" src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'ajax.gif'); ?>" />
                    <div class="instrTaskText" id="<?php echo "t" . $data['block_order'];?>" >
                        <div ng-non-bindable>
                            <?php echo $data['html_block'];?>
                        </div>
                        <img ng-click='getVariables(<?php echo $taskId; ?>,<?php echo $intServer; ?>)' style="float:right; cursor: pointer;" src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'arrows.png'); ?>" title="Показати/приховати вхідні змінні" />
                        <div id="taskVariables">
                            <em ng-if="variables.length==0">Вхідних змінних немає</em>
                            <div ng-repeat="variable in variables track by $index">
                                <b>{{variable.arg}}</b>: тип - {{variable.type}}<span ng-if="variable.array">, {{variable.size}}-вимірний масив</span>
                            </div>
                        </div>
                    </div>
                    <form class="sendAnswer" id="sendAnswer" name="taskForm">
                        <textarea class='lectureTextarea' placeholder='<?php echo Yii::t('lecture','0663'); ?>' name="code" id="code<?php echo $data['block_order'];?>" required></textarea>
                    </form>
                    <button class="taskSubmit" ng-click="sendTaskAnswer('<?php echo $taskId; ?>',
                            '<?php echo Task::getTaskLang($data['id_block']);?>',<?php echo $intServer ?>,$event,'<?php echo $user ?>')" >
                            <?php echo $buttonName; ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php }else{
    echo 'До цієї сторінки лекції завдання не додано.';
}?>

<script>
    sendCodeMirror = CodeMirror.fromTextArea(document.getElementById('code<?php echo $data['block_order'];?>'), {
        lineNumbers: true,             // показывать номера строк
        matchBrackets: true,             // подсвечивать парные скобки
        mode: "javascript",
        theme: "rubyblue",               // стиль подсветки
        indentUnit: 4                    // размер табуляции
    });
    setTimeout(function() {
        sendCodeMirror.refresh();
    }, 1000);
</script>
