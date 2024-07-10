$(function(){
    $('.item-add-area').hide();
    $('.item-box').submit(function(event){
        event.preventDefault(); // デフォルトのフォーム送信を防ぐ

        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: $(this).serialize(), // フォームのデータをシリアライズ
            success: function(response){
                $('.item-add-area').show();
            },
            error: function(xhr){
                alert('商品をカートに追加できませんでした。');
            }
        });
    });
    $('.close-btn').click(function(){
        $('.item-add-area').hide();
    })
})