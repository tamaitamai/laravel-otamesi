// 日付のフォーマット
function dateFormat(date){    
    var year = date.getFullYear();
    var month = (date.getMonth() + 1).toString().padStart(2, '0');
    var day = date.getDate().toString().padStart(2,'0');
    var formatDay = year + '-' + month + '-' + day
    return formatDay;
}

$(function(){
    $('.select-date-area').hide();
    // 明日の日付を指定
    var today = new Date();
    var nextday = new Date(today);
    nextday.setDate(today.getDate() + 1);     
    var formatDay = dateFormat(nextday);
    
    $('.select-date-change').val(dateFormat(nextday));
    $('.tomorrow-value').val(formatDay);
    $('.delivery-date-text').text(formatDay);
    
    // 送付日を明日に指定した場合
    $('.tomorrow-check').click(function(){
        var num = $('.tomorrow-check').index($(this));

        $('.tomorrow-value').eq(num).val(formatDay);
        $('.select-date-change').val(formatDay); 
        $('.delivery-date-text').eq(num).text(formatDay);
    })

    // 送付日を指定日で選択した場合
    $('.select-date-check').click(function(){
        var num = $('.select-date-check').index($(this));
        var selectDateValue = $('.select-date-value').eq(num).val();

        $('.select-date-num').val(num);
        if(selectDateValue !== 'on'){
            $('.select-date-change').val(selectDateValue);
        }else{
            $('.select-date-change').val(formatDay);
        }

        $('.select-date-area').show();
    })

    // 指定日の決定
    $('.select-date-btn').click(function(){
        var num = $('.select-date-num').val();
        var selectDateValue = $('.select-date-change').val();

        $('.select-date-value').eq(num).val(selectDateValue);
        $('.delivery-date-text').eq(num).text(selectDateValue);
        $('.select-date-area').hide();
    })
})