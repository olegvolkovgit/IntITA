<div class="GraduatesBlock">
    <table>
        <tr>
            <td style="vertical-align: top;">
                <img src="<?php echo StaticFilesHelper::createPath('image', 'graduates', $data['avatar']); ?>">
            </td>

            <td style="padding-left: 10px;">
                <div class="text">
                    Випуск:&nbsp;<span style="color: #4B75A4;"><?php echo $data['graduate_date'] ?></span>
                </div>
                <div class="text1"><?php echo $data['first_name'],"&nbsp;", $data['last_name'] ?></div>

                <div>
                    <div class="spoiler-title closed">Розгорнути відгук про навчання &#9660;</div>
                    <div class="spoiler-body">
                        <img src="<?php echo StaticFilesHelper::createPath('image', 'graduates', "recall.png"); ?>">
                        <?php echo $data['recall'] ?>
                    </div>
                </div>
                <div class="text">
                    <div>Посада:&nbsp;
                        <span style="color: #4B75A4;"><?php echo $data['position'] ?></span>
                    </div>
                    <div>Місце роботи:&nbsp;
                        <a style="color: #4B75A4;" href="<?php echo $data['work_site'] ?>"
                           target="_blank"> <?php echo $data['work_place'] ?> </a>
                    </div>
                    <div>Курс закінчив:&nbsp;
                        <a style="color: #4B75A4;" href="<?php echo $data['courses_page'] ?>"
                           target="_blank"> <?php echo $data['courses'] ?> </a>
                    </div>
                </div>
                <?php echo $this->renderPartial('_educateHistory', array('data' => $data)); ?>
            </td>
        </tr>
    </table>
</div>