<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
	<meta name="description" content="">
	<meta name="author" content="">
	<title>yaokun tpl</title>
	<!-- Bootstrap core CSS -->
	<link href="http://cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
	<br><br>
	
	<div class="container-fluid">

		<div class="row">
			<div class="col-xs-6 col-sm-4"></div>
			<div class="col-xs-6 col-sm-4">

				
				<div class="form-group">
					<label>Title</label>
					<input type='input' class="form-control" id="text-title" placeholder="Title">
				</div>
				<div class="form-group">
					<label>Nav1</label>
					<input class="form-control" id="text-nav1">
				</div>
				<div class="form-group">
					<label>Nav2</label>
					<input class="form-control" id="text-nav2">
				</div>
				<div class="form-group">
					<label>Nav3</label>
					<input class="form-control" id="text-nav3">
				</div>
				<div class="form-group">
					<label>Center</label>
					<input class="form-control" id="text-center">
				</div>
				<div class="form-group">
					<label>Intro</label>
					<input class="form-control" id="text-intro">
				</div>

				<button class="btn btn-default" id='submit'>Submit</button>
				

			</div>
			<div class="col-xs-6 col-sm-4"></div>
		</div>
	</div>


	<script src="http://cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

<script type="text/javascript">
	$(document).ready(function(){
		console.log(pagedata);
		$("#text-title").val(pagedata.title);
		$("#text-nav1").val(pagedata.nav1);
		$("#text-nav2").val(pagedata.nav2);
		$("#text-nav3").val(pagedata.nav3);
		$("#text-center").val(pagedata.center);
		$("#text-intro").val(pagedata.intro);
		$("#submit").click(function(){
			var title = $("#text-title").val();
			var nav1 = $("#text-nav1").val();
			var nav2 = $("#text-nav2").val();
			var nav3 = $("#text-nav3").val();
			var center = $("#text-center").val();
			var intro = $("#text-intro").val();
			$.post("http://syaokun219.top/babehouse/textcode/admin/setting",
			{
				title: title,
				nav1: nav1,
				nav2: nav2,
				nav3: nav3,
				center: center,
				intro: intro,
			},
			function(data,status){
				var json_data = JSON.parse(data);
				console.log(json_data);
				if(json_data.errno == 0) {
					alert("设置成功");
				} else {
					alert("设置失败，请重试");
				}

			});
		});
	});
</script>

</html>