$('.edit_tag').on('input', '.tag:last-child', function() {
  const tags = $('.tag');
  const lastTag = tags.last();

  if (lastTag.val() !== '') {
    if (tags.length >= 5) {
      return;
    }

    const newTag = $('<input>').attr({
      type: 'text',
      class: 'tag',
      name: 'tag[]',
      placeholder: 'タグ'
    });

    $('.edit_tag').append(newTag);
  }
});

let img;
$('.delete_img').on('click', function () {
    img = $('.image').detach();
    $(".delete_img").css("display", "none");
    $(".img_file").css("display", "block");
});
