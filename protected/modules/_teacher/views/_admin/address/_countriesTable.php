<?php
/**
 *
 */
?>
<div class="col-lg-12">
    <br>
<!--
    <button class="btn btn-primary"
            onclick="load('<?php echo Yii::app()->createUrl('/_teacher/_admin/address/addCountry');?>',
                'Додати країну')">Додати країну
    </button>
     -->
    <br>
    <br>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="dataTable_wrapper">
                <table class="table table-striped table-bordered table-hover" id="countriesTable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Українською</th>
                        <th>Російською</th>
                        <th>Англійською</th>
                        <th>Геокод</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
