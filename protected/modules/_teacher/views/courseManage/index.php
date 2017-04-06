<ul class="list-inline">
    <li>
        <a type="button" class="btn btn-primary" ng-href="#/courses/addcourse"><?php echo Yii::t("coursemanage", "0511"); ?></a>
    </li>
</ul>
<?php echo $this->renderPartial('_courses_table', array()); ?>