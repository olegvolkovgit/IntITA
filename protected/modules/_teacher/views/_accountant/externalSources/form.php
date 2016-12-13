<?php
/* @var $scenario */
?>
<div class="panel-body" ng-controller="externalSourceCtrl">
	<div class="row">
		<div class="formMargin">
			<div class="col-lg-8">
				<form autocomplete="off" ng-submit="sendExternalSourceForm('<?php echo $scenario ?>', source.name, source.cash, modelId);" name="externalSourceForm"  novalidate>
					<div class="form-group">
						<label>Назва*</label>
						<input name="name" class="form-control" ng-model="source.name" required maxlength="128" size="50">
						<div ng-cloak  class="clientValidationError" ng-show="externalSourceForm['name'].$dirty && externalSourceForm['name'].$invalid">
							<span ng-show="externalSourceForm['name'].$error.required"><?php echo Yii::t('error','0268') ?></span>
						</div>
					</div>
					<div class="form-group">
						<label>Гроші</label>
						<input type="number" class="form-control" ng-model="source.cash" name="cash" size="16" min="0" ng-value="0" max="1"/>
						<div ng-cloak  class="clientValidationError" ng-show="externalSourceForm['cash'].$dirty && externalSourceForm['cash'].$invalid">
							<span ng-show="externalSourceForm['cash'].$error.number">Введи 0 або 1</span>
						</div>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary" ng-disabled="externalSourceForm.$invalid">Зберегти
						</button>
						<a type="button" class="btn btn-default" ng-click="back();" href="">
							Назад
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>