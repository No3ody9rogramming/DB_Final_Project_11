$("#city").change(function() {
	var city = "";
	var cmd = "1";
	console.log(document.getElementById("school_name").selectedIndex);
	$( "#city option:selected" ).each(function() {
		city = $( this ).text();
		console.log(document.getElementsByName("school_name"));
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
});

//$("#city").change();

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
			document.getElementById("department").innerHTML = res;
		}
	})//end ajax;
});

function setSchoolName(city, school, department) {
	$.ajax({
		url:"deal.php",
		type:"POST",
		data:{
			city:city,
			cmd:"1"
		},
		success:function(res){//處理回吐的資料
			document.getElementById("school_name").innerHTML = res;
			document.getElementById("school_name").value = school;
			setDepartment(school, department);
		}
	})//end ajax;
}

function setDepartment(school, department) {
	$.ajax({
		url:"deal.php",
		type:"POST",
		data:{
			school_name:school,
			cmd:"0"
		},
		success:function(res){//處理回吐的資料
			document.getElementById("department").innerHTML = res;
			document.getElementById("department").value = department;
		}
	})//end ajax;
}