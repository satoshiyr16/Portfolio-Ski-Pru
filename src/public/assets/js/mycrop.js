$("#file").change(function(){
    if (this.files.length > 0)
    // 選択されたファイル情報をfileに入れる
        var file = this.files[0];
        var reader = new FileReader();
        // fileをreaderのresultに格納
        reader.onload = function() {
            $("#show").css("display", "block");
            // attrでHTML属性に追加
            $("#show").attr("src", reader.result);
        }
    reader.readAsDataURL(file);
});

$('#file').change(function(){
    $('.user_img').css('display', 'none');
})

