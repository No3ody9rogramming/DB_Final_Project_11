<!DOCTYPE html>
<html>
<head>
  <?php
    require_once "dbconnect.php";
    session_start();
    if(!isset($_SESSION['account']))
      header("Location: login.php");
  ?>
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
   
   for(var i=0;i<category_count;i++){
      $(".category_items").append("<input class='category_button' id = '"+i+"' type = 'button' value = ''>");
     }
  
});
</script>
  <body>
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
          <div class="category_title">新增</div>
          <div class="category_items">
            
          </div>
        </div>
        <div class="c_center">
          <div class="c_top">
            <div class="book_img">
              <img class="main_img" src="src/Books.jpg">
              <div class="image_select"> </div>
            </div>
            <div class="introduce">
              <form action="" method="post" enctype="multipart/form-data">
                <ul>
                  <li class="creat_title bookname">書名：</li>
                  <input name="name" type="text" class='creat'>
                </ul>
                <ul>
                  <li class="creat_title owner">作者：</li>
                  <input name="author" type="text" class='creat'>
                </ul>
                <ul>
                  <li class="creat_title sell">出版：</li>
                  <input name="publisher" type="text" class='creat'>
                </ul>
                <ul>
                  <li class="creat_title address">ISBN：</li>
                  <input name="ISBN" type="text" class='creat'>
                </ul>
                <ul>
                  <li class="creat_title">價格:</li>
                  <input name="price" type="number" class='creat'>
                </ul>
                <ul>
                  <li>選擇圖片</li><input accept="image/jpg,image/png,image/jpeg,image/bmp" type="file" name="images[]" class="select" multiple>
                </ul>
                <ul>
                  <li class="creat_title">書籍分類:</li>
                  
                    <select class="drop_down category" id='category' name="category"> 
                    <?php
                    require_once "dbconnect.php";
                    $query = ("SELECT category FROM category;");
                    $stmt = $db->prepare($query);
                    $error = $stmt->execute(); 
                    $result = $stmt->fetchAll();
                    $categorycount=0;
                    foreach ($result as $rows) {
                      $name[$categorycount] = $rows['category'];
                      echo "<option id='idx".$categorycount."'>".$rows['category']."</option>";
                      $categorycount++;
                    }
                    ?>
                  </select>
                </ul>
                <ul>
                  <li><input type="submit" name="submitP" class="ask" value="新增書籍"></li>
                </ul>
              </form>
              <div>
                <?php

                  require_once "dbconnect.php";

                  function validUpload(){//出錯回傳false
                    $valid = true;
                    foreach($_FILES['images']['error'] as $uploadError){
                      if($uploadError > 0){
                        $valid = false;
                        switch($uploadError){
                          case 1:
                            echo "上傳的檔案太大了!\n";
                            break;
                          case 2:
                            echo "上傳的檔案太大了!\n";
                            break;
                          case 3:
                            echo "只上傳部分檔案\n";
                            break;
                          case 4:
                            echo "未上傳檔案\n";
                            break;
                          case 6:
                            echo "伺服器temp檔案遺失\n";
                            break;
                          case 7:
                            echo "不能寫入伺服器硬碟\n";
                            break;
                          case 8:
                            echo "php的外掛終止檔案上傳\n";
                            break;
                        }
                      }
                    }
                    return $valid;
                  }

                  function getImage($db, $ID, &$AllImages) { //資料庫, OrderID, 全部上傳圖片的名字(用,分開); //出錯回傳false

                    if(!validUpload())//出錯回傳false
                      return false;

                    else {
                      mkdir("./book_images/" . $ID);//先創建資料夾才能放東西
                      $fileCount = 0;
                      foreach($_FILES['images']['name'] as $imageName){
                        $newImageName = "./book_images/" . $ID . "/" . $imageName; //還要再加上userID
                        $AllImages = $AllImages . $imageName . ",";
                        move_uploaded_file($_FILES['images']["tmp_name"][$fileCount], $newImageName);
                        $fileCount++;
                      }
                      return true;
                    }
                  }

                  function editMakes($db, $ID){
                    $query = ("INSERT INTO makes VALUES(?,?)");
                    $stmt = $db->prepare($query);
                    $result = $stmt->execute(array($ID, $_SESSION['account']));
                  }

                  function getBookInfo($db, $ID, &$AllImages){          

                    $name = $_POST["name"];
                    $author = $_POST["publisher"];
                    $ISBN = $_POST["ISBN"];
                    $publisher = $_POST["publisher"];
                    $price = $_POST["price"];
                    $category = $_POST["category"];

                    $query = ("INSERT INTO bookOrder VALUES(?,?,?,?,?,?,?, ?, ?)");
                    $stmt = $db->prepare($query);
                    $result = $stmt->execute(array($ID, $ISBN, $name, $author, $publisher, $AllImages, $price, $category, 0));
                  }

                  if(isset($_POST["submitP"])) {

                    //拿Order_ID
                    $query = ("SELECT max(order_ID) AS t FROM bookOrder;");
                    $stmt = $db->prepare($query);
                    $error = $stmt->execute();
                    $result = $stmt->fetchAll();
                    $ID = $result[0]['t'] + 1; //最大Order+1為新Order

                    $AllImages = "";//準備拿來存全部的圖片名字
                    if(getImage($db, $ID, $AllImages)){ //get 到 image 後 加入bookOrder db
                       getBookInfo($db, $ID, $AllImages); //修改bookOrder
                       editMakes($db, $ID); //修改makes
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
