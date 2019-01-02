<!DOCTYPE html>
<html>
<head>
  <link href="css/message.css" rel="stylesheet" type="text/css" />
  
  
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
 

  <meta charset = "utf-8">
  <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
  <title></title>
</head>
<script type="text/javascript">
  var message_count=15
  var books_items_count=10
  var img_src="src/Books.jpg";
  var book_slick_img="src/test.jpg";
  var name="邱吉";
  var address="你心中";
  var condition="販售中";
  var category_count=7;
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
  <?php
      session_cache_limiter('private');
      session_start();
      require_once "dbconnect.php"; //更嚴謹，需要確實加入此PHP  
      if (!isset($_POST["messageSubmit"]) && !isset($_POST["sendMessage"])) {
        echo "<script>history.go(-1)</script>";
      }
      if (!isset($_SESSION["account"])) {
        echo "<script>history.go(-1)</script>";
      }
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
      <div class="c_top">
        <div class="introduce">
          <ul>
            <li class="bookname"> 
              <span class="label bookname_label">書名：</span>
              <span class="value bookname_value" id="bookName"></span>
            </li>
            <li class="condition">
              <span class="label condition_label">&nbsp;&nbsp;&nbsp;&nbsp;ISBN：</span>
              <span class="value condition_value" id="ISBN"></span>   
            </li>
            <li class="sell">
              <span class="label sell_label">&nbsp;&nbsp;&nbsp;&nbsp;售價：</span>
              <span class="value sell_value" id="price"></span>
            </li>
          </ul>         
        </div>
      </div> 
      <div class="c_bottom">
        
      </div>
      <div class="input_message">
        <form action="message.php" method="post" class="message_form">
          <input type="hidden" id="bookID" name="bookID">
          <input type="text" name="data" id="input_message_id" class="input_message_text">
          <input type="submit" name="sendMessage" id="send"  class="send" value="send">
        </form>
      </div>
    </div>
  <!-- </div> -->
    <!-- </div> -->
    <div class="c_right">
      <button class="ad_b" type="button"><img src="大頭.jpg"></button>
      <button class="ad_b" type="button"><img src=""></button>
    </div>
  </div>
  <!-- <div class="bottom"></div> -->
</div>
<?php
  print_r($_POST);
  print_r($_SESSION);
  if (isset($_POST["sendMessage"])) {
    echo "<script>console.log('asdf');</script>";
    $query = ("SELECT max(message_ID) AS t FROM message WHERE order_ID = ".$_POST["bookID"].";");
    $stmt = $db->prepare($query);
    $error = $stmt->execute();
    $result = $stmt->fetchAll();
    $maxi = $result[0]['t'];

    if (is_null($maxi)) {
      $maxi = 0;
    }
    else {
      $maxi += 1;
    }

    $query = ("INSERT INTO message VALUES (".$_POST["bookID"].", ".$maxi.", '".$_SESSION["account"]."', '".$_POST["data"]."', CURRENT_TIMESTAMP);");;
    print_r($query);
    $stmt = $db->prepare($query);
    $error = $stmt->execute();
  }
  if (isset($_SESSION["account"])) {
    echo "<script>document.getElementById('account').innerHTML = 'hi, <a href=\"mybook.php\" style=\"color:#02e9ff\">".$_SESSION["account"]."</a><a href=\"account.php\">修改帳戶</a>'</script>";
    echo "<script>logIn = true</script>";
    echo "<script>document.getElementById('logIn').value = 'Log Out';</script>";
    echo "<script>document.getElementById('signIn').style.display = 'none';</script>";

    $query = "SELECT name, price, ISBN FROM bookOrder WHERE order_ID = ".$_POST["bookID"].";";
    $stmt = $db->prepare($query);
    $error = $stmt->execute();
    $result = $stmt->fetchAll();

    echo "<script>document.getElementById('bookName').innerHTML = \"".$result[0]["name"]."\"</script>";
    echo "<script>document.getElementById('price').innerHTML = \"".$result[0]["price"]."\"</script>";
    echo "<script>document.getElementById('ISBN').innerHTML = \"".$result[0]["ISBN"]."\"</script>";
    echo "<script>document.getElementById('bookID').value = \"".$_POST["bookID"]."\"</script>";

    $query = "SELECT account_ID, data, message_time FROM message WHERE order_ID = ".$_POST["bookID"]." ORDER BY message_ID;";
    $stmt = $db->prepare($query);
    $error = $stmt->execute();
    $result = $stmt->fetchAll();

    $query = "SELECT account_ID FROM makes WHERE order_ID = ".$_POST["bookID"].";";
    $stmt = $db->prepare($query);
    $error = $stmt->execute();
    $seller = $stmt->fetchAll()[0]["account_ID"];

    echo "<script>$(document).ready(function(){ </script>";
    foreach ($result as $row) {
      if (!strcmp($seller, $row["account_ID"])) {
        echo "<script>$( \".c_bottom\" ).append( \"<div class='message'>".$row["account_ID"]."(賣家) : ".$row["data"]."</div><div class='time'>".$row["message_time"]."</div>\");</script>";
      }
      else {
        echo "<script>$( \".c_bottom\" ).append( \"<div class='message'>".$row["account_ID"]." : ".$row["data"]."</div><div class='time'>".$row["message_time"]."</div>\");</script>";
      }
    }
    echo "<script>});</script>";
  }
?>
</body>
</html>
