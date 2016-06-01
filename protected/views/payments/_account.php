<?php
/* @var $model Invoice */
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
        <div class="row">
            <div class="col-sm-2">
                “<?php echo date("d"); ?>” <span id="month"><?php
                    if (isset($_GET['month'])) {
                        echo $_GET['month'];
                    } else {
                        echo date("F");
                    } ?></span> <?php echo " ".date("Y"); ?> р.
            </div>
            <div class="col-sm-5 text-center">
                <span id="accountTitle">РАХУНОК № <?php echo $model->number; ?></span>
                <br>
                <span>від <?=date("d.m.y", strtotime($model->payment_date));?> по договору №<?=$model->getAgreementNumber()?>
                    від <?=date("d.m.y", strtotime($model->agreement->create_date));?></span>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-2"><b>Платник:</b></div>
        </div>
        <br>
    </div>
    <div class="table-responsive col-md-9" style="padding:0;">
        <table id="accountTable" class="table">
            <tr>
                <td class="info">№ п/п</td>
                <td class="info">Назва продукції (послуг)</td>
                <td class="info">Сума,
                    грн
                </td>
            </tr>
            <tr>
                <td>1</td>
                <td style="text-align: left">Освітні послуги в науково-технічному напрямку - програмування та
                    комп'ютерна грамотність (<?php echo CHtml::encode(Invoice::getProductTitle($model)); ?>)
                </td>
                <td><span
                        id="summa"><?php echo number_format(CommonHelper::getPriceUah($model->summa), 2, ",","&nbsp;"); ?></span>
                </td>
            </tr>
            <tr style="border: none;">
                <td colspan="2" style="border: none;text-align: left">
                    Всього до сплати (прописом):
                    <br>
                    <b><span id="summaLetters"></span></b>
                </td>
                <td><?php echo number_format(CommonHelper::getPriceUah($model->summa), 2, ",", "&nbsp;"); ?></td>
            </tr>
        </table>
        <span>Рахунок дійсний протягом <?=Config::getExpirationTimeInterval();?> днів до <?=date("d.m.y", strtotime($model->expiration_date));?></span>
    </div>
</div>


