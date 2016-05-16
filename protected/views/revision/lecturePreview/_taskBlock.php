<?php if($data['id_type'] == 5 || $data['id_type'] == 6){?>
    <?php
    $task=RevisionTask::model()->findByAttributes(array('id_lecture_element' => $data['id']));
    $taskId=$task->uid;
    $taskLang=$task->language;
    $intServer=htmlspecialchars(json_encode(Config::getInterpreterServer()));
    ?>
    <div class="element">
        <div class="lessonTask">
            <div class="lessonBG">
                <div class="instrTestImg">
                    <div ng-class="{quizDone: pageData[(currentPage || lastAccessPage)-1].isQuizDone}"></div>
                </div>
                <div class="content"  ng-controller="taskCtrl" ng-init="init('<?php echo $taskLang ?>')">
                    <div class="instrTaskText" id="<?php echo "t" . $data['block_order'];?>" >
                        <div ng-non-bindable>
                            <?php echo $data['html_block'];?>
                        </div>
                        <img ng-click='getVariables(<?php echo $taskId; ?>,<?php echo $intServer; ?>)' style="float:right; cursor: pointer;" src="<?php echo StaticFilesHelper::createPath('image', 'lecture', 'information.png'); ?>" title="Показати/приховати вхідні змінні" />
                        <div id="taskVariables">
                            <em ng-if="variables.input_variables.length!=0">Вхідні змінні:</em>
                            <div ng-repeat="variable in variables.input_variables track by $index">
                                <b>{{variable.arg}}</b>: {{variable.type}}<span ng-if="variable.array">, {{variable.size}}-вимірний масив</span>
                            </div>
                            <em>Вихідний результат:</em>
                            <div>
                                {{variables.res_type}}<span ng-if="variables.res_array">, {{variables.res_size}}-вимірний масив</span>
                            </div>
                        </div>
                    </div>
                    <form class="sendAnswer" id="sendAnswer" name="taskForm">
                        <ui-codemirror ui-codemirror="{ onLoad : codemirrorLoaded }" ui-codemirror-opts="codeMirrorOptions" ng-model="userCode" ui-refresh='refreshCodemirror'></ui-codemirror>
                    </form>
                    <button class="taskSubmit" ng-click="sendTaskAnswer('<?php echo $taskId; ?>',
                            '<?php echo $taskLang;?>',<?php echo $intServer ?>,$event)" >
                            <?php echo $buttonName; ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php }else{
    echo 'До цієї сторінки лекції завдання не додано.';
}?>


