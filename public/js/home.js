$(function(){
    $.ajax({
        url: '/item/genreList'
    })

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
})