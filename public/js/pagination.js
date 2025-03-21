$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content")},
})

$('button.page_link').on('click', function() {
    let jumpUrl = $(this).attr('href');
    $.ajax({
        method: "GET",
        url: jumpUrl,
        dataType: "html",
    })
    .done(function (data) {
        var page = $('#galleryBox', data).html();
        $('#galleryBox').html(page);
    })
    .fail(function (e) {
        alert('データの取得に失敗しました。');
    })
});