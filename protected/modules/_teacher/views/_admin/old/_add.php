<ul class="list-inline">
    <li>
        <button type="button" class="btn btn-primary" ng-click="changeView('configuration/old')">
            Права доступу</button>
    </li>
    <li>
        <button type="button" class="btn btn-primary" ng-click="changeView('configuration/old/changestatus')">
            Змінити статус користувача</button>
    </li>
</ul>

<div id="addAccess">
    <br>

    <form name="add-access" action=""
        onsubmit="newPermissions('<?php echo Yii::app()->createUrl('/_teacher/_admin/old/newPermission'); ?>');return false;">
        <fieldset>
            <div class="col-md-4">
                <legend id="label">Додати новий запис:</legend>
                Користувач:<br>
                <div class="form-group">
                    <select name="user" class="form-control" placeholder="(Виберіть користувача)" autofocus required>
                        <?php foreach($users as $user)
                        {?>
                            <option value="<?php echo $user['id'];?>"><?php echo $user['alias'];?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <br>

                Курс:<br>
                <div class="form-group">
                    <select name="course" class="form-control" placeholder="(Виберіть курс)" required
                            onchange="selectModule('<?php echo Yii::app()->createUrl('/_teacher/_admin/old/showModules');?>');">
                        <option value="">Всі курси</option>
                        <optgroup label="Виберіть курс">
                            <?php
                            foreach($courses as $course)
                            {
                                ?>
                                <option value="<?php echo $course['id'];?>"><?php echo $course['alias']." (".$course['language'].") ";?></option>
                            <?php
                            }
                            ?>
                    </select>
                </div>
                <br>
                <br>

                Модуль:<br>

                <div name="selectModule"></div>
                <br>
                <br>

                <fieldset id="rights">
                    <legend>Права</legend>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="permission[]" value="read"/>READ<br/>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="permission[]" value="edit"/>EDIT<br/>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="permission[]" value="create"/>CREATE<br/>
                        </label>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="permission[]" value="delete"/>DELETE<br/>
                        </label>
                    </div>

                </fieldset>
                <input type="submit" class="btn btn-default" value="Додати">
                <br>
            </div>
    </form>
</div>
