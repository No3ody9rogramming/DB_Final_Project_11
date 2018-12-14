<?php 
	require_once "dbconnect.php";
	function getschool($db) {		
		$cityselect = $_POST['city'];
		$query = ("SELECT DISTINCT school_name FROM school WHERE city='".$cityselect."' ORDER BY school_name;");

		$stmt = $db->prepare($query);
		$error = $stmt->execute();
		$result = $stmt->fetchAll();

		$res = "";//把準備回傳的變數res準備好

		$count=0;

		foreach ($result as $rows) {
			$name[$count] = $rows['school_name'];
			$count++;
			echo "<option >".$rows['school_name']."</option>";//將對應的型號項目遞迴列出
		}
	}

	function getdepart($db) {		
		$schoolselect = $_POST['school_name'];
		$query = ("SELECT DISTINCT department FROM school WHERE school_name='".$schoolselect."'  ORDER BY department;");

		$stmt = $db->prepare($query);
		$error = $stmt->execute();
		$result = $stmt->fetchAll();

		$res = "";//把準備回傳的變數res準備好

		$count=0;

		foreach ($result as $rows) {
			$name[$count] = $rows['department'];
			$count++;
			echo "<option>".$rows['department']."</option>";//將對應的型號項目遞迴列出
		}
	}

	if(strcmp($_POST['cmd'], "1") == 0) {
		getschool($db);
	}
	else {
		getdepart($db);
	}
?>