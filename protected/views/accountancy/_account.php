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
                №2777001- <?php echo Course::model()->findByPk($account->id_course)->title_ua . ', '.
                    CourseHelper::translateLevelUa($account->id_course); ?>)
            </td>
            <td></td>
            <td>1</td>
            <td></td>
            <td></td>
            <td><span id="summa"><?php echo CourseHelper::getPriceUah($account->id_course);?></span></td>
        </tr>
         <tr style="border: none;">
            <td colspan="6" style="border: none;text-align: left">
                Всього до сплати (прописом):
                <br>
                <b><span id="summaLetters"></span></b>
                <div id="all">Разом з ПДВ до сплати</div>
            </td>
            <td><?php echo CourseHelper::getPriceUah($account->id_course);?></td>
        </tr>
    </table>
