function loadPage(url, page, id){
    var query = {
        "page": page,
        "teacher": id
    };

    $.post(url, JSON.stringify(query), function () {
    })
        .done(function (data) {
            page = JSON.parse(data).title;
            $("#pageContainer").html(page);
        })
        .fail(function () {
            alert("Вибачте, але на сайті виникла помилка. " +
            "Спробуйте зайти до кабінету пізніше або зв'яжіться з адміністратором сайту.");
            location.reload();
        })
        .always(function () {

        }
    );

}