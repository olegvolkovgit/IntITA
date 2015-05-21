<div class="GraduatesBlock">
    <table>
        <tr>
            <td style="vertical-align: top;">
                <img src="<?php echo StaticFilesHelper::createPath('image', 'graduates', $data['avatar']);?>">
            </td>

            <td >
                <div class="text"> Випуск:&nbsp;<span style="color: #4B75A4;"><?php echo $data['graduate_date'] ?></span></div>


                <div  class="text1"><?php echo $data['full_name'] ?></div>

                <div class="text">Посада:&nbsp; <span style="color: #4B75A4;"><?php echo $data['position'] ?></span></div>
                <p class="text">Місце роботи:&nbsp;<span style="color: #4B75A4;"><?php echo $data['work_place'] ?></span></p>
                <p class="text">Курс:&nbsp;<span style="color: #4B75A4;"><?php echo $data['courses'] ?></span></br>
                    <span style="color: #4B75A4;"><?php echo $data['history'] ?></span></p>
                <?php echo $this->renderPartial('_educateHistory', array('data' =>$data));?>
            </td>
        </tr>
    </table>
</div>