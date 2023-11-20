$(document).ready(function() {
    const open = document.getElementById('openbtn');
    open.addEventListener('click',function(){
        $(this).toggleClass('active');
        $("#g-nav").toggleClass('panelactive');
    });

    // $('#delete-notifications-btn').click(function(e) {
    //     e.preventDefault();
    //     $.ajax({
    //         url: '{{ route("notifications_delete") }}',
    //         type: 'POST',
    //         headers: {
    //             'X-CSRF-TOKEN': '{{ csrf_token() }}'
    //         },
    //         success: function(response) {
    //             // 削除成功時の処理
    //             console.log('通知が削除されました');
    //             location.reload();
    //         },
    //         error: function(xhr) {
    //             // エラー時の処理
    //             console.log('削除エラー');
    //         }
    //     });
    // });
});


