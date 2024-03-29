<!DOCTYPE html>
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
$name=$_SESSION['name'];
$arr=$Db->get_all("meeting","state!='finish' and username!='$name'");
$message=$Db->get_all( "message","user='$name' and state='false'");
$meeting=$Db->get_all("meeting_peo","username='$name'");
?>
<html>

	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<title>智控会议室</title>
		<meta charset="utf-8">
		<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
		<link rel="stylesheet" href="assets/css/ready.css">
		<link rel="stylesheet" href="assets/css/demo.css">
		<script src="js/jquery.3.2.1.min.js"></script>
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
				$("[id=signup]").click(function(){
				 if(confirm('确定要报名吗')==true){
					id=$(this).next().val();
					$.ajax({
						type: "POST",
						url: "php/signup.php",
						data: {"id": id},
						success: function (data) {
							alert("报名成功，请按时参加会议");
							
							$(location).attr('href', 'meeting.php');
						}
					});
					 

					}else{

					   return false;

					}
				

			 });
			})
			
		</script>
	</head>

	<body>

		<div class="wrapper">
			<div class="main-header">
				<div class="logo-header">
					<a href="index.php" class="logo">
						可参加会议列表
					</a>
					<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
					<button class="topbar-toggler more"><i class="la la-search search-icon"></i></button>
				</div>
				<nav class="navbar navbar-header navbar-expand-lg">
					<div class="container-fluid">

						<form class="navbar-left navbar-form nav-search mr-md-3" action="">
							<div class="input-group">
								<input type="text" placeholder="Search ..." class="form-control">
								<div class="input-group-append">
									<span class="input-group-text">
									<i class="la la-search search-icon"></i>
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
						<li class="nav-item" <?php if($_SESSION['job']=='员工'){echo "hidden";}?>>
							<a href="office.php">
								<i class="la la-table"></i>
								<p>查看空闲会议室</p>
							</a>
						</li>
							<li class="nav-item active">
							<a href="meeting_all.php">
								<i class="la la-dashboard"></i>
								<p>可参加会议列表</p>
							
							</a>
						</li>
						<li class="nav-item ">
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
															<div class="numbers col-12">
																<center><h5><?php echo $arr[$i]['name']?></h5></center>
																<div style="float:left;margin-left: 20px;margin-top: 10px;">
																	<p>会议开始时间:<?php echo $arr[$i]['stime']?></p>
																	<p>会议结束时间:<?php echo $arr[$i]['ftime']?> </p>
																	<p>会议地点 :<?php echo $arr[$i]['add']?></p>
																	<p>备注信息 :<?php echo $arr[$i]['inf']?></p>
																	<center><button id="signup" class="btn btn-success" data-loading-text="Loading..." type="button"> 报名参加
																	  </button>
																	  <input value="<?php echo $arr[$i]['id']?>" hidden="">
																	  </center>

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

		</div>
		</div>
 
	</body>
<script src="assets/js/core/jquery.3.2.1.min.js"></script>
	<script src="assets/js/core/bootstrap.min.js"></script>
	<script src="assets/js/ready.min.js"></script>
	<script src="assets/js/demo.js"></script>

</html>