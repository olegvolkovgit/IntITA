<?php
/* @var $model Invoice*/
?>

<script>
    summa = "<?php echo CommonHelper::getPriceUah($model->summa);?>";
    user = "<?php echo $model->user_created;?>";
</script>
<div id="account">
    <div id="accountTable">
        <br>
        <b>Отримувач коштів:</b> ТОВ «Вінницька ІТ-Академія»
        <br>
        <b>Банк: </b>АТ «ОТП Банк»
        <br>
        <b>МФО </b> 300528<br>
        <b>р/р </b> 26005001352431<br>
        <b>код ЄДРПОУ </b> 33263663
        <br>
        <br>
        <br>
        “<?php echo date("d");?>” <span id="month"><?php
            if (isset($_GET['month'])) {
                echo $_GET['month'];
            } else {
                echo date("F");
            }?></span> 2015 р. <span id="accountTitle">РАХУНОК № <?php echo $model->id;?></span>
        <br>
        Платник:
        <br>
    </div>
    <br>
    <table id="accountTable">
        <tr>
            <td style="width: 30px">№ п/п</td>
            <td style="width: 300px">Назва продукції (послуг)</td>
            <td style="width: 70px">Сума</td>
        </tr>
        <tr>
            <td>1</td>
            <td style="text-align: left">Освітні послуги в науково-технічному напрямку - програмування та комп'ютерна
                грамотність (<?php echo Invoice::getProductTitle($model);?>)
            </td>
            <td><span id="summa"><?php echo number_format(CommonHelper::getPriceUah($model->summa), 2, ",", " ");?></span></td>
        </tr>
         <tr style="border: none;">
            <td colspan="2" style="border: none;text-align: left">
                Всього до сплати (прописом):
                <br>
                <b><span id="summaLetters"></span></b>
            </td>
            <td><?php echo number_format(CommonHelper::getPriceUah($model->summa), 2, ",", " ");?></td>
        </tr>
    </table>
</div>


