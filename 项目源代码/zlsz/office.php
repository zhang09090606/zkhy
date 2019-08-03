
<?php
include( "includes/init.php" );
if (!isset($_SESSION['name'])){ 
		header("Location: login.html"); 
}
$time=date('Y-m-d h:i:s', time());
$officelist=$Db->get_all("meeting","ftime<'$time'");
for($i=0;$i<sizeof($officelist);$i++){
	$id=$officelist[$i]['id'];
	$data = array(
		'state' =>"finish"
	);
		$Db->updatedata( "meeting", $data, "id='$id'" );
}
$officelist=$Db->get_all("meeting","ftime>'$time' and stime<'$time'");
for($i=0;$i<sizeof($officelist);$i++){
	$id=$officelist[$i]['id'];
	$data = array(
		'state' =>"running"
	);
		$Db->updatedata( "meeting", $data, "id='$id'" );
}
$arr=[];
$ftime="";
$stime="";
if(isset($_GET['stime'])){
	$ftime=$_GET['ftime'];
	$stime=$_GET['stime'];
	$stime=strtr($stime,'T',' ');
	$ftime=strtr($ftime,'T',' ');
	$arr=$Db->get_all("conroom","isfree='true'");
	$arr0=$Db->get_all("conroom","isfree='false'");
	for($i=0;$i<sizeof($arr0);$i++){
		$officid=$arr0[$i]["id"];
		$arr1=$Db->get_all("meeting","state!='finish' and officeid='$officid' and ((stime < '$stime' and ftime > '$stime') or (stime < '$ftime' and ftime > '$ftime') or (ftime <'$ftime' and stime >'$stime'))");
	
		if(sizeof($arr1)>0){
		
		}else{
			
			$sum=$Db->get_all("conroom","id=$officid");

			$arr=array_merge($arr,$sum);
		}

	}
}
$name=$_SESSION['name'];
$message=$Db->get_all( "message","user='$name' and state='false'");
$meeting=$Db->get_all("meeting_peo","username='$name'");

	//=$Db->get_all("conroom","$where")
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<title>空闲会议室列表</title>
		<meta charset="utf-8">
		<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
		<link rel="stylesheet" href="assets/css/ready.css">
		<link rel="stylesheet" href="assets/css/demo.css">
		<link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">
		<script src="assets/js/core/jquery.3.2.1.min.js"></script>
		<script src="assets/js/core/bootstrap.min.js"></script>
		<script src="assets/js/ready.js"></script>
		<script src="assets/js/demo.js"></script>
		<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
		<script>
			$(function(){
				$("[id=logout]").click(function(){
					$.ajax({
						type: "POST",
						url: "php/logout.php",
						
						success: function (data) {
							alert("注销成功");
							$(location).attr('href', 'login.html');
						}
					});
				})
			})
		</script>
		<script>
			
			$(function(){
				var arr;
	
				var id,mname;
				if(1==
					<?php
						if(isset($_GET['stime'])){
							echo 0;
						}else{
							echo 1;
						}
					?>){
					$("#fat-btn").click();
				}
				
				$("#check").click(function(){
					stime=$("#stime").val();
					
					var arr=stime.split("T");
					var arr1=stime.split("-");
					var arr11=arr1[2].split("T");
					var arr2=arr[1].split(":");
					time=$(".join-money").val();
			
					arr2[0]=parseInt(arr2[0])+parseInt(time);
			
					if(parseInt(arr2[0])>=24){
						arr1[2]=parseInt(arr1[2])+1;
						arr2[0]=parseInt(arr2[0])-24;
					}
				
					ftime=arr1[0]+"-"+arr1[1]+"-"+arr11[0]+"T"+arr2[0]+":"+arr2[1]+":"+arr2[2];
					
					 window.location.href="office.php?stime="+stime+"&ftime="+ftime;

				});
				$(".add").click(function() {
					t=$(".join-money").val();

					t=parseInt(t)+1;
					if(t>100){
						t=100;
					}
					updateMoney();  
				});
				$(".min").click(function(){
					t=$(".join-money").val();
					t=parseInt(t)-1;
					if(t<1){
						t=1;
					}
					updateMoney();  //显示总金额
				});
				$(".join-money").keyup(function(){
					var c=$(this);
					if(/[^\d]/.test(c.val())){//替换非数字字符
						var amount=c.val().replace(/[^\d]/g,'');
						$(this).val(amount);
					}
					updateMoney();  //手动输入数值金额随之改变
				});
				
				$("[id=useoffice]").click(function(){
					 id=$(this).next().val();

				});
				 $("[id=use]").click(function(){
					 var mname=$("#mname").val();
					 var mnum=$("#mnum").val();
					 var mtype=$("#mtype").val();
					 var mcon=$("#mcon").val();
			
					 $.ajax({
						type: "POST",
						url: "php/useoffice.php",
						data: {"id": id,"mname":mname,"mnum":mnum,"mcon":mcon,"mtype":mtype,"stime":"<?php echo $stime?>","ftime":"<?php echo $ftime?>"},
						success: function (data) {
							alert("创建会议成功");
			
							$(location).attr('href', 'meeting.php');
						}
					 });
				
				 });
			});
			function search(){
				
					$("#fat-btn").click();
				
			}
			var t = 0;
			var m = 1;
			function updateMoney(){
					
				var tt = t;
				
				var total =  m*tt;   //输入框中的份额数与每份金额数相乘得到总金额
				t=$(".join-money").val(t);
			}

		</script>
			
	</head>

	<body>
 			<button id="fat-btn" class="btn btn-success" data-loading-text="Loading..."type="button"  data-toggle="modal" data-target="#myModal" hidden></button>
		<div class="wrapper">
			<div class="main-header">
				<div class="logo-header">
					<a href="index.php" class="logo">
						查看空闲会议室
					</a>
					<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
					<button class="topbar-toggler more" onClick="search()"><i class="la la-search search-icon"></i></button>
				</div>
				<nav class="navbar navbar-header navbar-expand-lg">
					<div class="container-fluid">

						<form class="navbar-left navbar-form nav-search mr-md-3" action="">
							<div class="input-group">
								<input type="text" placeholder="Search ..." class="form-control">
								<div class="input-group-append">
									<span class="input-group-text">
									<i  class="la la-search search-icon"></i>
								</span>
								</div>
							</div>
						</form>
						<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
							
							
							<li class="nav-item dropdown">
								<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"> <img src="assets/img/profile.jpg" alt="user-img" width="36" class="img-circle"><span><?php echo $_SESSION['zname']?></span></span>
								</a>
								<ul class="dropdown-menu dropdown-user">
									<li>
										<div class="user-box">
											<div class="u-img"><img src="assets/img/profile.jpg" alt="user"></div>
											<div class="u-text">
												<h4><?php echo $_SESSION['name']?></h4>
												<p class="text-muted">913473646@qq.com</p>
											
											</div>
										</div>
									</li>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="#"><i class="ti-user"></i>我的个人信息</a>

									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="#"><i class="ti-settings"></i> 设置</a>
									<div class="dropdown-divider"></div>
									<div id="logout" class="dropdown-item"><i  class="fa fa-power-off"></i> 注销</div>
								</ul>
								<!-- /.dropdown-user -->
							</li>
						</ul>
					</div>
				</nav>
			</div>
			<div class="sidebar">
				<div class="scrollbar-inner sidebar-wrapper">
					<div class="user">
						<div class="photo">
							<img src="assets/img/profile.jpg">
						</div>
						<div class="info">
							<a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									<?php echo $_SESSION['zname']?>
									<span class="user-level"><?php echo $_SESSION['job']?></span>
								<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample" aria-expanded="true" style="">
								<ul class="nav">
										<a href="#settings">
											<span class="link-collapse">设置</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav">
						<li class="nav-item">
							<a href="index.php">
								<i class="la la-table"></i>
								<p>首页</p>
							</a>
						</li>
						<li class="nav-item active" <?php if($_SESSION['job']=='员工'){echo "hidden";}?>>
							<a href="office.php">
								<i class="la la-table"></i>
								<p>查看空闲会议室</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="meeting_all.php">
								<i class="la la-dashboard"></i>
								<p>可参加会议列表</p>
						
							</a>
						</li>
						<li class="nav-item">
							<a href="meeting.php">
								<i class="la la-dashboard"></i>
								<p>待参加会议</p>
								<span class="badge badge-success" <?php if(sizeof($meeting)==0){echo "hidden";}?>><?php echo sizeof($meeting)?></span>
							</a>
						</li>
						<li class="nav-item">
							<a href="history.php">
								<i class="la la-keyboard-o"></i>
								<p>历史会议</p>

							</a>
						</li>
					
						<li class="nav-item">
							<a href="message_w.php">
								<i class="la la-bell"></i>
								<p>未读消息</p>
								<span class="badge badge-danger" <?php if(sizeof($message)==0){echo "hidden";}?>><?php echo sizeof($message)?></span>
				
							</a>
						</li>
						<li class="nav-item">
							<a href="message_y.php">
								<i class="la la-th-list"></i>
								<p>已读消息</p>

							</a>
						</li>
						<li class="nav-item">
							<a href="userinf.php">
								<i class="la la-user"></i>
								<p>个人信息修改</p>
							</a>
						</li>
						<li id="logout" class="nav-item update-pro">
							<button data-toggle="modal" data-target="#modalUpdate">
								<i class="la la-hand-pointer-o"></i>
								<p>退出登录</p>
							</button>
						</li>
					</ul>
				</div>
			</div>
			<div class="main-panel">
				<div class="content">
					<div class="container-fluid">
						<?php
							for($i=0;$i<sizeof($arr);$i++){	
						?>
						<div class="col-md-12">
							<div class="card card-stats">
								<div class="card-body ">
									<div class="row">

										<div class="col-12 d-flex align-items-center">
											<div class="numbers text-center">
												<img class="img-responsive" width="100%" style="max-width: 300px; float: left;" src="<?php echo $arr[$i]['pic'];?>">
												<div style="float:left;margin-left: 80px;margin-top: 10px;">
													
													<p>会议室名称:<?php echo $arr[$i]['name'];?></p>
													<p>会议室地点:<?php echo $arr[$i]['add'];?> </p>
													<p> 可容纳人数:<?php echo $arr[$i]['con'];?>人</p>
													<p> 备注信息:<?php echo $arr[$i]['inf'];?></p>
													
								      				<input id="useoffice" class="btn btn-success" data-loading-text="Loading..." type="button" style="margin-left: 0px"  data-toggle="modal" data-target="#myModal2" value="启用会议室	">
								      				<input value="<?php echo $arr[$i]['id'];?>" hidden/>
												   
												</div>
											</div>

										</div>
									</div>
								</div>
							</div>
						</div>
						<?php 
							}
						?>

					</div>

				</div>
			</div>
		</div>
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						
						<h6 class="modal-title" id="myModalLabel">
							请输入信息
						</h6>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							&times;
						</button>
					</div>
					<div class="modal-body">
						<!--form表单位置-->
						
				<div class="row">
					<div class='col-sm-6'>
						<div class="form-group">
							<label>选择日期：</label>
							<!--指定 date标记-->	
							<div class='input-group date' id='datetimepicker1'>
								<input  id="stime" type="datetime-local" 
									value="<?php
										$time=date('Y-m-d h:i:s', time());
										$time=strtr($time,' ','T');
										echo $time;
									?>"/>
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
					</div>
					<div class='col-sm-6'>
						<div class="form-group">
							<label>选择会议持续时间：</label>
							<!--指定 date标记-->
							<div class='input-group date' id='datetimepicker2'>
								<input class="addBtn min" type="button" value="-" />
								<input class="join-money" type="text" value="1" size="10">
								<input class="addBtn add" type="button" value="+" />
								<span class="total" style="margin-left: 10px;margin-top: 5px">小时</span>
							</div>
						</div>
					</div>
				</div>
				<input name="pid" id="ppid" value="1" hidden="">
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10" align="center">
									<button id="check" type="submit" class="btn btn-default">查询</button>
								</div>
							</div>
						

					</div>
				</div>
		</div>
		</div>
		
		<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						
						<h6 class="modal-title" id="myModalLabel">
							请输入信息
						</h6>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							&times;
						</button>
					</div>
					<div class="modal-body">
						<!--form表单位置-->
						
				<div class="row">
					<div class='col-sm-8'>
						<div class="form-group">
							<label>选择会议名称：</label>
							<!--指定 date标记-->	
							<div class='input-group date' id='datetimepicker1'>
								<input  id="mname" type="text/css" value=""/>
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
					</div>
				
					<div class='col-sm-8'>
						<div class="form-group">
							<label>会议人数：</label>
							<!--指定 date标记-->	
							<div class='input-group date' id='datetimepicker1'>
								<input  id="mnum" type="text/css" value=""/>
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
					</div>
					<div class='col-sm-8'>
						<div class="form-group">
							<label>会议要求：</label>
							<!--指定 date标记-->	
							<div class='input-group date' id='datetimepicker1'>
								<input  id="mcon" type="text/css" value=""/>
								<span class="input-group-addon">
									<span class="glyphicon glyphicon-calendar"></span>
								</span>
							</div>
						</div>
					</div>
					<div class='col-sm-6'>
						<div class="form-group">
							<label>选择会议类型：</label>
							<!--指定 date标记-->	
							<select class="form-control input-fixed" id="mtype">
								<option value="public">公开</option>
								<option value="protect">自行报名无需审核</option>
								<option value="private">自行报名需审核</option>
							</select>

							</div>
					</div>
					
				</div>
				<input name="pid" id="ppid" value="1" hidden="">
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10" align="center">
									<button id="use" type="submit" class="btn btn-default">确定预约</button>
								</div>
							</div>
						

					</div>
				</div>
		</div>
		</div>
 
	</body>


</html>