<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Bookhub</title>
	<link rel="stylesheet" type="text/css" href="css//index.css">
</head>
<body>
	<form action="" method="post" enctype="multipart/form-data">
		<p> 帳號 : <input type="text" name="account" id="account" placeholder="請輸入帳號"> </p>
		<p> 密碼 : <input type="password" name="password" id="password" placeholder="請輸入密碼"> </p>
		<input type="submit" value="登入" name="btnsubmit"><a href="register.php"><input type="button" value="註冊">
	</form>	
	<div id="wrong">輸入帳號密碼錯誤</div>
	<?php
		function signIn() {
			echo json_encode($_POST);
			$user = "admin";
			$passwd = "ntoucse";
			include_once "dbconnect.php";
			$query = ("SELECT * FROM users WHERE account_ID = '" . $_POST["account"] . "' AND password = '" . $_POST["password"] . "';");
			$stmt = $db->prepare($query);
			$error = $stmt->execute();
			$result = $stmt->fetchAll();
			echo json_encode($result);
			if (count($result) == 1) {
				echo "right";
			}
			else {
				echo "<script>document.getElementById('wrong').style.display='block'</script>";
			}
			//echo $result[0]["school_name"];
			//echo json_encode($_POST);
		}
		if(isset($_POST['btnsubmit'])) {
			signIn();
		}
	?>
</body>
</html>