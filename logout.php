<!DOCTYPE html>
<html>
<head>
	<title>log out</title>
</head>
<body>
	<?php
      session_start();
      unset($_SESSION["account"]);
      session_destroy();
      
      //header("location: index.php");
	?>
	<form id="myform" action="index.php" method="post">
		<input type="hidden" name="logout" value="logout">
	</form>
	<script type="text/javascript">
		document.getElementById("myform").submit();
	</script>
</body>
</html>