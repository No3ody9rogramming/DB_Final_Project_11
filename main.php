
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
</script>
<body>
<div class="main">
  <?php
      require_once "dbconnect.php";
      session_start();
      echo "<script>console.log('".$_SESSION["account"]."');</script>";
  ?>
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
    <hr>
    <div class="information"><marquee class="marquee">這裡放要跑的文字</marquee></div>
  </div>
  <div class="center">
    <div class="c_left">
      <div class="category_title">category</div>
      <div class="category_items">
        <!-- <input class="category_button" id = "category_button1" type = "button" value = "">
        <input class='category_button' id = "category_button2" type = "button" value = "">
        <input class='category_button' id = "category_button3" type = "button" value = "">
        <input class='category_button' id = "category_button4" type = "button" value = "">
        <input class='category_button' id = "category_button5" type = "button" value = "">
        <input class='category_button' id = "category_button6" type = "button" value = ""> -->
        <?php  
          $query = ("SELECT * FROM category ORDER BY category.category DESC;");
          $stmt = $db->prepare($query);
          $error = $stmt->execute();
          $result = $stmt->fetchAll();
          $categorycount=0;
          foreach ($result as $rows) {
            $str = $rows['category'];
            echo "<input class='category_button' id='category_button".$categorycount."' type = 'button' value='$str'></input>";
            $categorycount++;
          }
        ?>
      </div>
    </div>
    <div class="c_center">
      <div class="c_top">
        <div class="search">
          <input id = "search_id" type = "text" value = "" placeholder="請輸入">
          <input id = "search_button" type = "button" value = "search">
        </div>
      </div>
      <div class="c_bottom" id="c_bottom">
        <?php
          $query = ("SELECT * FROM bookOrder;");
          $stmt = $db->prepare($query);
          $error = $stmt->execute();
          $result = $stmt->fetchAll();
          $bookcount=0;
          foreach ($result as $rows) {
            $bookname[$bookcount]=$rows['name'];
            $bookprice[$bookcount]=$rows['price'];
            $booksell[$bookcount]=$rows['isSelled'];
            echo "<div class='items ".$bookcount."'>";
            echo "<div class='i_left'>";
            echo "<img src='大頭.jpg'>";
            echo "<form action='detail.php' method='post'>";
            echo "<input type='hidden' name='bookID' value='1'>";
            echo "<input class='items_b ".$bookcount."' name='btnsubmit' id = '".$bookcount."' type='submit' value='look'>";
            echo "</form></div>";
            echo "<div class='introduce'><ul><li class='name'><span class='label'>名字:</span><span class='input' id='input_name'>".$bookname[$bookcount]."</span></li>";
            echo "<li class='address'><span class='label'>價格:</span><span class='input' id='input_address'>".$bookprice[$bookcount]."</span></li>";
            echo "<li class='condition'><span class='label'>狀態:</span><span class='input' id='input_condition'>".$booksell[$bookcount]."</span></li></ul></div></div>";
            $bookcount++;
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