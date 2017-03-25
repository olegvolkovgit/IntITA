<div class="panel-body">
    <ul class="list-inline">
        <li>
            <a type="button" class="btn btn-primary" ng-href="#/address">
                Країни, міста
            </a>
        </li>
    </ul>
    <div class="row">
        <div class="formMargin">
            <div class="col-lg-8">
                <form role="form" name="addCityForm" ng-submit="editCity();">
                    <div class="form-group">
                        <label>Країна</label>
                        <input id="typeahead" type="text" class="typeahead form-control" name="country" value="<?php echo $model->country0->title_ua ?>"
                               size="90" required disabled>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $model->id ?>">
                    <div class="form-group">
                        <label>Назва українською</label>
                        <input name="titleUa" class="form-control" value="<?php echo $model->title_ua ?>" required maxlength="50" size="50">
                    </div>

                    <div class="form-group">
                        <label>Назва російською</label>
                        <input name="titleRu" class="form-control" value="<?php echo $model->title_ru ?>" required maxlength="50" size="50">
                    </div>

                    <div class="form-group">
                        <label>Назва англійською</label>
                        <input name="titleEn" class="form-control" value="<?php echo $model->title_en ?>" required maxlength="50" size="50">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Відредагувати</button>
                        <a type="button" class="btn btn-outline btn-default" ng-href="#/address">
                            Скасувати
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
