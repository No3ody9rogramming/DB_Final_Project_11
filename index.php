
<!DOCTYPE html>
<html>
<head>
  <link href="css/index.css" rel="stylesheet" type="text/css" />
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <meta charset = "utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <!-- <style type="text/css">
    
  </style> -->

</head>
<script type="text/javascript">
  /*var items_count=16;
  var category_count=7;
  var img_src="大頭.jpg";
  var name="邱吉";
  var address="你心中";
  var condition="販售中";
  var tmp;

  $(document).ready(function(){
    for(var i=0;i<items_count;i++){
    $( ".c_bottom" ).append( "<div class='items "+i+"''><div class='i_left'><img src="+img_src+"><form action='detail.php' method='post'><input type='hidden' name='bookID' value='1'><input class='items_b "+i+"' name='btnsubmit' id = "+i+" type = 'submit' value = 'look'></form></div><div class='introduce'><ul><li class='name'><span class='label'>名字:</span><span class='input' id='input_name'>"+name+"</span></li><li class='address'><span class='label'>地址:</span><span class='input' id='input_address'>"+address+"</span></li><li class='condition'><span class='label'>狀態:</span><span class='input' id='input_condition'>"+condition+"</span></li></ul></div></div>" );
     }
  });*/
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
function toChangeAccount() {
  if (logIn == false)
    document.location.href = "signup.php";
  else {
    document.location.href = "account.php";
  }
}
</script>
<body>
<div class="main">
  <?php
      require_once "dbconnect.php";
      session_cache_limiter("private");
      session_start();
      //echo "<script>console.log('".$_SESSION["account"]."');</script>";
  ?>
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
        <a  href="#" onclick="toChangeAccount()">
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
        <!-- <input class="category_button" id = "category_button1" type = "button" value = "">
        <input class='category_button' id = "category_button2" type = "button" value = "">
        <input class='category_button' id = "category_button3" type = "button" value = "">
        <input class='category_button' id = "category_button4" type = "button" value = "">
        <input class='category_button' id = "category_button5" type = "button" value = "">
        <input class='category_button' id = "category_button6" type = "button" value = ""> -->
        <?php  
          $query = ("SELECT category, COUNT(order_ID) AS total FROM bookOrder GROUP BY category ORDER BY category DESC;");
          $stmt = $db->prepare($query);
          $error = $stmt->execute();
          $result = $stmt->fetchAll();

          $categorycount=0;

          foreach ($result as $rows) {
            $str = $rows['category'];
            $str1 = $rows['total'];
           
            echo "<form action='' method='post'><input type='hidden' name='category' value='".$str."'><input class='category_button' id='category_button".$categorycount."' type = 'submit' value='".$str."(".$str1.")' name='categorySubmit'></input></form>";
            $categorycount++;
          }
        ?>
      </div>
    </div>
    <div class="c_center">
      <div class="c_top">
        <div class="search">
        <form action = "" method = "post" id="inputForm"> 
          <input id = "search_id" type = "text" value = "" name="search_id" placeholder="請輸入">
          <input id = "search_button" type = "submit" name = "btnsubmit" value = "search">
        </form>
          
        </div>
      </div>
      <div class="c_bottom" id="c_bottom">
       
        <?php
        function search($db) {
              $search = $_POST['search_id'];
              //echo "<script>console.log('".$search."');</script>";
              $id = $search;
              $query = ("SELECT * FROM bookOrder WHERE name LIKE '%".$id."%';");
              $stmt = $db->prepare($query);
              $error = $stmt->execute();
              $result = $stmt->fetchALl();
              if(count($result) > 0){
                $bookcount=0;
                foreach ($result as $rows) {
                  $bookname[$bookcount]=$rows['name'];
                  $bookprice[$bookcount]=$rows['price'];
                  $booksell[$bookcount]=$rows['isSelled'];
                  $order_ID[$bookcount]=$rows['order_ID'];
                  $orderpic[$bookcount]=$rows['image'];

                  $img_arr = mb_split(",",$orderpic[$bookcount]);

                  echo "<label>";
                  echo "<div class='items ".$bookcount."'>";
                  echo "<div class='i_left'>";
                  echo "<img src='book_images/".$order_ID[$bookcount]."/".$img_arr[0]."'>";
                  echo "<form action='detail.php' method='post'>";
                  echo "<input type='hidden' name='bookID' value='".$order_ID[$bookcount]."'>";
                  echo "<input class='items_b ".$bookcount."' name='btnsubmit' id = '".$bookcount."' type='submit' value='look' style='display:none'>";
                  echo "</form></div>";
                  echo "<div class='introduce'><ul><li class='name'><span class='label'>名字:</span><span class='input' id='input_name'>".$bookname[$bookcount]."</span></li>";
                  echo "<li class='address'><span class='label'>價格:</span><span class='input' id='input_address'>".$bookprice[$bookcount]."</span></li>";
                  echo "<li class='condition'><span class='label'>狀態:</span><span class='input' id='input_condition'>".$booksell[$bookcount]."</span></li></ul></div></div>";
                  $bookcount++;
                  echo "</label>";
                }
              }
            }

        if(isset($_POST["btnsubmit"])) {      
          search($db);
        }
        else if(isset($_POST["categorySubmit"])) {
          $category = $_POST["category"];
          $query = ("SELECT * FROM bookOrder WHERE category='".$category."';");
          $stmt = $db->prepare($query);
          $error = $stmt->execute();
          $result = $stmt->fetchAll();
          $bookcount=0;
          foreach ($result as $rows) {
            $bookname[$bookcount]=$rows['name'];
            $bookprice[$bookcount]=$rows['price'];
            $booksell[$bookcount]=$rows['isSelled'];
            $order_ID[$bookcount]=$rows['order_ID'];
            $orderpic[$bookcount]=$rows['image'];

            $img_arr = mb_split(",",$orderpic[$bookcount]);

            echo "<label>";
            echo "<div class='items ".$bookcount."'>";
            echo "<div class='i_left'>";
            echo "<img src='book_images/".$order_ID[$bookcount]."/".$img_arr[0]."'>";
            echo "<form action='detail.php' method='post'>";
            echo "<input type='hidden' name='bookID' value='".$order_ID[$bookcount]."'>";
            echo "<input class='items_b ".$bookcount."' name='btnsubmit' id = '".$bookcount."' type='submit' value='look' style='display:none'>";
            echo "</form></div>";
            echo "<div class='introduce'><ul><li class='name'><span class='label'>名字:</span><span class='input' id='input_name'>".$bookname[$bookcount]."</span></li>";
            echo "<li class='address'><span class='label'>價格:</span><span class='input' id='input_address'>".$bookprice[$bookcount]."</span></li>";
            echo "<li class='condition'><span class='label'>狀態:</span><span class='input' id='input_condition'>".$booksell[$bookcount]."</span></li></ul></div></div>";
            $bookcount++;
            echo "</label>";
          }
        }
        else {
          $query = ("SELECT * FROM bookOrder;");
          $stmt = $db->prepare($query);
          $error = $stmt->execute();
          $result = $stmt->fetchAll();
          $bookcount=0;
          foreach ($result as $rows) {
            $bookname[$bookcount]=$rows['name'];
            $bookprice[$bookcount]=$rows['price'];
            $booksell[$bookcount]=$rows['isSelled'];
            $order_ID[$bookcount]=$rows['order_ID'];
            $orderpic[$bookcount]=$rows['image'];

            $img_arr = mb_split(",",$orderpic[$bookcount]);

            echo "<label>";
            echo "<div class='items ".$bookcount."'>";
            echo "<div class='i_left'>";
            echo "<img src='book_images/".$order_ID[$bookcount]."/".$img_arr[0]."'>";
            echo "<form action='detail.php' method='post'>";
            echo "<input type='hidden' name='bookID' value='".$order_ID[$bookcount]."'>";
            echo "<input class='items_b ".$bookcount."' name='btnsubmit' id = '".$bookcount."' type='submit' value='look' style='display:none'>";
            echo "</form></div>";
            echo "<div class='introduce'><ul><li class='name'><span class='label'>名字:</span><span class='input' id='input_name'>".$bookname[$bookcount]."</span></li>";
            echo "<li class='address'><span class='label'>價格:</span><span class='input' id='input_address'>".$bookprice[$bookcount]."</span></li>";
            echo "<li class='condition'><span class='label'>狀態:</span><span class='input' id='input_condition'>".$booksell[$bookcount]."</span></li></ul></div></div>";
            $bookcount++;
            echo "</label>";
          }
        }
        if (isset($_SESSION["account"])) {
          echo "<script>document.getElementById('account').innerHTML = 'hi, <a href=\"mybook.php\" style=\"color:#02e9ff\">".$_SESSION["account"]."</a>'</script>";
          echo "<script>logIn = true</script>";
          echo "<script>document.getElementById('logIn').value = 'Log Out';</script>";
          echo "<script>document.getElementById('signIn').value = '修改帳戶';</script>";
          // echo "<script>$('.sign_a').attr('href','account.php');
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