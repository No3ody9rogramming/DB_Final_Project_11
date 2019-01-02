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
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
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
      //$(".category_items").append("<input class='category_button' id = '"+i+"' type = 'button' value = ''>");
     }
  
});
    var logIn = false;
 $(document).ready(function(){
  $(".titlename").click(function() {
    document.location.href = "https://www.pornhub.com";
  });
  
  $(".titlesquare").click(function() {
    document.location.href = "index.php";
  });
});

function toSignUp() {
  if (logIn == false)
    document.location.href = "login.php";
  else {
    document.location.href = "logout.php";
  }
}
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
          <div class="account" id="account">hi, willchiu</div>
          <div class="account_b">
            <a href="signup.php">
              <input id = "signIn" type = "submit" value = "Sign Up">
            </a>
            <a href="#" onclick="toSignUp()">
              <input id = "logIn" type = "button" value = "Log In">
            </a>
          </div> 
        </div>
      </div>
      <div class="center">
        <div class="c_left">
          <a href="mybook.php">
            <div class="category_title">新增</div>
          </a>
          <div class="category_items">
            <?php

              if(isset($_POST['deleteB'])){
                $query = ("DELETE FROM bookOrder WHERE order_ID=?;");
                $stmt = $db->prepare($query);
                $stmt->execute([$_POST['orderID']]);
              }

              if(isset($_POST['categorySubmit'])){
                $query = "SELECT account_ID, order_ID, name, ISBN, author, publisher, user_name, phoneNum, city, school_name, department, isSelled, price, image, category FROM makes NATURAL JOIN bookOrder NATURAL JOIN users WHERE order_ID = '".$_POST["orderID"]."';";
                $stmt = $db->prepare($query);
                $error = $stmt->execute();
                $result = $stmt->fetchAll();

                echo "<script>$(document).ready(function() {\n\t";
                echo "$('#bookName').val('" . $result[0]['name'] . "');\n\t";
                echo "$('#author').val('" . $result[0]['author'] . "');\n\t";
                echo "$('#publisher').val('" . $result[0]['publisher'] . "');\n\t";
                echo "$('#ISBN').val('" . $result[0]['ISBN'] . "');\n\t";
                echo "$('#price').val('" . $result[0]['price'] . "');\n\t";
                echo "$('#orderID').val('" . $_POST["orderID"] . "');\n\t";
                echo "$('#orderIDDelete').val('" . $_POST["orderID"] . "');\n\t";
                echo "$('#isSelled').css('display', 'block');\n\t";
                echo "$('#deleteB').css('display', 'block');\n\t";
                echo "$('#submitP').val('修改書籍');\n";
                echo "});</script>";

              }

              $query = "SELECT account_ID, order_ID, name, ISBN, author, publisher, user_name, phoneNum, city, school_name, department, isSelled, price, image, category FROM makes NATURAL JOIN bookOrder NATURAL JOIN users WHERE account_ID = '".$_SESSION["account"]."';";
              $stmt = $db->prepare($query);
              $error = $stmt->execute();
              $result = $stmt->fetchAll();

              $categorycount=0;

              foreach ($result as $rows) {
                $bookname = $rows['name'];
                $orderID = $rows['order_ID'];
               
                echo "<form action='' method='post'><input type='hidden' name='orderID' value='".$orderID."'><input class='category_button' id='category_button".$categorycount."' type = 'submit' value='".$bookname."' name='categorySubmit'></input></form>"; //此處的orderID是給categorySubmit的時候用
                $categorycount++;
              }
            ?>
          </div>
        </div>
        <div class="c_center">
          <div class="c_top creat">
            <div class="book_img">
              <img class="main_img" src="src/Books.jpg">
              <div class="image_select"> </div>
            </div>
            <div class="introduce">
              <form action="" method="post" enctype="multipart/form-data">
                <ul>
                  <li class="creat_title bookname">書名：</li>
                  <input id="bookName" name="name" type="text" class='creat'>
                </ul>
                <ul>
                  <li class="creat_title owner">作者：</li>
                  <input id="author" name="author" type="text" class='creat'>
                </ul>
                <ul>
                  <li class="creat_title sell">出版：</li>
                  <input id="publisher" name="publisher" type="text" class='creat'>
                </ul>
                <ul>
                  <li class="creat_title address">ISBN：</li>
                  <input id="ISBN" name="ISBN" type="text" class='creat'>
                </ul>
                <ul>
                  <li class="creat_title">價格:</li>
                  <input id="price" name="price" type="number" class='creat'>
                </ul>
                <ul id="isSelled" style="display: none;">
                  <li class="creat_title">是否賣出</li>
                  <select class="drop_down category" name="isSelled">
                    <option value="0">否</option>
                    <option value="1">是</option>
                  </select> 
                </ul>
                <ul>
                  <li>選擇圖片</li><input accept="image/jpg,image/png,image/jpeg,image/bmp" type="file" name="images[]" class="select" multiple>
                </ul>
                <ul>
                  <li class="creat_title">書籍分類:</li>
                  
                    <select class="drop_down category" id='category' name="category"> 
                    <?php
                    //require_once "dbconnect.php";
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
                
                    <input id="orderID" type="hidden" name="orderID">
                    <input id="submitP" type="submit" name="submitP" class="edit" value="新增書籍"> 
                  
              </form>
              <form action="" method="post">
               
                    <input id="orderIDDelete" type="hidden" name="orderID">
                    <input type="submit" name="deleteB" id="deleteB" class="delete" style="display:none;" value="刪除此書">
                  
              </form>
              <div>
                <?php

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
                      if(!is_dir("./book_images/" . $ID)) {//資料夾存在就不創造
                        mkdir("./book_images/" . $ID);//先創建資料夾才能放東西
                      }
                      $fileCount = 0;
                      foreach($_FILES['images']['name'] as $imageName){
                        $newImageName = "./book_images/$ID/$imageName";
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

                  function newBook($db, $ID, &$AllImages){          

                    $name = $_POST["name"];
                    $author = $_POST["author"];
                    $ISBN = $_POST["ISBN"];
                    $publisher = $_POST["publisher"];
                    $price = $_POST["price"];
                    $category = $_POST["category"];

                    $query = ("INSERT INTO bookOrder VALUES(?,?,?,?,?,?,?, ?, ?)");
                    $stmt = $db->prepare($query);
                    $result = $stmt->execute(array($ID, $ISBN, $name, $author, $publisher, $AllImages, $price, $category, 0));
                  }

                  function editBook($db, $ID, &$AllImages){

                    $name = $_POST["name"];
                    $author = $_POST["publisher"];
                    $ISBN = $_POST["ISBN"];
                    $publisher = $_POST["publisher"];
                    $price = $_POST["price"];
                    $category = $_POST["category"];
                    $isSelled = $_POST["isSelled"];

                    $ID = (int)$ID;

                    $query = ("UPDATE bookOrder SET ISBN=?, name=?, author=?, publisher=?, image=?, price=?, category=?, isSelled=? WHERE order_ID=?;");
                    $stmt = $db->prepare($query);
                    $result = $stmt->execute(array($ISBN, $name, $author, $publisher, $AllImages, $price, $category, $isSelled, $ID));
                  }

                  if(isset($_POST["submitP"])) {

                    $ID = 0;
                    $AllImages = "";//準備拿來存全部的圖片名字

                    if($_POST['submitP']=="修改書籍"){//左邊欄位已被點擊
                      $ID = $_POST['orderID'];//此處為網頁左邊的已上傳書籍orderID

                      if(getImage($db, $ID, $AllImages)){ //get 到 image 後 加入bookOrder db
                       editBook($db, $ID, $AllImages); //修改bookOrder
                      }
                    }
                    elseif($_POST['submitP']=="新增書籍") {//拿新的Order_ID
                      $query = ("SELECT max(order_ID) AS t FROM bookOrder;");
                      $stmt = $db->prepare($query);
                      $error = $stmt->execute();
                      $result = $stmt->fetchAll();
                      $ID = $result[0]['t'] + 1; //最大Order+1為新Order
                      if(getImage($db, $ID, $AllImages)){ //get 到 image 後 加入bookOrder db
                       newBook($db, $ID, $AllImages); //修改bookOrder
                       editMakes($db, $ID); //修改makes
                      }
                      else {
                        echo "Invalid book!";
                      }
                    }

                  }

                ?>
              </div>
            </div> 
          </div>
          <div class="c_bottom" style="display:none;">
          </div>
        </div>
        <div class="c_right">
          <button class="ad_b" type="button"><img src="大頭.jpg"></button>
          <button class="ad_b" type="button"><img src=""></button>
        </div>
      </div>
    </div>
    <div class="bottom"></div>
    <?php
      if (isset($_SESSION["account"])) {
        echo "<script>document.getElementById('account').innerHTML = 'hi, <a href=\"mybook.php\" style=\"color:#02e9ff\">".$_SESSION["account"]."</a><a href=\"account.php\">修改帳戶</a>'</script>";
        echo "<script>logIn = true</script>";
        echo "<script>document.getElementById('logIn').value = 'Log Out';</script>";
        echo "<script>document.getElementById('signIn').style.display = 'none';</script>";
      }
    ?>
  </body>
</html>
