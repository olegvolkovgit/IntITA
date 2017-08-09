<?php
/**
 * Created by PhpStorm.
 * User: adm
 * Date: 09.06.2017
 * Time: 12:36
 */
?>
<div class="formMargin">

    <form id="graduateForm" ng-submit="addReview()" novalidate>
        <div class="form-group">
            <label>
                <strong>Посада:</strong>
            </label>
            <input id="position" type="text" class="form-control" name="position"
                   size="90" required ng-model="profileData.review.position">
            <div class="error" ng-show="position">{{errors.position[0]}}</div>
        </div>


        <div class="form-group">
            <label>
                <strong>Місце роботи:</strong>
            </label>
            <input id="position" type="text" class="form-control" name="work_place"
                   size="90" required ng-model="profileData.review.work_place">
            <div class="error" ng-show="errors.work_place">{{errors.work_place[0]}}</div>
        </div>

        <div class="form-group">
            <label>
                <strong>Посилання на місце роботи</strong>
            </label>
            <input id="position" type="url" class="form-control" name="work_site"
                   size="90" required ng-model="profileData.review.work_site">
            <div class="error" ng-show="errors.work_site">{{errors.work_site[0]}}</div>
        </div>

        <div class="form-group">
            <label>
                <strong>Відгук:</strong>
            </label>

            <textarea id="comment" type="text" class="form-control" name="recall"
                      size="90" required ng-model="profileData.review.recall"></textarea>
            <div class="error" ng-show="errors.recall">{{errors.recall[0]}}</div>
        </div>

        <div class="form-group">
            <label>
                <strong>Ім'я англійською</strong>
            </label>
            <input id="nameEn" type="text" class="form-control" name="nameEn"
                   size="90" required ng-model="profileData.review.first_name_en">
            <div class="error" ng-show="errors.first_name_en">{{errors.first_name_en[0]}}</div>
        </div>

        <div class="form-group">
            <div class="form-group">
                <label>
                    <strong>Прізвище англійською</strong>
                </label>
                <input id="position" type="text" class="form-control" name="userPosition"
                       size="90" required ng-model="profileData.review.last_name_en">
                <div class="error" ng-show="errors.last_name_en">{{errors.last_name_en[0]}}</div>
            </div>
        </div>

        <div class="form-group">
            <div class="form-group">
                <label>
                    <strong>Ім'я російською</strong>
                </label>
                <input id="position" type="text" class="form-control" name="userPosition"
                       size="90" ng-model="profileData.review.first_name_ru">
            </div>
        </div>

        <div class="form-group">
            <div class="form-group">
                <label>
                    <strong>Прізвище російською</strong>
                </label>
                <input id="position" type="text" class="form-control" name="userPosition"
                       size="90" ng-model="profileData.review.last_name_ru">
            </div>
        </div>

        <div class="form-group">
            <div class="form-group">
                <label>
                    <strong>Статус публікації: </strong>
                </label>
                <span ng-if="profileData.review.published == 1">Опубліковано на сайті</span>
                <span ng-if="profileData.review.published == 0">В процесі модерації</span>
            </div>
        </div>

        <div class="form-group">
            <button class="btn btn-primary" type="submit">Надіслати</button>
        </div>
    </form><!-- form -->
</div>