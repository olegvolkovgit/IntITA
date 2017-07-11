<div class="row">
    <label>Документи</label>
    <select ng-options="item.id as item.title for item in documentsTypes"
            ng-model="document.type"
            ng-change="clearDocumentsFields(document.type)"
    >
        <option name="type" value="" disabled selected>(Виберіть тип)</option>
    </select>
</div>

<div ng-show="document.type">
    <div class="row">
        <label><?php echo Yii::t('regexp', '0927') ?></label>
        <input type="text" placeholder="<?php echo Yii::t('regexp', '0927') ?>" ng-model="document.number">
    </div>
    <div class="row" ng-show="document.type==1">
        <label><?php echo Yii::t('regexp', '0928') ?></label>
        <input type="text" placeholder="<?php echo Yii::t('regexp', '0928') ?>" ng-model="document.issued">
    </div>
    <div class="row" ng-show="document.type==1">
        <label><?php echo Yii::t('regexp', '0929') ?></label>
        <input type="text" placeholder="mm/dd/yyyy" ng-model="document.issued_date" class="date" id="issued_date">
    </div>
    <div class="row" ng-show="document.type==1">
        <label>Приписка</label>
        <input type="text" placeholder="Приписка" ng-model="document.registration_address">
    </div>
    <div class="rowbuttons">
        <button type="button" class="btn btn-success" ng-click="saveDocumentsData()">
            Зберегти
        </button>
    </div>
</div>
<div ng-if="userDocuments">
    <span ng-repeat="document in userDocuments track by $index">
        <div class="row">
            <label></label>
             {{document.documentType.title}}:
        </div>
        <div class="row">
            <label><?php echo Yii::t('regexp', '0927') ?></label>
            <input type="text" placeholder="><?php echo Yii::t('regexp', '0927') ?>" ng-model="document.number" disabled>
        </div>
        <div class="row" ng-show="document.type==1">
            <label><?php echo Yii::t('regexp', '0928') ?></label>
            <input type="text" placeholder="<?php echo Yii::t('regexp', '0928') ?>" ng-model="document.issued" disabled>
        </div>
        <div class="row" ng-show="document.type==1">
            <label><?php echo Yii::t('regexp', '0929') ?></label>
            <input type="text" placeholder="mm/dd/yyyy" ng-model="document.issuedDate" class="date" id="issued_date" disabled>
        </div>
        <div class="row" ng-show="document.type==1">
            <label>Приписка</label>
            <input type="text" placeholder="Приписка" ng-model="document.registration_address" disabled>
        </div>

        <label style="vertical-align:top">
            <?php echo Yii::t('edit', '0939'); ?>
        </label>
        <div class="uploadDocuments">
            <span ng-repeat="item in document.documentsFiles track by $index">
                <a ng-href="<?php echo StaticFilesHelper::fullPathToFiles('documents') ?>/{{document.id_user}}/{{document.type}}/{{item.file_name}}" target="_blank">doc{{$index}}</a>
                <a ng-if="document.checked==0" href="" ng-click="removeDocumentsFile(item.id)">[x]</a>
            </span>
            <div ng-if="document.type==1 && document.checked==0">
                <input type="file" nv-file-select="" uploader="documentUploader" multiple="">
                <ul>
                    <li ng-repeat="item in documentUploader.queue">
                        <span ng-bind="item.file.name"></span><button ng-click="item.remove()" class="btn btn-danger btn-xs"><?php echo Yii::t('course', '0368'); ?></button>
                    </li>
                </ul>
                <div ng-if="documentUploader.getNotUploadedItems().length">
                    <div class="progress" style="margin-bottom:0">
                        <div class="progress-bar" role="progressbar" ng-style="{ 'width': documentUploader.progress + '%' }" style="width: 0%;"></div>
                    </div>
                    <button type="button" class="btn btn-success btn-xs" ng-click="documentUploader.uploadAll()" ng-disabled="!documentUploader.getNotUploadedItems().length" disabled="disabled">
                        Завантажити
                    </button>
                </div>
            </div>
            <div ng-if="document.type==2 && document.checked==0">
                <input type="file" nv-file-select="" uploader="innUploader" multiple="">
                <ul>
                    <li ng-repeat="item in innUploader.queue">
                        <span ng-bind="item.file.name"></span><button ng-click="item.remove()" class="btn btn-danger btn-xs"><?php echo Yii::t('course', '0368'); ?></button>
                    </li>
                </ul>
                <div ng-if="innUploader.getNotUploadedItems().length">
                    <div class="progress" style="margin-bottom:0">
                        <div class="progress-bar" role="progressbar" ng-style="{ 'width': innUploader.progress + '%' }" style="width: 0%;"></div>
                    </div>
                    <button type="button" class="btn btn-success btn-xs" ng-click="innUploader.uploadAll()" ng-disabled="!innUploader.getNotUploadedItems().length" disabled="disabled">
                        Завантажити
                    </button>
                </div>
            </div>
            <div ng-if="document.type==3 && document.checked==0">
                <input type="file" nv-file-select="" uploader="certificateUploader" multiple="">
                <ul>
                    <li ng-repeat="item in certificateUploader.queue">
                        <span ng-bind="item.file.name"></span><button ng-click="item.remove()" class="btn btn-danger btn-xs"><?php echo Yii::t('course', '0368'); ?></button>
                    </li>
                </ul>
                <div ng-if="certificateUploader.getNotUploadedItems().length">
                    <div class="progress" style="margin-bottom:0">
                        <div class="progress-bar" role="progressbar" ng-style="{ 'width': certificateUploader.progress + '%' }" style="width: 0%;"></div>
                    </div>
                    <button type="button" class="btn btn-success btn-xs" ng-click="certificateUploader.uploadAll()" ng-disabled="!certificateUploader.getNotUploadedItems().length" disabled="disabled">
                        Завантажити
                    </button>
                </div>
            </div>
        </div>
        <div class="rowbuttons" ng-if="document.checked==0">
            <button type="button" class="btn btn-danger" ng-click="removeDocument(document.id)">
                Видалити
            </button>
        </div>
    </span>
</div>