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
    $( ".c_bottom" ).append( "<a href=''><img src="+img_src+"><div>書籍</div></a>");
  }
  $('.c_bottom').slick({
    infinite: false,
    slidesToShow: 3,
    slidesToScroll: 1
  });
  for(var i=0;i<1;i++){
    $( ".book_slick" ).append( "<a href=''><img src="+book_slick_img+"></a>");
  }
  $('.book_slick').slick({
    infinite: false,
    slidesToShow: 3,
    slidesToScroll: 1
  }); 
  
  $(".titlename").click(function() {
    document.location.href = "https://www.pornhub.com";
  });
  
  $(".titlesquare").click(function() {
    document.location.href = "main.php";
  });
});
</script>
<body>
  <?php
      session_cache_limiter('private');
      session_start();
      require_once "dbconnect.php"; //更嚴謹，需要確實加入此PHP  
  ?>
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
      <div class="category_items" id="category_items">
        <?php
          $query = ("SELECT category, COUNT(order_ID) AS total FROM bookOrder GROUP BY category ORDER BY category DESC;");
          $stmt = $db->prepare($query);
          $error = $stmt->execute();
          $result = $stmt->fetchAll();

          $categorycount=0;

          foreach ($result as $rows) {
            $str = $rows['category'];
            $str1 = $rows['total'];
           
            echo "<form action='main.php' method='post'><input type='hidden' name='category' value='".$str."'><input class='category_button' id='category_button".$categorycount."' type = 'submit' value='".$str."(".$str1.")' name='categorySubmit'></input></form>";
            $categorycount++;
          }
        ?>
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
            <li class="bookname"> <span id="bookname_label">書名：</span></li>
            <li class="bookISBN"> <span id="bookISBN_label">ISBN：</span></li>
            <li class="author"> <span id="author_label">作者：</span></li>
            <li class="pulisher"> <span id="publisher_label">出版社：</span></li>
            <li class="owner"><span id="owner_label">賣家：</span></li>
            <li class="owner"><span id="phone_label">手機：</span></li>
            <li class="city"><span id="city_label">城市：</span></li>
            <li class="school"><span id="school_label">學校：</span></li>
            <li class="dept"><span id="dept_label">科系：</span></li>
            <li class="condition"><span id="condition_label">狀況：</span></li>
            <li class="sell"><span id="sell_label">售價：</span></li>
            <li>
              <div class="introduce_b">
                <button class="ask">留言</button>
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
<?php
  function loadPage($db) {
    $query = "SELECT account_ID, name, ISBN, author, publisher, user_name, phoneNum, city, school_name, department, isSelled, price FROM makes NATURAL JOIN bookOrder NATURAL JOIN users WHERE makes.order_ID = ".$_POST["bookID"].";";
    $stmt = $db->prepare($query);
    $error = $stmt->execute();
    $result = $stmt->fetchAll();

    echo "<script>document.getElementById('bookname_label').innerHTML += '".$result[0]["name"]."'</script>";
    echo "<script>document.getElementById('bookISBN_label').innerHTML += '".$result[0]["ISBN"]."'</script>";
    echo "<script>document.getElementById('author_label').innerHTML += '".$result[0]["author"]."'</script>";
    echo "<script>document.getElementById('publisher_label').innerHTML += '".$result[0]["publisher"]."'</script>";
    echo "<script>document.getElementById('owner_label').innerHTML += '".$result[0]["user_name"]."'</script>";
    echo "<script>document.getElementById('phone_label').innerHTML += '".$result[0]["phoneNum"]."'</script>";
    echo "<script>document.getElementById('city_label').innerHTML += '".$result[0]["city"]."'</script>";
    echo "<script>document.getElementById('school_label').innerHTML += '".$result[0]["school_name"]."'</script>";
    echo "<script>document.getElementById('dept_label').innerHTML += '".$result[0]["department"]."'</script>";
    echo "<script>document.getElementById('condition_label').innerHTML += '".$result[0]["isSelled"]."'</script>";
    echo "<script>document.getElementById('sell_label').innerHTML += '".$result[0]["price"]."'</script>";
  }

  if (isset($_POST["btnsubmit"])) {
    loadPage($db);
    echo "<script>console.log(111)</script>";
  }
  else {
    loadPage($db);
    echo "<script>document.location.href = 'main.php'</script>";
    echo "<script>console.log('test')</script>";
  }
?>
</body>
</html>
