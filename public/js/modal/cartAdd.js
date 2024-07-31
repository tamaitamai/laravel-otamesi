$(function(){
    // アイテムをカートに追加
    $('.cart-add-box').submit(function(event){
        event.preventDefault(); // デフォルトのフォーム送信を防ぐ

        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: $(this).serialize(), // フォームのデータをシリアライズ
            success: function(response){
                if(response.redirect_url != undefined){
                    window.location.href = response.redirect_url;
                }else{
                    $('.item-add-view').show();
                }
            },
            error: function(xhr){
                alert('商品をカートに追加できませんでした。');
            }
        });
    });
    $('.close-btn').click(function(){
        $('.item-add-view').hide();
    })
})