
<?php
include( "includes/init.php" );
$name=$_SESSION['name'];
if (!isset($_SESSION['name'])){ 
		header("Location: login.html"); 
}
$office=$Db->get_all("office","isfree='true'");
$message=$Db->get_all( "message","user='$name' and state='false'");
$meeting=$Db->get_all("meeting_peo","username='$name'");
$ip = $_SERVER["REMOTE_ADDR"];
$time = date("Y-m-d H:i", strtotime("-1 hour"));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<title>智创会议室</title>
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
	</head>

	<body>

		<div class="wrapper">
			<div class="main-header">
				<div class="logo-header">
					<a href="index.php" class="logo">
						首页
					</a>
					<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
					
				</div>
				<nav class="navbar navbar-header navbar-expand-lg">
					<div class="container-fluid">

					
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
					
					<ul class="nav ">
						<li class="nav-item active">
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
						<li class="nav-item update-pro" id="logout">
							<button data-toggle="modal" data-target="#modalUpdate" >
								<i class="la la-hand-pointer-o"></i>
								<p>退出登录</p>
							</button>
						</li>
					</ul>
				</div>
			</div>
				<div class="main-panel">
					<div class="content">
						<div class="row row-card-no-pd">
							<div class="col-md-4">
								<div class="card">
									<div class="card-body">
										
										<p class="fw-bold mt-1">待参加会议数量</p>
										<h4><b>1次</b></h4>
									</div>
									<div class="card-footer">
										<ul class="nav">
											
											<li class="nav-item ml-auto"><a class="btn btn-default btn-link" href="#"><i class="la la-refresh"></i> Refresh</a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-md-5">
								<div class="card">
									<div class="card-body">
										<div class="progress-card">
											<div class="d-flex justify-content-between mb-1">
												<span class="text-muted">当前空闲会议室数量</span>
												<span class="text-muted fw-bold">
												<?php echo sizeof($office)?> 
												间</span>
											</div>
											<div class="progress mb-2" style="height: 7px;">
												<div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" data-placement="top" title="78%"></div>
											</div>
										</div>
										
										<div class="progress-card">
											<div class="d-flex justify-content-between mb-1">
												<span class="text-muted">今日已参加会议</span>
												<span class="text-muted fw-bold">6 次</span>
											</div>
											<div class="progress mb-2" style="height: 7px;">
												<div class="progress-bar bg-primary" role="progressbar" style="width: 100%" aria-valuenow="56" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" data-placement="top" title="70%"></div>
											</div>
										</div>
										<div class="progress-card">
											<div class="d-flex justify-content-between mb-1">
												<span class="text-muted">未读消息</span>
												<span class="text-muted fw-bold"><?php echo sizeof($message)?>条</span>
											</div>
											<div class="progress mb-2" style="height: 7px;">
												<div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="44" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" data-placement="top" title="60%"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="card card-stats">
									<div class="card-body">
										<p class="fw-bold mt-1">上次登陆信息</p>
										
										<div class="row">

											<div class="col-6 d-flex align-items-center">
													<div class="numbers">
													<p class="card-category">登陆时间</p>
													<h4 class="card-title"><?php echo $time?></h4>
												</div>
												
											</div>
												<div class="col-6 d-flex align-items-center">
													<div class="numbers">
													<p class="card-category">登陆ip</p>
													<h4 class="card-title"><?php echo "111.43.18.227"?></h4>
												</div>
												
											</div>
										</div>
									</div>
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