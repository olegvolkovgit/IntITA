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
                    <small><p class="text"><img src="<?php echo StaticFilesHelper::createPath('image', 'graduates', 'Graduates.jpg');?>">Випуск:&nbsp;<span style="color: #4B75A4;">12 червня 2015</span></small></p>
                    <p p class="text1"><big>Роксана Остапівна Соковита</big></p>
                    <p class="text">Посада:&nbsp;<span style="color: #4B75A4;">Інтернет-программіст, самого середнього рівня</span></p>
                    <p class="text">Місце роботи:&nbsp;<span style="color: #4B75A4;">www.google.com</span></p>
                    <p class="text">Курс:&nbsp;<span style="color: #4B75A4;">Інтернет-программіст(PHP), початківець, та ще трохи</span></br>
                    <span style="color: #4B75A4;">Початкове навчання баз данних та овощних баз</span></p>
                    <?php echo $this->renderPartial('_educateHistory');?>
                </td>
            </tr>
        </table>
    </div>