<div class="GraduatesBlock">
    <table>
        <tr>
            <td style="vertical-align: top;">
                <img src="<?php echo StaticFilesHelper::createPath('image', 'graduates', $data['avatar']); ?>">
            </td>
            <td style="padding-left: 10px;">
                <div class="text">
                    <?php echo Yii::t('graduates', '0320')?>
                    <span><?php echo $data['graduate_date'] ?></span>
                </div>
                <div class="text1"><?php echo $data['first_name'],"&nbsp;", $data['last_name'] ?></div>

                <div>
                    <?php $a = 'Розгорнути відгук про навчання &#9660'; ?>

                    <form name=Name>
                        <input type=hidden name=id1 value="<?php echo htmlspecialchars($var=123); ?>">
                    </form>

                    <div class="spoiler-title closed"> <?php echo $a ?> </div>
                    <div class="spoiler-body">
                        <img src="<?php echo StaticFilesHelper::createPath('image', 'graduates', "recall.png"); ?>">
                        <?php echo $data['recall'] ?>
                    </div>
                </div>




                <div class="text">
                    <div>
                        <?php echo Yii::t('graduates', '0316') ?>
                        <span><?php echo $data['position'] ?></span>
                    </div>
                    <div>
                        <?php echo Yii::t('graduates', '0317') ?>
                        <a href="<?php echo $data['work_site'] ?>"
                           target="_blank"> <?php echo $data['work_place'] ?> </a>
                    </div>
                    <div>
                        <?php echo Yii::t('graduates', '0318') ?>
                        <a href="<?php echo $data['courses_page'] ?>"
                           target="_blank"> <?php echo $data['courses'] ?></a>
                    </div>
                </div>
                <?php echo $this->renderPartial('_educateHistory', array('data' => $data)); ?>
            </td>
        </tr>
    </table>
</div>