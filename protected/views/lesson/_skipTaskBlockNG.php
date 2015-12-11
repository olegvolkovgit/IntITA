<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 25.11.2015
 * Time: 20:20
 */

?>

<?php if($data['id_type'] == 9){ ?>

    <div class="element">
        <div class="lessonTask">
            <div class="lessonBG">
                <div class="instrTaskImg">
                    <div ng-class="{quizDone: pageData[(currentPage || lastAccessPage)-1].isQuizDone}"></div>
                </div>
                <div class="content">
                    <div class="instrTaskText" id="<?php echo "t" . $data['block_order'];?>" onclick="function(){order = this.id;}">
                        <br/>
                        <?php echo $data['html_block'];?>
                    </div>
                    <form class="sendAnswer" id="sendAnswer">
                        <div id="skipTaskQuestion">
                            <?php echo $data->getSkipTaskQuestion(); ?>
                        </div>
                    </form>
                    <div ng-controller="skipTaskCtrl">
                        <button class="taskSubmit" <?php if ($user == 0) echo " disabled";?>
                                ng-click="sendSkipTaskAnswer(<?php echo $data->id_block ?>)" >
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

<?php
?>
