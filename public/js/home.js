function rightMove(num){
    for(let i=0;i<num;i++){
        if($('.home-image').eq(i).is(':visible')){
            $('.home-image').hide();
            if(i+1 === num){
                $('.home-image').eq(0).show();    
            }else{
                $('.home-image').eq(i+1).show();
            }
            break;
        }
    }
}

$(function(){
    $('.home-image').eq(0).show();
    var num = $('.home-image').length;

    setInterval(function(){
        rightMove(num)
    },10000);

    // ホーム画像を右側に遷移
    $('.right-move').click(function(){
        rightMove(num);
    })
    // ホーム画像を左側に遷移
    $('.left-move').click(function(){
        for(let i=0;i<num;i++){
            if($('.home-image').eq(i).is(':visible')){
                $('.home-image').hide();
                if(i === 0){
                    $('.home-image').eq(num-1).show();
                }else{
                    $('.home-image').eq(i-1).show();
                }
                break;
            }
        }        
    })
})