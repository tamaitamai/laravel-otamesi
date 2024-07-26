$(function(){
    // お気に入りボタンを押したときの処理
    $('.item-favorite').click(function(){
        if($(this).css('color') === 'rgb(0, 0, 0)'){
            $(this).text('♥')
            $(this).addClass('favorite-exists');
        }else{
            $(this).text('♡')
            $(this).removeClass('favorite-exists');
        }

        var itemId = $('.item-id').val();
        var postData = {
            id: itemId
        }    
        $.ajax({
            url: '/favorite/add',
            data: postData,
        })
    })
})