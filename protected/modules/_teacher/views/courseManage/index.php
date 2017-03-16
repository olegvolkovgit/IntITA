<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary" ng-click="changeView('admin/addcourse')"><?php echo Yii::t("coursemanage", "0511"); ?></button>
    </li>
</ul>
<?php echo $this->renderPartial('_courses_table', array()); ?>