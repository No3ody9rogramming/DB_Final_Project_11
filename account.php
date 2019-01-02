<!DOCTYPE html>
<html>
<head>
  <link href="css/account.css" rel="stylesheet" type="text/css" />
  <link href="css/slick/slick-theme.css" rel="stylesheet" type="text/css" />
  <link href="css/slick/slick.css" rel="stylesheet" type="text/css" />
  
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script type="text/javascript" src="js/slick.min.js"></script>

  <meta charset = "utf-8">
  <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
  <title></title>
</head>
<script type="text/javascript">

  var logIn = false;
 $(document).ready(function(){
  $(".titlename").click(function() {
    document.location.href = "index.php";
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
    <?php
        require_once "dbconnect.php";
        session_start();
        //echo "<script>console.log('".$_SESSION["account"]."');</script>";
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
            <div class="account" id="account">hi, 訪客</div>
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
          <div class="category_title" id="category_title"><a href="index.php" style="text-decoration: none; color: black;">category</a></div>
          <div class="category_items">
            <?php  
              $query = ("SELECT category, COUNT(order_ID) AS total FROM bookOrder GROUP BY category ORDER BY category DESC;");
              $stmt = $db->prepare($query);
              $error = $stmt->execute();
              $result = $stmt->fetchAll();

              $categorycount=0;

              foreach ($result as $rows) {
                $str = $rows['category'];
                $str1 = $rows['total'];
               
                echo "<form action='index.php' method='post'><input type='hidden' name='category' value='".$str."'><input class='category_button' id='category_button".$categorycount."' type = 'submit' value='".$str."(".$str1.")' name='categorySubmit'></input></form>";
                $categorycount++;
              }
            ?>
          </div>
        </div>
        <div class="c_center">
          <div class="c_form">
            <h2>Account Management</h2>
            <span class="subtitle">update your account</span>
            <form action = "" method = "post" id="inputForm"> 
                <input class="creat" type = "text" name = "account_ID" id = "account_ID" placeholder="帳號(長度介於6到12個字元)" readonly="readonly">
              
                <input class="creat" type = "password" name = "password" id = "password" placeholder="密碼(長度介於6到12個字元)">
               
                <input class="creat" type = "password" name = "password2" id = "password2" placeholder="再次輸入密碼">
              
                <input class="creat" type = "text" name = "user_name" id="user_name" placeholder="使用者名稱(長度為25字元以內)" readonly="readonly">
                 
                <input class="creat" type = "text" name = "phoneNum" id="phoneNum" placeholder="電話號碼(長度為10, e.g. 0912345678)">

                <select class="drop_down city" id='city' name="city"> 
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

              <input class="submit" type="submit" name = "updateSubmit" value = "Save">

              <!-- <span class="or">&nbsp;&nbsp;&nbsp;&nbsp;Or&nbsp;&nbsp;</span>

              <a class="login" href="login.php">Log In</a> -->
            </form>
            <script type="text/javascript" src="js/changeSelect.js" charset="utf-8"></script>
            <?php
              if (isset($_POST["updateSubmit"])) {
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
                $isPasswordWrong = 0;
                $isPassword2Wrong = 0;
                $isPhoneNumWrong = 0;

                echo "<script>document.getElementsByName('account_ID')[0].value='".$account_ID."';</script>";
                echo "<script>document.getElementsByName('user_name')[0].value='".$user_name."';</script>";
                echo "<script>document.getElementsByName('city')[0].value='".$city."';</script>";
                echo "<script>setSchoolName('".$city."','".$school_name."','".$department."');</script>";

                //echo "<script>console.log(".strcmp($_POST['password'], $_POST['password2']).");</script>";
                if($passwordLength < 6 || $passwordLength > 12){
                  echo "<script>document.getElementById('password').className += ' wrongMessage';</script>";
                  echo "<script>document.getElementById('password2').className += ' wrongMessage';</script>";
                  $isWrong = 1;
                  $isPasswordWrong = 1;
                  $isPassword2Wrong = 1;
                }
                else if(strcmp($_POST['password'], $_POST['password2']) != 0) {
                  echo "<script>document.getElementById('password2').className += ' wrongMessage';</script>";
                  $isWrong = 1;
                  $isPassword2Wrong = 1;
                }
                if(!(is_numeric($phoneNum) && strlen($phoneNum) == 10)){
                  echo "<script>document.getElementById('phoneNum').className += ' wrongMessage';</script>";
                  $isWrong = 1;
                  $isPhoneNumWrong = 1;
                }
                echo "<script>console.log(".$isWrong.")</script>";
                echo "<script>console.log('".$school_name."')</script>";
                echo "<script>console.log('".$department."')</script>";
                echo "<script>console.log('".$city."')</script>";
                if ($isWrong == 0) {
                  $query = "UPDATE users SET password = ".$password.", phoneNum = ".$phoneNum.", school_name = '".$school_name."', city = '".$city."', department = '".$department."' WHERE account_ID = '".$account_ID."';";
                  echo "<script>console.log(\"".$query."\")</script>";
                  $stmt = $db->prepare($query);
                  $error = $stmt->execute(); 

                  echo "<script>document.getElementsByName('phoneNum')[0].value='".$phoneNum."';</script>";
                }
                else {
                  if ($isPasswordWrong == 0) {
                    echo "<script>document.getElementsByName('password')[0].value='".$password."';</script>";
                  }
                  if ($isPassword2Wrong == 0) {
                    echo "<script>document.getElementsByName('password2')[0].value='".$password2."';</script>";
                  }
                  if ($isPhoneNumWrong == 0) {
                    echo "<script>document.getElementsByName('phoneNum')[0].value='".$phoneNum."';</script>";
                  }
                }

                
                echo "<script>document.getElementById('account').innerHTML = 'hi, <a href=\"mybook.php\" style=\"color:#02e9ff\">".$_SESSION["account"]."</a><a href=\"account.php\">修改帳戶</a>'</script>";
                echo "<script>logIn = true</script>";
                echo "<script>document.getElementById('logIn').value = 'Log Out';</script>";
                echo "<script>document.getElementById('signIn').style.display = 'none';</script>";
              }
              else if(isset($_SESSION["account"])) {
                $query = ("SELECT * FROM users WHERE account_ID = '".$_SESSION["account"]."';");
                $stmt = $db->prepare($query);
                $error = $stmt->execute(); 
                $result = $stmt->fetchAll();
                echo "<script>document.getElementById('account_ID').value = \"".$_SESSION["account"]."\";</script>";
                echo "<script>document.getElementById('user_name').value = \"".$result[0]["user_name"]."\";</script>";
                echo "<script>document.getElementById('phoneNum').value = \"".$result[0]["phoneNum"]."\";</script>";

                echo "<script>document.getElementsByName('city')[0].value='".$result[0]["city"]."';</script>";
                echo "<script>setSchoolName('".$result[0]["city"]."','".$result[0]["school_name"]."','".$result[0]["department"]."');</script>";
                echo "<script>document.getElementById('account').innerHTML = 'hi, <a href=\"mybook.php\" style=\"color:#02e9ff\">".$_SESSION["account"]."</a><a href=\"account.php\">修改帳戶</a>'</script>";
                echo "<script>logIn = true</script>";
                echo "<script>document.getElementById('logIn').value = 'Log Out';</script>";
                echo "<script>document.getElementById('signIn').style.display = 'none';</script>";
              }
            ?>
          </div>
        </div>
        <div class="c_right">
          <a href="https://jimmy1244.github.io/Solar_System_Website/">
            <button  class="ad_b" type="button"><img src="./src/solar_system.png"></button>
          </a>
          <a href="https://hokuanyu.github.io/Web-Programming/">
            <button class="ad_b" type="button"><img src="./src/tank.png"></button>
          </a>
        </div>
      </div>
    </div>
    <div class="bottom"></div>
  </body>
</html>
