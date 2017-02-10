<div ng-controller="chat-controller as main" class="dnd-container">
    <div ng-show="init" class="draggable chat mini ng-class:{mini: state==1, full: state==2}" ng-click="" >
        <iframe style="width: 100%;height: 100%;border: none;" src="https://qa.intita.com/crmChat"></iframe>
        <div class="window_panel ignore" style="">
            <div id="minimize_btn" class="material-icons" ng-click="minimizete()">indeterminate_check_box</div>
            <div id="fullscreen_btn" class="material-icons" ng-click="fullScreen()">web_asset</div>
        </div>
        <div class="handle" ng-mouseup="minimizeteMin()" style=""></div>
    </div>
</div>