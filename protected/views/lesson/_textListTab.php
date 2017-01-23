<?php
if (isset($message)){
    $emptyText = $message;
} else {
    $emptyText = Yii::t('lecture', '0422');
}
?>
<button id="changeColor" class="fullScreen" onclick="enterFullscreen('text')" title="Розгорнути"></button>
    <script>
        function onFullScreenEnter() {
            console.log("Enter fullscreen initiated from iframe");
        };

        function onFullScreenExit() {
            console.log("Exit fullscreen initiated from iframe");
        };

        document.cancelFullScreen = document.cancelFullScreen || document.webkitCancelFullScreen || document.mozCancelFullScreen;
        function enterFullscreen(id) {
            onFullScreenEnter(id);
            var el =  document.getElementById(id);
            var onfullscreenchange =  function(e){
                var fullscreenElement = document.fullscreenElement || document.mozFullscreenElement || document.webkitFullscreenElement;
                var fullscreenEnabled = document.fullscreenEnabled || document.mozFullscreenEnabled || document.webkitFullscreenEnabled;
                console.log( 'fullscreenEnabled = ' + fullscreenEnabled, ',  fullscreenElement = ', fullscreenElement, ',  e = ', e);
            }

            el.addEventListener("webkitfullscreenchange", onfullscreenchange);
            el.addEventListener("mozfullscreenchange",     onfullscreenchange);
            el.addEventListener("fullscreenchange",             onfullscreenchange);

            if (el.webkitRequestFullScreen) {
                el.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);
            } else {
                el.mozRequestFullScreen();
            }
            document.querySelector('#'+id + ' button').onclick = function(){
                exitFullscreen(id);
            }
        }

        function exitFullscreen(id) {
            onFullScreenExit(id);
            document.cancelFullScreen();
            document.querySelector('#'+id + ' button').onclick = function(){
                enterFullscreen(id);
            }
        }
    </script>
<?php
$this->widget('zii.widgets.CListView', array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'/lesson/_textTab',
    'summaryText' => '',
    'emptyText' => $emptyText.'<br><br><br><br><br>',
    'pagerCssClass'=>'YiiPager',
    'ajaxUpdate' => true,
    'id'=>"blocks_list",
));
?>