<?php
/* @var $this DefaultController */
?>
<div class="row">
    <div class="col-lg-4">
        <div class="panel panel-green">
            <div class="panel-heading">
                Головне
            </div>
            <div class="panel-body">
                <ul>
                    <li><a href="#"
                           onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_accountant/agreements/index'); ?>',
                               'Список договорів')">
                            Список договорів</a>
                    </li>
                    <li><a href="#" onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_accountant/invoices/index'); ?>',
                            'Список рахунків')">
                            Список рахунків</a>
                    </li>
                    <li><a href="#"
                           onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_accountant/operation/index'); ?>',
                               'Проплати')">
                            Проплати</a>
                    </li>
                </ul>
                <br>
            </div>
            <div class="panel-footer">
                <em>Основні операції</em>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                Компанії
            </div>
            <div class="panel-body">
                <ul>
                    <li>
                        <a href="#"
                           onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_accountant/company/index'); ?>',
                               'Компанії')">Компанії
                        </a>
                    </li>
                    <li>
                        <a href="#"
                           onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_accountant/representative/index'); ?>',
                               'Представники')">
                            Представники
                        </a>
                    </li>
                </ul>
                <br>
                <br>
            </div>
            <div class="panel-footer">
                <em>Компанії та їх представники</em>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Налаштування
            </div>
            <div class="panel-body">
                <ul>
                    <li><a href="#"
                           onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_accountant/template/index'); ?>',
                               'Шаблони, оферта')">Шаблони, оферта
                        </a>
                    </li>
                    <li><a href="#"
                           onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_accountant/operationType/index'); ?>',
                               'Типи проплат')">
                            Типи проплат</a>
                    </li>
                    <li><a href="#"
                           onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_accountant/externalSources/index'); ?>',
                               'Зовнішні джерела коштів')">
                            Зовнішні джерела коштів</a></li>
                    <li><a href="#"
                           onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_accountant/cancelReasonType/index'); ?>',
                               'Причини відміни проплат')">
                            Причини відміни проплат</a></li>
                </ul>
            </div>
            <div class="panel-footer">
                <em>Налаштування параметрів проплат</em>
            </div>
        </div>
    </div>
</div>

