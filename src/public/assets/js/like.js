function like(id) {
  $.ajax({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    url: `/like/${id}`,
    type: "POST",
  })
    .done(function (data, status, xhr) {
      console.log(data);
      $(".nice").hide();
      $(".un_nice").show();
    })
    .fail(function (xhr, status, error) {
      console.log();
    });
}
function unlike(id) {
  $.ajax({
    headers: {
      "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
    url: `/unlike/${id}`,
    type: "POST",
  })
    .done(function (data, status, xhr) {
      console.log(data);
      $(".un_nice").hide();
      $(".nice").show();
    })
    .fail(function (xhr, status, error) {
      console.log();
    });
}
// $(document).on('click', '.nice', function() {
//   $(this).next('.un_nice2').css('display', 'block');
//   $(this).next('.nice').css('display', 'none');
// });
// $(document).on('click', '.un_nice', function() {
//   $(this).next('.nice2').css('display', 'block');
// });
