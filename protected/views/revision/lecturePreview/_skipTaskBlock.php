<?php
/**
 * Created by PhpStorm.
 * User: Quicks
 * Date: 25.11.2015
 * Time: 20:20
 */

?>

<?php if($data['id_type'] == 9){ ?>

    <div ng-controller="skipTaskCtrl">
        <div class="lessonTest">
            <div class="instrTaskImg">
                <div ng-class="{quizDone: pageData[(currentPage || lastAccessPage)-1].isQuizDone}"></div>
            </div>
            <div class="content">
                <div class="instrTaskText" id="<?php echo "t" . $data['block_order'];?>" >
                    <div ng-non-bindable>
                        <?php echo $data['html_block'];?>
                    </div>
                </div>
                <form class="sendAnswer" id="sendAnswer">
                    <div id="skipTaskQuestion">
                        <div ng-non-bindable>
                            <?php echo $data->getSkipTaskQuestion(); ?>
                        </div>
                    </div>
                </form>
                <div>
                    <button class="taskSubmit"
                            ng-click="sendSkipTaskAnswer(<?php echo $data->id ?>)" >
                        <?php echo $buttonName; ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
<?php }else{
    echo 'До цієї сторінки лекції завдання не додано.';
}?>

<?php
?>
