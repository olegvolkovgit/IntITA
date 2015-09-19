<?php
/*
 * @var $course Course
 * */
?>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'account.css'); ?>"/>
<?php if (!isset($_GET['print'])) {
    Yii::app()->clientScript->registerScriptFile(StaticFilesHelper::fullPathTo('js', 'account.js'));
} ?>

<div id="account">
    <div>
        <br>
        Отримувач коштів: ТОВ «Вінницька ІТ-Академія»
        <br>
        Банк: <span id="bankTitle">АТ «ОТП Банк»</span>
        <br>
        МФО 300528 р/р 26005001352431 код ЄДРПОУ 33263663
        <br>
        Адреса 21007, м. Вінниця, вул. Фрунзе, 4, тел. 555-220.
        <br>
        <br>
        “<?php echo date("d"); ?>” <span id="month"><?php
            if (isset($_GET['month'])) {
                echo $_GET['month'];
            } else {
                echo date("F");
            } ?></span> 2015 р. <span id="accountTitle">РАХУНОК № _______</span>
        <br>
        Платник:
        <br>
    </div>
    <br>
    <table id="accountTable">
        <tr>
            <td style="width: 30px">№ п/п</td>
            <td style="width: 300px">Назва продукції (послуг)</td>
            <td>Один. виміру</td>
            <td>Кіль- кість</td>
            <td>Довідково ціна з ПДВ</td>
            <td>Ціна без ПДВ</td>
            <td style="width: 70px">Сума</td>
        </tr>
        <tr>
            <td>1</td>
            <td style="text-align: left">Освітні послуги в науково-технічному напрямку - програмування та комп'ютерна
                грамотність (Курс
                №2777001- <?php echo CourseHelper::getCourseName($course->course_ID) . ', ' . CourseHelper::translateLevel($course->level); ?>
                )
            </td>
            <td></td>
            <td>1</td>
            <td></td>
            <td></td>
            <td>40 020,00</td>
        </tr>
        <?php for ($i = 0; $i < 5; $i++) { ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        <?php } ?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td rowspan="2"></td>
        </tr>
        <tr style="border: none;">
            <td colspan="6" style="border: none;text-align: justify">
                Всього до сплати (прописом):
                <div id="count">Сума без ПДВ</div>
            </td>
        </tr>
        <tr style="border: none;">
            <td colspan="6" style="border: none;text-align: justify">
                <b>Вісімнадцять тисяч грн., 00 коп.</b>

                <div id="pdv">ПДВ _____ %</div>
            </td>
            <td></td>
        </tr>
        <tr style="border: none;">
            <td colspan="6" style="border: none;text-align: justify">
                Підпис відповідальної особи
                <div id="visaPlace">_______________</div>
                <div id="all">Разом з ПДВ до сплати</div>
            </td>
            <td>40 020,00</td>
        </tr>
    </table>
    <br>
    <br>
    <br>
    <?php if (!isset($_GET['print'])){ ?>
    <button onclick="sendData('courseId=<?php echo $course->course_ID; ?>&print=true&month=' + month)">
        Надрукувати
    </button>
</div>
<?php } ?>

<?php if (isset($_GET['print'])) { ?>
    <script>
        $(window).load(
            function () {
                window.print();
            }
        )
    </script>
<?php } ?>



