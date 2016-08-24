<?php
/* @var $model Teacher
 * @var $predefinedUser StudentReg
 * @var $message int
 */
?>
<?php if(!$predefinedUser){?>
    <div class="col-md-8">
        <ul class="list-inline">
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/admin/teachers">
                Співробітники
            </a>
        </li>
        </ul>
    </div>
<?php } ?>
<?php $this->renderPartial('_form', array(
    'model' => $model,
    'scenario' => 'create',
    'predefinedUser' => $predefinedUser,
    'message' => $message
)); ?>
