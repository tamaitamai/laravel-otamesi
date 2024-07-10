$(function(){
    $('h1').click(function(){
        // const number = $('h1').index($(this));
        // console.log(number);
        if($(this).css('color')=='rgb(0, 0, 255)'){
            $(this).css('color','red');
        }else{
            $(this).css('color','blue');
        }
    })
})