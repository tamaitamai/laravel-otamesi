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
})