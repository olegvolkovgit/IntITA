<div ng-controller="crmTasksCtrl">
    <div style="float: right; margin: 2px">
        <button ng-click="openModal('newTask')" type="button" class="btn btn-primary">Додати завдання</button>
    </div>
    <ul class="nav nav-tabs" ng-class="{'nav-stacked': vertical, 'nav-justified': justified}" >
        <li ng-class="[{active: board==1, disabled: disabled}, classes]" class="uib-tab nav-item ng-scope ng-isolate-scope" index="0" heading="Kanban" >
            <a style="padding:4px" href="" ng-click="board=1" class="nav-link ng-binding" >Kanban</a>
        </li>
        <li ng-class="[{active: board==2, disabled: disabled}, classes]" class="uib-tab nav-item ng-scope ng-isolate-scope" index="1" heading="Table" >
            <a style="padding:4px" href="" ng-click="board=2" class="nav-link ng-binding" >Table</a>
        </li>
    </ul>

    <div class="panel-body">
        <uib-tabset active="active">
            <uib-tab ng-repeat="tab in tabs" heading="{{tab.title}} {{tab.count | bracket}}" ui-sref ="tasks.{{tab.route}}" ></uib-tab>
        </uib-tabset>
        <div ui-view="usersTasks"></div>
    </div>

    <modal id="newTask">
        <div class="modal">
            <div class="modal-body">
                <crm-task data-ckeditor-options="editorOptionsCrm" task="crmTask" callback-fn="loadTasks(tasksType)"></crm-task>
                <br>
                <p style="clear: both">
                    <button type="button" ng-if="!crmTask.id || (crmTask.id && crmTask.id_state!=4) && crmTask.created_by==currentUser" class="btn btn-success" ng-click="sendTask(crmTask,'newTask')" ng-disabled="isDisabled" >
                        {{crmTask.id?'Зберегти':'Поставити завдання'}}
                    </button>
                    <button type="button" class="btn btn-default" ng-click="closeModal('newTask');">Відміна</button>
                </p>
            </div>
        </div>
        <div class="modal-background"></div>
    </modal>


</div>

<style>
    .crmBodyBlock{
        padding: 5px;
        border: 1px solid #ccc;
    }
    /*CSS for KANBAN*/

    #kanban-container{
        text-align: center;
        padding-top: 10px;
    }

    .kanban-column {
        width: 24%;
        min-height: 850px;
        background: #FBFBFB;
        display: inline-block;
        box-shadow: 0px 0px 5px #848484;
        margin-right: 2px;
        box-sizing: content-box;
        padding-bottom: 2px;
        /*overflow: hidden;*/
        vertical-align: top;
        transition: all 1s;
    }

    .kanban-column h3{
        color: #ffffff;
        padding: 12px 0;
        font-size: 20px;
        font-weight: bold;
        box-shadow: 0px 0px 2px black;
        background: #607D8B;
    }

    .kanban-column.concept h3{
        background: #607D8B;
    }

    .kanban-column.pending h3{
        background: #546E7A;
    }

    .kanban-column.develop h3{
        background: #455A64;
    }

    .kanban-column.approved h3{
        background: #37474F;
    }

    .kanban-column.rejected h3{
        background: #EF5350;
    }

    .kanban-column .cards-container{
        padding: 0 10px;
    }

    .kanban-column .cards-container .card{
        text-align: left;
        width: 100%;
        margin-top: 13px;
        box-shadow: 0 1px 7px 0 rgba(0, 0, 0, 0.35),0 1px 0px 0 rgba(0,0,0,.14),0 2px 1px -1px rgba(0,0,0,.12);
        box-sizing: border-box;
        background: #FFFFFF;
        padding:5px;
        opacity: 1;
        transition: all 0.3s;
        position: relative;
        overflow: hidden;
        cursor: pointer;
        height: auto;
        transition: max-height 1s;
    }
    .kanban-column .cards-container .card h4{
        text-align: center;
    }
    .kanban-column .cards-container .card img{
        width: 24px;
    }

    .kanban-column .cards-container .card.expanded{
        max-height: 1000px;
    }

    .card .type{
        color: #BDBDBD;
    }
    .kanban-column .cards-container .bg-warning-kanban, .bg-warning-kanban{
        background-color: rgba(217, 102, 2, 0.6);;
    }
    .kanban-column .cards-container .bg-danger-kanban, .bg-danger-kanban{
        background-color: rgba(217,82,82,.6);
    }
    .card.expect_to_execute{
        border-left: 5px solid #FF5722;
    }

    .card.executed{
        border-left: 5px solid #1B5E20;
    }

    .card.completed{
        border-left: 5px solid #0097A7;
    }

    .card.paused{
        border-left: 5px solid #F50057;
    }

    .kanban-column .cards-container .card .cover-img{
        width: 100%;
        max-height: 75px;
    }

    .card h4{
        font-size: 18px;
        font-weight: bold;
        margin: 5px 0;
    }

    .card .description{
        font-size: 13px;
        padding: 0 15px;
    }

    .form-contain{
        margin-bottom: 40px;
    }

    [ng-drag]{
        -moz-user-select: -moz-none;
        -khtml-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    ul.draggable-objects:after{
        display: block;
        content:"";
        clear:both;
    }

    [ng-drop].drag-enter{
        border: 1px dashed #C7C7C7;
        background: #E2E2E2;
    }

    .more-section{
        font-size: 14px;
    }

    .export-container{
        margin-bottom: 40px;
    }

    .cardInfo{
        font-size: smaller;
    }
    @media (max-width: 800px)
    {
        .kanban-column{
            width: 90%;
            min-height: 100px;
        }
    }
</style>