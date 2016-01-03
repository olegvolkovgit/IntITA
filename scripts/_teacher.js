$(function(){
    // Bind an event to window.onhashchange that, when the hash changes, gets the
    // hash and adds the class "selected" to any matching nav link.
    $(window).hashchange( function(){
        var hash = location.hash;
        // Set the page title based on the hash.
        document.title = 'The hash is ' + ( hash.replace( /^#/, '' ) || 'blank' ) + '.';
        // Iterate over all nav links, setting the "selected" class as-appropriate.
        $('#nav a').each(function(){
            var that = $(this);
            that[ that.attr( 'href' ) === hash ? 'addClass' : 'removeClass' ]( 'selected' );
        });
    });
    // Since the event is only triggered when the hash changes, we need to trigger
    // the event now, to handle the hash the page may have loaded with.
    $(window).hashchange();

});

function loadPage(url,role) {
    var userRole = role.toLowerCase();
    $.ajax({
        url: url,
        success: function (data) {
            container = $('#pageContainer');
            container.html(data);
        },
        error: function () {
            alert("Вибачте, але на сайті виникла помилка. " +
            "Спробуйте зайти до кабінету пізніше або зв'яжіться з адміністратором сайту.");
            location.reload();
        }
    });
}

function load(url, hashTag){
    clearDashboard();
    $.ajax({
        url: url,
        success: function (data) {
            container = $('#pageContainer');

            container.html('');
            container.html(data);
        },
        error: function () {
            alert("Вибачте, але на сайті виникла помилка. " +
            "Спробуйте зайти до кабінету пізніше або зв'яжіться з адміністратором сайту.");
           // location.reload();
        }
    });
}

function clearDashboard()
{
    if(document.getElementById("dashboard"))
    document.getElementById("dashboard").style.display = "none";
}

function send(url){
    clearDashboard();

    var jsonData = {
        "user" : user,
        "subject" : document.getElementById("subject"),
        "text" : document.getElementById("text"),
        receivers: document.getElementById("receiver")
    };

    $.ajax({
        url: url,
        data: jsonData,
        method: post,
        success: function (data) {
            container = $('#pageContainer');
            container.html('');
            container.html(data);
        },
        error: function () {
            alert("Вибачте, але на сайті виникла помилка. " +
                "Спробуйте зайти до кабінету пізніше або зв'яжіться з адміністратором сайту.");
            location.reload();
        }
    });
}
