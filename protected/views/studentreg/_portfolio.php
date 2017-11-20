<div class="formMargin">
    <form ng-submit="portfolioRequest()" novalidate>
        <label>
            <a ng-href="<?php echo Yii::app()->createUrl('studentreg/portfolio', array('id' => $user->id)) ?>" target="_blank">Портфоліо</a>
        </label>
        <div class="form-group">
            <label>
                <strong>Псевдонім сторінки:</strong>
            </label>
            <input type="text" class="form-control" size="90" ng-model="profileData.portfolio.alias">
        </div>
        <div class="uploadDocuments">
            <span ng-repeat="item in portfolioFiles track by $index">
                <br>
                <a href="/profile/getProfileFile?fileId={{item.id}}">item.file_name</a>
                <a ng-href="<?php echo StaticFilesHelper::fullPathToFiles('documents') ?>{{document.id_user}}/{{document.type}}/{{item.file_name}}" target="_blank">doc{{$index}}</a>
                <a href="" ng-click="removePortfolioFile(item.id)">[x]</a>
            </span>
            <div>
                <input type="file" nv-file-select="" uploader="fileUploader"  multiple="">
                <ul>
                    <li ng-repeat="item in fileUploader.queue">
                        <span ng-bind="item.file.name"></span><button ng-click="item.remove()" class="btn btn-danger btn-xs"><?php echo Yii::t('course', '0368'); ?></button>
                    </li>
                </ul>
                <div ng-if="fileUploader.getNotUploadedItems().length">
                    <div class="progress" style="margin-bottom:0">
                        <div class="progress-bar" role="progressbar" ng-style="{ 'width': fileUploader.progress + '%' }" style="width: 0%;"></div>
                    </div>
                    <button type="button" class="btn btn-success btn-xs" ng-click="fileUploader.uploadAll()" ng-disabled="!fileUploader.getNotUploadedItems().length" disabled="disabled">
                        Завантажити
                    </button>
                </div>
            </div>
        </div>
<!--        <div class="rowbuttons" ng-if="document.checked==0">-->
<!--            <button type="button" class="btn btn-danger" ng-click="removeDocument(document.id)">-->
<!--                Видалити-->
<!--            </button>-->
<!--        </div>-->

<!--        <div class="form-group">-->
<!--            <div class="form-group">-->
<!--                <label>-->
<!--                    <strong>Статус публікації: </strong>-->
<!--                </label>-->
<!--                <span ng-if="profileData.review.published == 1">Опубліковано на сайті</span>-->
<!--                <span ng-if="profileData.review.published == 0">В процесі модерації</span>-->
<!--            </div>-->
<!--        </div>-->
        <br>
        <div class="form-group">
            <button class="btn btn-primary" type="submit">Надіслати</button>
        </div>
    </form><!-- form -->
</div>