$(function(){
    $('.star').click(function(){
        var starNum = $('.star').index($(this)) + 1;
        $('.star').css('color','black').text('☆');        
        for(let i=0; i<starNum; i++){
            $('.star').eq(i).css('color','orange').text('★');
        }
        $('.star-value').val(starNum);
    })
    
    for(let i=0; i<$('.star-value').val(); i++){
        $('.star').eq(i).text('★').css('color','orange');
    }

    $('.review-good').click(function(){
        var index = $('.review-good').index($(this));
        var totalReviewCount = Number.parseInt($('.review-total-count').eq(index).text());

        if($(this).css('border') === '0.8px solid rgb(0, 0, 0)'){
            $(this).css('border','1px solid red');
            $('.review-total-count').eq(index).text(totalReviewCount + 1);
        }else{
            $(this).css('border','1px solid black');
            $('.review-total-count').eq(index).text(totalReviewCount - 1);
        }
        
        var reviewId = $(this).val()
        postData = {
            id: reviewId
        }
        $.ajax({
            url: 'http://localhost/reviewGood',
            data: postData,
            success: function(response){
            },
            error: function(xhr){
                alert('送信できませんでした');
            }
        });
    })
})