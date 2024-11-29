$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $("[name='csrf-token']").attr("content")},
})

$('#follow').on('click', function() {
    $.ajax({
        method: "POST",
        url: user,
        dataType: "json",
        data: {
            "_token": "{{ csrf_token() }}",
        },
    })
    .done(function(res) {
        console.log(res);
        $('#follow').toggleClass('bg-sky-400 bg-red-400');
        if($('#follow').text() === 'follow'){
            $('#follow').text('unfollow');
        }
        else{
            $('#follow').text('follow');
        }
    })
    .fail(function() {
        alert("失敗しました。");
    });
});