<!DOCTYPE html>
<html>
<head>
  <link href="css/detail.css" rel="stylesheet" type="text/css" />
  <link href="css/slick/slick-theme.css" rel="stylesheet" type="text/css" />
  <link href="css/slick/slick.css" rel="stylesheet" type="text/css" />
  
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script type="text/javascript" src="js/slick.min.js"></script>

  <meta charset = "utf-8">
  <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
  <title></title>
</head>
<script type="text/javascript">
  var another_items_count=10
  var books_items_count=10
  var img_src="src/Books.jpg";
  var book_slick_img="src/test.jpg";
  var name="邱吉";
  var address="你心中";
  var condition="販售中";
  var category_count=7;
  $(document).ready(function(){
  
  for(var i=0;i<another_items_count;i++){
    $( ".c_bottom" ).append( "<a href=''><img src="+img_src+"></a>");
     }
     $('.c_bottom').slick({
      infinite: true,
      slidesToShow: 3,
      slidesToScroll: 3
    });
   for(var i=0;i<books_items_count;i++){
    $( ".book_slick" ).append( "<a href=''><img src="+book_slick_img+"></a>");
     }
    $('.book_slick').slick({
      infinite: true,
      slidesToShow: 3,
      slidesToScroll: 3
    }); 
   for(var i=0;i<category_count;i++){
      $(".category_items").append("<input class='category_button' id = '"+i+"' type = 'button' value = ''>");
     }
  
});
</script>
<body>
  <div class="main">
  <div class="top">
    <div class="title"> 
      <ul>
        <li> 
          <div class="titlename">Book</div>
          <div class="titlesquare">hub</div>
        </li>
      </ul>
    </div>
    <div class="user">
      <div class="account">hi, willchiu</div>
      <input id = "signIn" type = "button" value = "signIn">
      <input id = "logIn" type = "button" value = "logIn">
    </div>
  </div>
  <div class="center">
    <div class="c_left">
      <div class="category_title">category</div>
      <div class="category_items">
        
      </div>
    </div>
    <div class="c_center">
      <div class="c_top">
        <div class="book_img">
          <img class="main_img" src="src/Books.jpg">
          <div class="book_slick"></div>
        </div>
        <div class="introduce">
          <ul>
            <li class="bookname"> <span class="bookname_label">書名：</span><span class="bookname_value"></span></li>
            <li class="owner"><span class="owner_label">持有者：</span><span class="owner_value"></span></li>
            <li class="sell"><span class="sell_label">售價：</span><span class="sell_value"></span></li>
            <li class="address"><span class="address_label">地址：</span><span class="address_value"></span></li>
            <li class="condition">狀況：<span class="condition_label"></span><span class="condition_value"></span></li>
            <li>
              <div class="introduce_b">
                <button class="ask">詢問</button>
                <button class="buy">購買</button>
              </div> 
            </li>
          </ul>
          
        </div>
      </div>
      <div class="c_bottom">
        <!-- <div class="row">
        </div>   -->
      </div>
    </div>
  <!-- </div> -->
    <!-- </div> -->
    <div class="c_right">
      <button class="ad_b" type="button"><img src="大頭.jpg"></button>
      <button class="ad_b" type="button"><img src=""></button>
    </div>
  </div>
  <div class="bottom"></div>
</div>
</body>
</html>
