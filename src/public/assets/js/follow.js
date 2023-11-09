function follow(userId) {
    $('.follow').css("display", "none");
    $('.un_follow').css("display", "block");
    $.ajax({
        // これがないと419エラーが出ます
        headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
        url: `/follow/${userId}`,
        type: "POST",
    })
        .done((data) => {
            console.log(data);
        })
        .fail((data) => {
            console.log(data);
        });
}
function destroy(userId) {
    $('.follow').css("display", "block");
    $('.un_follow').css("display", "none");
    $.ajax({
        // これがないと419エラーが出ます
        headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
        url: `/follow/${userId}/destroy`,
        type: "POST",
    })
        .done((data) => {
            console.log(data);
        })
        .fail((data) => {
            console.log(data);
        });
}
