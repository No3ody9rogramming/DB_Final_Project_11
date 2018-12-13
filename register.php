<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Bookhub Register</title>
	<link rel="stylesheet" type="text/css" href="css/register.css">
</head>
<body>
	<?php
		//require_once "dbconnect.php";
		//include_once "dbconnect.php";
	?>
	<script type="text/javascript">
		/*
		var account_ID = document.getElementById("account_ID");
		var password = document.getElementById('password');
		var user_name = document.getElementById('user_name');
		var phoneNum = document.getElementById('phoneNum');
		var city = document.getElementById('city');
		var school_name = document.getElementById('school_name');
		var department = document.getElementById('department');
		var isWrong;

		function validLength(str, checkID) {//str, Which checkID to show
			if(str.length < 6 || str.length > 12){
				document.getElementById(checkID).style.color='red';
				isWrong = 1;
			}
			else{
				<?php

				?>
			}
		}
		
		account_ID.onblur = validLength(account_ID.value, "acountCheck");
		password.onblur = validLength(password.value, "passwordCheck");*/
	</script>
	<div>
		註冊帳號
	</div>
	<form action = "" method = "post" id="inputForm">
		<p>帳號: <input type = "text" name = "account_ID" id = "account_ID" autofocus=""><span id="acountCheck"> 帳號介於6到12個字元</span><span id="acountCheck2" class="wrongMessage"> 此帳號已存在</span></p>
		<p>密碼: <input type = "password" name = "password" id = "password"><span id="passwordCheck"> 密碼介於6到12個字元</span></p>
		<p>再次輸入密碼: <input type = "password" name = "password2" id = "password2"><span id="passwordCheck2" class="wrongMessage"> 與第一次密碼不相符</span></p>
		<p>使用者名稱: <input type = "text" name = "user_name" id="user_name" placeholder="蘇浪子"></p>		
		<p>手機: <input type = "text" name = "phoneNum"><span id="phoneNumCheck"> 長度為10, e.g. 0912345678</span></p>
		<p>學校城市: <input type = "text" name = "city"></p>
		<p>學校: <input type = "text" name = "school_name"></p>
		<p>系所: <input type = "text" name = department></p>
		<input type = "submit" name = "btnsubmit" value = "送出">
	</form>
	<?php
	//舊的輸入錯，重新輸入，舊的變對的，新的錯，舊的會不會提示錯誤?
		function register() {
			require_once "dbconnect.php";
			//include_once "dbconnect.php";
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
				echo "<script>document.getElementById('acountCheck').style.color='red';</script>";
				$isWrong = 1;
			}
			else {//判斷是否已存在帳號				
				$id = $account_ID;
				$query = ("SELECT account_ID FROM users WHERE account_ID=?");
				$stmt = $db->prepare($query);
				$error = $stmt->execute(array($id));
				$result = $stmt->fetchALl();
				if(count($result) > 0){
					echo "<script>document.getElementById('acountCheck2').style.display='block';</script>";
					echo "<script>document.getElementById('acountCheck2').style.color='red';</script>";
					$isWrong = 1;
				}
			}
			//echo "<script>console.log(".strcmp($_POST['password'], $_POST['password2']).");</script>";
			if($passwordLength < 6 || $passwordLength > 12){
				echo "<script>document.getElementById('passwordCheck').style.color='red';</script>";
				$isWrong = 1;
			}
			else if(strcmp($_POST['password'], $_POST['password2']) != 0) {
				echo "<script>document.getElementById('passwordCheck2').style.display='block';</script>";
				echo "<script>document.getElementById('passwordCheck2').style.color='red';</script>";
				$isWrong = 1;
			}
			if(!(is_numeric($phoneNum) && strlen($phoneNum) == 10)){
				echo "<script>document.getElementById('phoneNumCheck').style.color='red';</script>";
				$isWrong = 1;
			}
			if($isWrong == 0){//新增使用者
				$query = ("INSERT INTO users VALUES(?,?,?,?,?,?,?)");
				$stmt = $db->prepare($query);
				$result = $stmt->execute(array($account_ID, $password, $user_name, $phoneNum, $school_name, $city, $department));
				$db = null;
				echo "<script>document.getElementsByTagName('body')[0].innerHTML = '註冊成功!三秒後到登入頁面。';</script>";
				header("Refresh:3; url=index.php");//自動轉址
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
			register();
		}
	?>
</body>
</html>