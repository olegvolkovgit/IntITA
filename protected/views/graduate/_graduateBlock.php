<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 14.05.2015
 * Time: 18:34
 */
?>

    <div class="GraduatesBlock">
        <table>
            <tr>
                <td>
                    <small><p class="text"><img src="<?php echo StaticFilesHelper::createPath('image', 'graduates', $data['avatar']);?>">Випуск:&nbsp;<span style="color: #4B75A4;"><?php echo $data['graduate_date'] ?></span></small></p>
                    <p p class="text1"><big><?php echo $data['full_name'] ?></big></p>
                    <p class="text">Посада:&nbsp;<span style="color: #4B75A4;"><?php echo $data['position'] ?></span></p>
                    <p class="text">Місце роботи:&nbsp;<span style="color: #4B75A4;"><?php echo $data['work_place'] ?></span></p>
                    <p class="text">Курс:&nbsp;<span style="color: #4B75A4;"><?php echo $data['courses'] ?></span></br>
                    <span style="color: #4B75A4;"><?php echo $data['history'] ?></span></p>
                    <?php echo $this->renderPartial('_educateHistory', array('data' =>$data));?>
                </td>
            </tr>
        </table>
    </div>