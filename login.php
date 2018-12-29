<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/login.css">
  <meta charset = "utf-8">
  <title>Bookhub Register</title>
</head>
<body>
  <?php
      session_start();
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
          <form action="main.php">
            <input id = "Home_button" type = "submit" value = "Home" class="button">
          </form>
          <!-- <div class="button">Home</div> -->
        </li>
        <li class="l_button">
          <img src="src/my-icons-collection/png/002-book.png" class="b_img">
          <form action="main.php">
            <input id = "Books_button" type = "submit" value = "Books" class="button">
          </form>
        </li>
        <li class="l_button">
          <img src="src/my-icons-collection/png/003-search.png" class="b_img">
          <form action="main.php">
            <input id = "Search_button" type = "submit" value = "Search" class="button">
          </form>        
        </li>
        <li class="l_button">
          <img src="src/my-icons-collection/png/004-mechanic.png" class="b_img">
          <form action="main.php">
            <input id = "Mechanic_button" type = "submit" value = "Mechanic" class="button">
          </form>
        </li>
        <li class="l_button">
          <img src="src/my-icons-collection/png/005-mail.png" class="b_img">
          <form action="mailto:someone@gmail.com">
            <input id = "Mail_button" type = "submit" value = "Mail" class="button">
          </form>
        </li>
        <li class="l_button">
          <img src="src/my-icons-collection/png/006-star.png" class="b_img">
          <form action="main.php">
            <input id = "Star_button" type = "submit" value = "Star" class="button">
          </form>
        </li>
      </ul>
    </div>
    <div class="c_center">
      <div class="c_form">
        <h2>Member login</h2>
        <span class="subtitle">Access your Bookhub account</span>
        <form action = "" method = "post" id="inputForm">
          <input class="creat" type = "text" name = "account_ID" id = "account_ID" autofocus="" placeholder="請輸入帳號">

          <input class="creat" type = "password" name = "password" id = "password" placeholder="請輸入密碼"><br>

          <input class="submit" type="submit" name = "btnsubmit" value = "Log In">

          <span class="or">&nbsp;&nbsp;&nbsp;&nbsp;Or&nbsp;&nbsp;</span>

          <a class="login" href="signup.php">Sign Up</a>
        </form>
        <?php
		  function logIn($db) {
			$query = ("SELECT * FROM users WHERE account_ID = '" . $_POST["account_ID"] . "';");
		  	$stmt = $db->prepare($query);
		  	$error = $stmt->execute();
		  	$account = $stmt->fetchAll();

			$query = ("SELECT * FROM users WHERE account_ID = '" . $_POST["account_ID"] . "' AND password = '" . $_POST["password"] . "';");
		  	$stmt = $db->prepare($query);
		  	$error = $stmt->execute();
		  	$right = $stmt->fetchAll();
		  	if (count($right) == 1) {
          $_SESSION['account'] = $_POST['account_ID'];
		      echo "<script>console.log('right');</script>";
          echo "<script>console.log('".$_SESSION["account"]."');</script>";
          header("location:main.php");
		    }
		    else if (count($account) == 1) {
              echo "<script>document.getElementById('account_ID').value = '" .$_POST["account_ID"]. "';</script>";
              echo "<script>document.getElementById('password').placeholder = '密碼輸入錯誤';</script>";
              echo "<script>document.getElementById('password').className += ' wrongMessage';</script>";
		    }
		    else {
              echo "<script>document.getElementById('account_ID').placeholder = '此帳號不存在';</script>";
              echo "<script>document.getElementById('account_ID').className += ' wrongMessage';</script>";
              echo "<script>document.getElementById('password').placeholder = '請輸入密碼';</script>";
              echo "<script>document.getElementById('password').className += ' wrongMessage';</script>";
		    }
		  }
          if(isset($_POST["btnsubmit"])) {      
            logIn($db);
          }
        ?>
      </div>
    </div>
    <div class="c_right"></div>
  </div>
  <div class="bottom"></div>
</div>
</body>
</html>
