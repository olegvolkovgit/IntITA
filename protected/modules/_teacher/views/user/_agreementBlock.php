<div class="agreementBlock">
    <div ng-click="schemesShow[$index]=!schemesShow[$index]" >Згенерувати договір</div>
    <div ng-show="schemesShow[$index]" style="overflow: hidden">
        <div class="row col-md-12">
            Онлайн:
            <payments-scheme
                    data-content-id="service.id"
                    data-service-type="'<?php echo $service?>'"
                    data-education-form="online"
                    data-schemes="onlineSchemeData"
                    data-selected-model-scheme="selectedScheme"
                    data-set-form="setForm"
                    data-set-scheme="schemeId"
                    data-user="<?php echo $model->id?>"
            >
            </payments-scheme>
        </div>
        <div class="row col-md-12">
            Офлайн:
            <payments-scheme
                    data-content-id="service.id"
                    data-service-type="'<?php echo $service?>'"
                    data-education-form="offline"
                    data-schemes="offlineSchemeData"
                    data-selected-model-scheme="selectedScheme"
                    data-set-form="setForm"
                    data-set-scheme="schemeId"
                    data-user="<?php echo $model->id?>"
            >
            </payments-scheme>
        </div>
        <div class="row col-md-12">
            <button class="btn  btn-outline btn-primary btn-xs"
                    ng-click="createAccount('<?php echo Yii::app()->createUrl('/_teacher/_student/student/new'.$service.'Agreement'); ?>',
                    service.id,service.id,'<?php echo $service?>','','','',selectedScheme,'<?php echo $model->id?>')">
                Згенерувати договір
            </button>
        </div>
    </div>
</div>