$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content")},
})

$('.bookmark').on('click', function(event) {
    var jumpUrl = $(event.target);
    $.ajax({
        method: "POST",
        url: jumpUrl.attr('href'),
        dataType: "json",
        data: {
            "_token": $("[name='_token']").attr("value"),
        },
    })
    .done(function(res) {
        if ($(event.target).text() === '★'){
            $(event.target).text("☆");
        }
        else{
            $(event.target).text("★");
        }
    })
    .fail(function() {
        alert('データの取得に失敗しました。');
    });
});