<?php
/* @var $model Teacher
 * @var $predefinedUser StudentReg
 * @var $message int
 */
?>
<div class="col-md-8">
    <ul class="list-inline">
    <li>
        <a type="button" class="btn btn-primary" ng-href="#/admin/teachers">
            Співробітники
        </a>
    </li>
    </ul>
</div>
<?php $this->renderPartial('_teacherForm', array(
    'scenario' => 'create',
)); ?>
