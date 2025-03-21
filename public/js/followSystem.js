$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content")},
})

$('.follow').on('click', function(event) {
    var follow_user = $(event.target);
    $.ajax({
        method: "POST",
        url: follow_user.val(),
        dataType: "json",
        data: {
            "_token": $("[name='_token']").attr("value"),
        },
    })
    .done(function(res) {
        follow_user.toggleClass('bg-sky-400 bg-red-400');
        if(follow_user.text() === 'follow'){
            follow_user.text('unfollow');
        }
        else{
            follow_user.text('follow');
        }
        console.log('OK!');
    })
    .fail(function() {
        alert("失敗しました。");
    });
});