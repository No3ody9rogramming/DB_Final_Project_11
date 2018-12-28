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
          <div class="category_title">新增</div>
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
              <form action="" method="post" enctype="multipart/form-data">
                <ul>
                  <li class="bookname">書名：<input name="name" type="text" ></li>
                  <li class="owner">作者：<input name="author" type="text" ></li>
                  <li class="sell">出版：<input name="publisher" type="text" ></li>
                  <li class="address">ISBN：<input name="ISBN" type="text" ></li>
                  <li>價格:<input name="price" type="number"></li>
                  <li>選擇圖片: <input  type="file" name="image" class="buy"></li>
                  <li><input type="submit" name="submitP" class="ask" value="新增書籍"></li>
                </ul>
              </form>
              <div>
                <?php

                  require_once "dbconnect.php";

                  function getImage($db, $newImageName) {
                    if($_FILES['image']["error"] > 0) { //出錯 > 0
                      printf("%d\n", $_FILES['image']["error"]);
                    } 
                    else {                      
                      move_uploaded_file($_FILES['image']["tmp_name"], $newImageName);
                      return true;
                    }
                    return false;
                  }

                  function getBookInfo($db, $newImageName){
                    $query = ("SELECT count(ID) FROM bookOrder;");
                    $stmt = $db->prepare($query);
                    $error = $stmt->execute();
                    $result = $stmt->fetchAll();

                    printf("%d\n", $result);
                    $ID = 2; //數目前有幾本書

                    $name = $_POST["name"];
                    $author = $_POST["publisher"];
                    $ISBN = $_POST["ISBN"];
                    $publisher = $_POST["publisher"];
                    $price = $_POST["price"];

                    $query = ("INSERT INTO bookOrder VALUES(?,?,?,?,?,?,?, ?)");
                    $stmt = $db->prepare($query);
                    $result = $stmt->execute(array($ID, $ISBN, $name, $author, $publisher, $newImageName, $newImageName, 0));
                    $db = null;
                  }

                  if(isset($_POST["submitP"])) {
                    $newImageName = "book_images/" . $_FILES['image']["name"]; //還要再加上userID
                    if(getImage($db, $newImageName)){ //get 到 image 後 加入bookOrder db
                       getBookInfo($db, $newImageName);
                    }
                    else {
                      echo "Invalid book!";
                    }
                  }

                ?>
              </div>
            </div> 
          </div>
          <div class="c_bottom">
          </div>
        </div>
        <div class="c_right">
          <button class="ad_b" type="button"><img src="大頭.jpg"></button>
          <button class="ad_b" type="button"><img src=""></button>
        </div>
      </div>
    </div>
    <div class="bottom"></div>
  </body>
</html>
