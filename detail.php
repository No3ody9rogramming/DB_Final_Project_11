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
  var book_slick_img=[];
  var book_order_id=[];
  var name="邱吉";
  var address="你心中";
  var condition="販售中";
  var category_count=7;
  $(document).ready(function(){
    /*
  for(var i=0;i<another_items_count;i++){
    $( ".c_bottom" ).append( "<button type='button' onclick='b_callback(" + i +")' class='a'><img src="+img_src+"><div class='another_book_name'>書</div></button>");
  }
  $('.c_bottom').slick({
    infinite: false,
    slidesToShow: 4,
    slidesToScroll: 1
  });*/
  
  $(".titlename").click(function() {
    document.location.href = "https://www.pornhub.com";
  });
  
  $(".titlesquare").click(function() {
    document.location.href = "main.php";
  });
});

function a_callback(i){
  $(".main_img").attr("src",book_slick_img[i]);
}

function b_callback(i){
  $("#otherBookInput").attr("value", i);
  $("#otherBookForm").submit();
}

</script>
<body>
  <form id="otherBookForm" action='detail.php' method='post'>
    <input type='hidden' name='bookID' value='7' id="otherBookInput">
  </form>
  <?php
      session_cache_limiter('private');
      session_start();
      require_once "dbconnect.php"; //更嚴謹，需要確實加入此PHP  
  ?>
  <div class="main">
  <div class="top">
    <div class="title"> 
          <div class="titlename">Book</div>
          <div class="titlesquare">hub</div>
    </div>
    <div class="none">
      
    </div>
    <div class="user">
      <div class="account">hi, willchiu</div>
      <div class="account_b">
        <input id = "signIn" type = "button" value = "signIn">
        <input id = "logIn" type = "button" value = "logIn">
      </div> 
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
          <img class="main_img" src="">
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
          </ul>
          <div class="introduce_b">
            <button class="ask">留言</button>
          </div> 
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
    $query = "SELECT account_ID, name, ISBN, author, publisher, user_name, phoneNum, city, school_name, department, isSelled, price, image, category FROM makes NATURAL JOIN bookOrder NATURAL JOIN users WHERE makes.order_ID = ".$_POST["bookID"].";";
    $stmt = $db->prepare($query);
    $error = $stmt->execute();
    $result = $stmt->fetchAll();
    $category = $result[0]["category"];

    echo "<label>";
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
    echo "<script>console.log('".$result[0]["image"]."');</script>";
    echo "</label>";

    $img_arr = mb_split(",",$result[0]["image"]);
    echo "<script>$(document).ready(function() { ";
    for ($i = 0; $i < count($img_arr) - 1; $i++) {
      echo "book_slick_img.push('/DB_Final_Project_11/book_images/".$_POST["bookID"]."/".$img_arr[$i]."'); ";
      echo "$(\".book_slick\").append(\"<button type='button' onclick='a_callback(".$i.")'  class='a'> <img src='/DB_Final_Project_11/book_images/".$_POST["bookID"]."/".$img_arr[$i]."'></button>\"); ";
    }
    echo "$(\".main_img\").attr(\"src\",book_slick_img[0]); ";
    echo "$('.book_slick').slick({infinite: false,slidesToShow: 3,slidesToScroll: 1});});</script>";

    $query = "SELECT order_ID, name, image, category FROM bookOrder WHERE category = '".$category."' AND order_ID != ".$_POST["bookID"].";";
    $stmt = $db->prepare($query);
    $error = $stmt->execute();
    $relation = $stmt->fetchAll();

    echo "<script>$(document).ready(function() { ";
    $i = 0;
    for (; $i < count($relation); $i++) {
      if ($i >= 10) {
        break;
      }
      $img = mb_split(",",$relation[0]["image"])[0];
      echo "$(\".c_bottom\").append(\"<button type='button' onclick='b_callback(".$relation[$i]["order_ID"].")'  class='a'> <img src='/DB_Final_Project_11/book_images/".$relation[$i]["order_ID"]."/".$img."'><div class='another_book_name'>".$relation[$i]["name"]."</div></button>\"); ";
    }

    $query = "SELECT order_ID, name, image, category FROM bookOrder WHERE category != '".$category."';";
    $stmt = $db->prepare($query);
    $error = $stmt->execute();
    $relation = $stmt->fetchAll();
    
    for (; $i < count($relation); $i++) {
      if ($i >= 10) {
        break;
      }
      $img = mb_split(",",$relation[0]["image"])[0];
      echo "$(\".c_bottom\").append(\"<button type='button' onclick='b_callback(".$relation[$i]["order_ID"].")'  class='a'> <img src='/DB_Final_Project_11/book_images/".$relation[$i]["order_ID"]."/".$img."'><div class='another_book_name'>".$relation[$i]["name"]."</div></button>\"); ";
    }

    echo "$('.c_bottom').slick({infinite: false,slidesToShow: 4,slidesToScroll: 1});});</script>";
  }

  if (isset($_POST["bookID"])) {
    loadPage($db);
    echo "<script>console.log(111)</script>";
  }
  else {
    echo "<script>document.location.href = 'main.php'</script>";
    echo "<script>console.log('test')</script>";
  }
?>
</body>
</html>
