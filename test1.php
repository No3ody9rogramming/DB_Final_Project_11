<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js">
</script>
<script type="text/javascript">
	$("#city").change(function() {
		var city = "";
		var cmd = "1";
		console.log(document.getElementById("school_name").selectedIndex);
		$( "#city option:selected" ).each(function() {
			city = $( this ).text();
		});
		console.log(city);
		$.ajax({
			url:"deal.php",
			type:"POST",
			data:{
				city:city,
				cmd:cmd
			},
			success:function(res){//處理回吐的資料
				document.getElementById("school_name").innerHTML = res;
				$("#school_name").change();
			}
		})//end ajax;
	}).trigger( "change" );

	$("#school_name").change(function() {
		var school_name = "";
		var cmd = "0";
		$( "#school_name option:selected" ).each(function() {
			school_name = $( this ).text();
		});
		console.log(school_name);
		$.ajax({
			url:"deal.php",
			type:"POST",
			data:{
				school_name:school_name,
				cmd:cmd
			},
			success:function(res){//處理回吐的資料
				console.log(res);
				document.getElementById("department").innerHTML = res;
			}
		})//end ajax;
	}).trigger( "change" );

</script>