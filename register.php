<!DOCTYPE html>
<html>
<head>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/register.css">
  <meta charset = "utf-8">
  <title>Bookhub Register</title>
</head>
<script type="text/javascript">
  /*
  $(document).ready(function(){
  $("#acountCheck2").hide();
  $("#passwordCheck2").hide(); });
  */
  

</script>
<body>
  <?php
      require_once "dbconnect.php"; //更嚴謹，需要確實加入此PHP  
  ?>
  <div class="main">
  <div class="top">
    <div class="title">Book
      <div class="titlesquare">hub</div>
    </div>
  </div>
  <div class="center">
    <img src="src/Books.jpg">
    <div class="c_left">
      <div class="l_message">THERE'S A LOT MORE <br>TO BOOKHUB THAN <br>YOU THINK</div>
      <ul class="l_buttons">
        <li class="l_button">
          <img src="src/my-icons-collection/png/001-home.png" class="b_img">
          <input id = "Home_button" type = "button" value = "Home" class="button">
          <!-- <div class="button">Home</div> -->
        </li>
        <li class="l_button">
          <img src="src/my-icons-collection/png/002-book.png" class="b_img">
          <input id = "Books_button" type = "button" value = "Books" class="button">
        </li>
        <li class="l_button">
          <img src="src/my-icons-collection/png/003-search.png" class="b_img">
          <input id = "Search_button" type = "button" value = "Search" class="button">
        </li>
        <li class="l_button">
          <img src="src/my-icons-collection/png/004-mechanic.png" class="b_img">
          <input id = "Mechanic_button" type = "button" value = "Mechanic" class="button">
        </li>
        <li class="l_button">
          <img src="src/my-icons-collection/png/005-mail.png" class="b_img">
          <input id = "Mail_button" type = "button" value = "Mail" class="button">
        </li>
        <li class="l_button">
          <img src="src/my-icons-collection/png/006-star.png" class="b_img">
          <input id = "Star_button" type = "button" value = "Star" class="button">
        </li>
      </ul>
    </div>
    <div class="c_center">
      <div class="c_form">
        <h2>Sign up for free</h2>
        <span class="subtitle">and enhance your experience</span>
        <form action = "" method = "post" id="inputForm"> 
            <input class="creat" type = "text" name = "account_ID" id = "account_ID" autofocus="" placeholder="帳號(帳號介於6到12個字元)">
            <span id="acountCheck" class="wrongMessage"> 此帳號已存在</span>
          
            <input class="creat" type = "password" name = "password" id = "password" placeholder="密碼(密碼介於6到12個字元)">
            <span id="passwordCheck" class="wrongMessage"> 密碼介於6到12個字元</span>
           
            <input class="creat" type = "password" name = "password2" id = "password2" placeholder="再次輸入密碼"><br>
            <span id="passwordCheck2" class="wrongMessage"> 與第一次密碼不相符</span>
          
            <input class="creat" type = "text" name = "user_name" id="user_name" placeholder="使用者名稱">
             
            <input class="creat phone" type = "text" name = "phoneNum" placeholder="電話號碼(長度為10, e.g. 0912345678)">
            <span id="phoneNumCheck" class="wrongMessage"> 長度為10, e.g. 0912345678</span>

            <select class="drop_down" id='city' name="city"> 
            <?php
              $query = ("SELECT DISTINCT city FROM school;");
              $stmt = $db->prepare($query);
              $error = $stmt->execute();
              $result = $stmt->fetchAll();
              $citycount=0;
              foreach ($result as $rows) {
                $name[$citycount] = $rows['city'];
                echo "<option id='idx".$citycount."'>".$rows['city']."</option>";
                $citycount++;
              }
            ?>
          </select>
          
          <select class="drop_down" id='school_name' name="school_name"></select><br>

          <select class="drop_down" id='department' name="department"></select><br>

          <input class="creat" type = "submit" name = "btnsubmit" value = "送出">
        </form>
        <?php
          function register($db) {//傳入$db即不用宣告
            $account_ID = $_POST['account_ID'];
            $password = $_POST['password'];
            $password2 = $_POST['password2'];
            $user_name = $_POST['user_name'];
            $phoneNum = $_POST['phoneNum'];
            $city = $_POST['city'];
            $school_name = $_POST['school_name'];
            $department = $_POST['department'];
            $account_IDLength = strlen($account_ID);
            $passwordLength = strlen($password);

            $isWrong = 0;
            if($account_IDLength < 6 || $account_IDLength > 12){
                echo "<script>document.getElementById('acountCheck').style.display='block';</script>\n\t\t";
                echo "<script>document.getElementById('acountCheck').innerHTML=' 帳號介於6到12個字元';</script>\n\t\t";
                echo "<script>console.log(document.getElementById('acountCheck'));</script>\n\t\t";
                echo "<script>document.getElementById('acountCheck').style.color='red';</script>\n\t\t";
              $isWrong = 1;
            }
            else {//判斷是否已存在帳號       
              $id = $account_ID;
              $query = ("SELECT account_ID FROM users WHERE account_ID=?");
              $stmt = $db->prepare($query);
              $error = $stmt->execute(array($id));
              $result = $stmt->fetchALl();
              if(count($result) > 0){
                echo "<script>console.log(document.getElementById('acountCheck'));</script>\n\t\t";
                echo "<script>document.getElementById('acountCheck').style.display='block';</script>\n\t\t";
                echo "<script>document.getElementById('acountCheck').value=' 此帳號已存在';</script>\n\t\t";
                echo "<script>console.log(document.getElementById('acountCheck'));</script>\n\t\t";
                echo "<script>document.getElementById('acountCheck').style.color='red';</script>\n\t\t";
                $isWrong = 1;
              }
            }
            //echo "<script>console.log(".strcmp($_POST['password'], $_POST['password2']).");</script>";
            if($passwordLength < 6 || $passwordLength > 12){
              echo "<script>document.getElementById('passwordCheck').style.display='block';</script>\n\t\t";
              echo "<script>document.getElementById('passwordCheck').style.color='red';</script>\n\t\t";
              $isWrong = 1;
            }
            else if(strcmp($_POST['password'], $_POST['password2']) != 0) {
              echo "<script>document.getElementById('passwordCheck2').style.display='block';</script>\n\t\t";
              echo "<script>document.getElementById('passwordCheck2').style.color='red';</script>\n\t\t";
              $isWrong = 1;
            }
            if(!(is_numeric($phoneNum) && strlen($phoneNum) == 10)){
              echo "<script>console.log(document.getElementById('phoneNumCheck'));</script>\n\t\t";
              echo "<script>document.getElementById('phoneNumCheck').style.display='block';</script>\n\t\t";
              echo "<script>document.getElementById('phoneNumCheck').style.color='red';</script>\n\t\t";
              $isWrong = 1;
            }
            if($isWrong == 0){//新增使用者
              $query = ("INSERT INTO users VALUES(?,?,?,?,?,?,?)");
              $stmt = $db->prepare($query);
              $result = $stmt->execute(array($account_ID, $password, $user_name, $phoneNum, $school_name, $city, $department));
              $db = null;
              header('Refresh:3; url=index.php');//自動轉址
              echo "<script>document.getElementsByTagName('body')[0].style.color = 'white';</script>";
              //$str = "註冊成功!三秒後到登入頁面。<?php header('Refresh:3; url=index.php');
              echo "<script>document.getElementsByTagName('body')[0].innerHTML = '註冊成功!三秒後到登入頁面。';</script>";
            }
            else{//回填已輸入的值    
              echo "<script>document.getElementsByName('user_name')[0].value='".$user_name."';</script>";
              echo "<script>document.getElementsByName('account_ID')[0].value='".$account_ID."';</script>";
              echo "<script>document.getElementsByName('password')[0].value='".$password."';</script>";
              echo "<script>document.getElementsByName('password2')[0].value='".$password2."';</script>";
              echo "<script>document.getElementsByName('phoneNum')[0].value='".$phoneNum."';</script>";
              echo "<script>document.getElementsByName('city')[0].value='".$city."';</script>";
              echo "<script>document.getElementsByName('school_name')[0].value='".$school_name."';</script>";
              echo "<script>document.getElementsByName('department')[0].value='".$department."';</script>";
            }

          }
          if(isset($_POST["btnsubmit"])) {      
            register($db);
          }
        ?>
        <script src="js//changeSelect.js" type="text/javascript" charset="utf-8"></script>
      </div>
    </div>
    <div class="c_right"></div>
  </div>
  <div class="bottom"></div>
</div>
</body>
</html>
