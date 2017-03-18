/**
 * Created by komas on 13.03.2017.
 */
window.addEventListener("load", loadFunction);
window.addEventListener("resize", myFunction);
function defineSizeIcons() {
    var height_page = document.documentElement.clientHeight;
    var width_page = document.documentElement.clientWidth;
    var height_el = 400;
    var big_icon = document.getElementsByClassName('big_icon')[0];
    var less_icon = document.getElementsByClassName('less_icon')[0];

    if(height_page < height_el || width_page < 800){
        big_icon.style.display = 'none';
//            less_icon.style.display = 'none';
        var less_icon = document.getElementsByClassName('less_icon')[0];
        var little_icon = less_icon.getElementsByClassName('share42-item');

        for(var i = 0; i < little_icon.length; i++) {
            little_icon[i].style.height = '34px';
            var little_icon_a = little_icon[i].getElementsByTagName('a')[0];
            little_icon_a.style.height = '33px';
            little_icon_a.style.width = '31.55px';
            little_icon_a.style.backgroundPositionX = -31.5*i + 'px';
        }
    } else if (height_el < height_page){
        less_icon.style.display = 'none';
        big_icon.style.display = 'block';
    }
}
function loadFunction() {
    defineSizeIcons();
}
function myFunction() {
    defineSizeIcons();
}
