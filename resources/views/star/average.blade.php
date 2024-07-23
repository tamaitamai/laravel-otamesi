<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
$totalValue = 0;
$averageValue = 0;
$totalCount = 0;
$border = 50;
$starWidth = 50;
$map=[
    '1' => ['count' => 0,'border' => ''],
    '2' => ['count' => 0,'border' => ''],
    '3' => ['count' => 0,'border' => ''],
    '4' => ['count' => 0,'border' => ''],
    '5' => ['count' => 0,'border' => ''],
];
// レビューのそれぞれの評価と合計のカウントを計算
foreach ($reviews as $review) {
    $map[$review->star]['count']++;
    $totalCount++;
}
// レビュー評価の合計、ボーダーの長さを計算
foreach($map as $key=>$value){
    $totalValue+=$value['count'] * $key;
    if($totalCount == 0)  {
        $border = 0;
    }else{
        $border = $map[$key]['count']/$totalCount * 100;
    }
    $map[$key]['border'] = 'linear-gradient(to right, rgb(220, 28, 28) '.$border.'%, transparent '.$border.'%)';
}
// レビューの平均の表示
$beforeValue = 0;
$lastValue = 0;
$afterValue = 0;
$widthRange = 0;
if($totalCount == 0){
    $averageValue=0;
}else{
    $averageValue=round($totalValue/$totalCount,1);
}
$beforeValue = floor($averageValue);
$lastValue = ceil($averageValue - $beforeValue);
$afterValue = 5 - $beforeValue - $lastValue;
$widthRange = $averageValue - $beforeValue;
if($widthRange >= 0.5){
    $starWidth = 50 + $widthRange * 10;
}else if($widthRange < 0.5){
    $starWidth = 50 - $widthRange * 10;
}
?>
<div class="review-star-area">
    {{-- レビュー評価の平均を表示 --}}
    @if($averageView)
    <div class="average-star-area">
        <div class="avarage-star-box">
            @for($i=1;$i<=$beforeValue;$i++)
            <span class="before-star">★</span>   
            @endfor
            @for($i=1;$i<=$lastValue;$i++)
            <span class="last-star" style="--star-width: {{ $starWidth.'%' }}">★</span>
            @endfor
            @for($i=1;$i<=$afterValue;$i++)
            <span class="after-star">★</span>
            @endfor    
            <div>{{ $averageValue }}</div>
        </div>
    </div>
    @endif
    {{-- レビュー評価の一覧を表示 --}}
    @if($exists)
    <div>{{ $totalCount }}個のレビュー</div>
    @for ($i=1;$i<=5;$i++)
    <div class="review-star-box">
        <div class="review-rank">{{ $i }}</div>
        <div class="review-star-border" style="background-image: {{ $map[$i]['border'] }}"></div>
        <div class="review-count">{{ $map[$i]['count'] }}</div>
    </div>   
    @endfor    
    @endif
</div>
</body>
</html>
<style>
/* レビュー評価平均 */
.average-star-area{
    display: flex;
    width: 100%;
}
.avarage-star-box{
    display: flex;
    width: 100%;
    font-size: 20px;
}
.before-star{
    color: orange;
}
.last-star{
    display: inline-block;
    position: relative;
    color: lightgray;
}
.last-star::before {
    content: '★';
    position: absolute;
    left: 0;
    top: 0;
    width: var(--star-width);
    /* width: 40%; */
    overflow: hidden;    
    color: orange;
}
.after-star{
    color: lightgray;
}
/* レビュー評価一覧 */
.review-star-area{
    /* width: 25%; */
}
.review-star-box{
    display: flex;
    align-items: center;
    margin-bottom: 10px;
    width: 300px;
}
.review-rank{
    margin-right: 20px;    
}
.review-star-border{
    border: 1px solid rgb(180, 175, 175);
    height: 20px;
    width: 80%;
    border-radius: 5px;
    /* background-image: linear-gradient(to right, rgb(220, 28, 28) 50%, transparent 50%); */
}
.review-count{
    margin-left: 20px;
}
</style>