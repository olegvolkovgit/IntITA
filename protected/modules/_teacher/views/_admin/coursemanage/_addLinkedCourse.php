<?php
/**
 * @var $model CourseLanguages
 * @var $course Course
 * @var $lang string
 * @var $currentCourseLang string
 */
?>
<div class="col-md-6" ng-controller="coursemanageCtrl">
    <form role="form">
        <fieldset>
            <div class="form-group">
                <label>Виберіть курс:</label>
                <input type="number" hidden="hidden" id="course" value="0"/>
                <input type="text" size="135" ng-model="courseSelected" placeholder="додати курс" uib-typeahead="item.title for item in getCourses($viewValue, '<?php echo $currentCourseLang ?>')" typeahead-loading="loadingCourses" typeahead-no-results="noResults" class="form-control"  typeahead-on-select="onSelect($item)"/>
                <i ng-show="loadingCourses" class="glyphicon glyphicon-refresh"></i>
                <div ng-show="noResults">
                    <i class="glyphicon glyphicon-remove"></i> модулів з такою назвою немає
                </div>
                <br>
            </div>
            <br>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Редагувати" ng-click="addLinkedCourse('<?= $course ?>', '<?=$lang?>', courseId) ">
         </div>

        </fieldset>
    </form>
</div>

