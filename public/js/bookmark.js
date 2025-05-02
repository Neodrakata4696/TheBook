$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content")},
})

$('#bookmark').on('click', function(event) {
    var jumpUrl = $(event.target);
    var marker = document.getElementById('bookmark');
    $.ajax({
        method: "POST",
        url: jumpUrl.attr('href'),
        dataType: "json",
        data: {
            "_token": $("[name='_token']").attr("value"),
        },
    })
    .done(function(res) {
        console.log(jumpUrl.attr('href'));
        if (marker.textContent === '★'){
            marker.textContent = "☆";
        }
        else{
            marker.textContent = "★";
        }
    })
    .fail(function() {
        alert('データの取得に失敗しました。');
    });
});