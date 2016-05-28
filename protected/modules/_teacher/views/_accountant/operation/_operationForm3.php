<div id="operationForm3">
    <form method="POST" name="newOperation">
        <fieldset form="newOperation" title="Пошук договора">
            <br>
            <form class="form-inline">
                <div class="input-group  col-sm-4">
                    <div class="input-group-addon">@</div>
                    <input type="text" class="form-control" name="userEmail" id="userEmail"
                           onkeyup="getUserList('<?php echo Yii::app()->createUrl('/_teacher/_accountant/operation/getUser'); ?>')"
                           placeholder="Введіть e-mail користувача">
                </div>
            </form>
        </fieldset>
    </form>
    <div name="userList" id="userList">
        <?php $this->renderPartial('_ajaxUser', array('users' => '')); ?>
    </div>
    <div name="userAgreement" id="userAgreement">
        <?php $this->renderPartial('_ajaxAgreement', array('agreements' => '')); ?>
    </div>
    <form action="<?php echo Yii::app()->createUrl('/_teacher/_accountant/operation/createByInvoice'); ?>"
          method="POST" onsubmit="return checkInvoices('<?php echo Yii::app()->createUrl('/_teacher/_accountant/operation/getInvoicesByNumber'); ?>')">
        <input type="number" name="user" value="<?php echo Yii::app()->user->getId(); ?>" hidden="hidden">
        <input type="number" name="type" value="1" hidden="hidden">
        <input type="number" name="source" value="1" hidden="hidden">
        <fieldset>
            <div name="selectUserInvoices" id="selectUserInvoices">
                <?php $this->renderPartial('_ajaxInvoices', array('invoices' => '')); ?>
            </div>
            <br/>
            <div class="col-sm-8">
                <div class="form-inline">
                    <div class="input-group  col-sm-6">
                        <div class="input-group-addon" id="icon">uah</div>
                        <input type="number" name="user" value="<?php echo Yii::app()->user->getId(); ?>"
                               hidden="hidden">
                        <input type="number" name="type" value="1" hidden="hidden">
                        <input type="number" name="source" value="1" hidden="hidden">
                        <input type="number" name="summa" value="" class="form-control" required
                               placeholder="Введіть суму оплати"/>
                    </div>
                </div>
                <br/>
                <button type="submit" class="btn btn-primary">Додати</button>
            </div>
        </fieldset>
    </form>
</div>


