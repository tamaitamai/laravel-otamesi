$(function(){
    $.ajax({
        url: '/item/genreList'
    })

    // ジャンルを変更したときの処理
    $('.genre-box').change(function(){
        postData = {
            genre: $(this).val()
        }
        $.ajax({
            url: '/item/genre',
            data: postData,
            success: function(response){
                window.location.href = response.redirect_url;
            }
        })
    })

    // 商品検索をしたときの処理
    $('.search-icon').click(function(){
        var searchValue = $('.search-input').val();
        const postData = {
            search: searchValue
        }
        $.ajax({
            url: '/item/search',
            data: postData,
            success: function(response){
                window.location.href = response.redirect_url;
            }
        })
    })

    $(document).ready(function(){
        $('.user-info-main').hover(
            function(){
                $('.user-info-area').show();
            },
            function(){
                $('.user-info-area').hide();
            }
        )   
    })
})