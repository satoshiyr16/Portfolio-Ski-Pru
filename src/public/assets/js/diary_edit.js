$(function() {
    var deletedImages = [];

    $('input[type="file"]').change(function() {
        var files = $(this)[0].files;
        if (files.length > 0) {
            for (var i = 0; i < files.length; i++) {
                var file = files[i];
                var reader = new FileReader();
                reader.onload = function(e) {
                    var imagePreview = '<div class="image-preview"><img src="' + e.target.result + '" style="width: 100px; height:100px; margin:0 10px;"><button type="button" class="btn btn-danger btn-sm remove-image">削除</button></div>';
                    $('.img_area').append(imagePreview);
                };
                reader.readAsDataURL(file);
            }
        }
    });

    $(document).on('click', '.remove-image', function() {
        var imageId = $(this).closest('.image-preview').data('image-id');
        if (imageId) {
        deletedImages.push(imageId);
        }
        $(this).closest('.image-preview').remove();
    });

    $('form').submit(function() {
        console.log('ok');
        // deletedImages 配列を隠しフィールドに設定する
        $('<input>').attr({
            type: 'hidden',
            name: 'deleted_images',
            value: JSON.stringify(deletedImages)
        }).appendTo('form');
    });

});
