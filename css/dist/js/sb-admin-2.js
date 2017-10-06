$jq(function() {
    $jq('#side-menu').metisMenu();
});

//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$jq(function() {
    $jq(window).bind("load resize", function() {
        topOffset = 50;
        width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $jq('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
        } else {
            $jq('div.navbar-collapse').removeClass('collapse');
        }

        height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $jq("#page-wrapper").css("min-height", (height) + "px");
        }
    });

    var url = window.location;
    var element = $jq('ul.nav a').filter(function() {
        return this.href == url || url.href.indexOf(this.href) == 0;
    }).addClass('active').parent().parent().addClass('in').parent();
    if (element.is('li')) {
        element.addClass('active');
    }
});

$jq('#close_open').on('click', function(){
    var width = $jq('#m_menu').css('width');

    if(width == '250px'){
        $jq('.show_elem').fadeOut(1700);

        setTimeout(function(){
            $jq('.hid').css({'display': 'block'});
            $jq('.show_elem').css({'display': 'none'});
        }, 1500);

        $jq('#m_menu').animate({width: '0'}, 1500);
        $jq('#page-wrapper').animate({marginLeft: '0'}, 1500);
        $jq('#m_menu').animate({width: '50'}, 'slow');
        $jq('#page-wrapper').animate({marginLeft: '50'}, 'slow');

    }else{
        $jq('.hid').fadeOut(850);
        $jq('#m_menu').animate({width: '250'}, 1500);
        $jq('#page-wrapper').animate({marginLeft: '250'}, 1500);

        setTimeout(function () {
            $jq('.show_elem').fadeIn(1000);
            $jq('.hid').css({'display': 'none'});
            $jq('.show_elem').css({'display': 'block'});
        }, 750);
    }
});
