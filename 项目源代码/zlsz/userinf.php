<!DOCTYPE html>
<?php
include( "includes/init.php" );
$name = $_SESSION[ 'name' ];
$message=$Db->get_all( "message","user='$name' and state='false'");
$meeting=$Db->get_all("meeting_peo","username='$name'");
?>
<html>

	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<title>个人信息修改</title>
		<meta charset="utf-8">
		<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
		<link rel="stylesheet" href="assets/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
		<link rel="stylesheet" href="assets/css/ready.css">
		<link rel="stylesheet" href="assets/css/demo.css">
		<link rel="stylesheet" href="assets/css/fileinput.min.css" />
		<script src="assets/js/core/jquery.3.2.1.min.js"></script>
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
				$("[id=sumbit]").click(function(){
					alert("提交修改成功，请耐心等待管理员审核")
				})
			})
			
		</script>
	</head>

	<body>

		<div class="wrapper">
			<div class="main-header">
				<div class="logo-header">
					<a href="index.php" class="logo">
						智能会议室
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
						<li class="nav-item" <?php if($_SESSION['job']=='员工'){echo "hidden";}?>	> 
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
						<li class="nav-item active">
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

						<div class="col-md-12">
							<div class="card card-stats">
								<div class="card-body ">
									<div class="row">

										<form role="form" action="" enctype="multipart/form-data" method="post" >
													<div class="form-group">
														<label for="card">密码:</label>
														<input  type="password" class="form-control " name="ccard" id="ccard" value="111111" placeholder="请输入您要修改的密码">
														
													</div>
													
													<div class="form-group" hidden>
														<label for="card">确认密码:</label>
														<input type="text" class="form-control " name="ccard" id="ccard" placeholder="请输入您要注册的车牌号码">
													</div>
													<div class="form-group">
														<label for="card">真实姓名:</label>
														<input  type="text" class="form-control " name="ccard" id="ccard" value="<?php echo $_SESSION['zname']?>" placeholder="请输入您要修改的密码">
														
													</div>
													<div class="form-group">
														<label for="card">真实头像修改:</label>
														<input style="width: 50px;" name="pic" type="file" id="uploadFile" data-show-preview="false" data-allowed-file-extensions='["jpg","png"]' />
													</div>

													</br>
													<center><button type="button" id="sumbit"  class="btn btn-success">提交</button></center>
										</form>
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

	<script src="assets/js/core/bootstrap.min.js"></script>
	<script src="assets/js/ready.min.js"></script>
	<script src="assets/js/demo.js"></script>
<script src="assets/js/fileinput.min.js"></script>
<script src="assets/js/zh.js"></script>
<script>
    initFileInput();
    function initFileInput() {
        $("#uploadFile").fileinput({
            language: 'zh'
        })
    }
</script>
</html>