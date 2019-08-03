<?php

session_start();
$arr = $_SESSION[ 'grade' ];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>左侧菜单</title>
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
	<link rel="stylesheet" type="text/css" href="css/left.css"/>
	<script language="javascript" type="text/javascript" src="js/left.js"></script>
	<script src="js/jquery-1.4.2.min.js"></script>
</head>

<body oncontextmenu="return false" ondragstart="return false" onSelectStart="return false">
	<div class="left_box">
		<?php
		if ( empty( $_GET[ 'menu' ] ) ) {
			?>
		<div class="left_box_kk">
			<div class="left_box_tit" onClick='showHide("items1_1")'>常用操作</div>
			<div class="left_box_nr" style='display:block' id='items1_1'>
				<ul>
					<li><a href="config.inc.php?tab=1" target='main'>网站配置</a>
					</li>
					<li> <a id="c8" href="conroom.inc.php" target='main'>查看审核信息</a>
					</li>
					<li> <a id="c22" href="conroom.inc.php" target="main">会议室信息管理</a>
					</li>
					
					<li> <a id="c17" href="#" target='main'>数据库备份</a>
					</li>
					<li> <a id="c8" href="conroom.inc.php" target='main'>消息管理</a>
					</li>
				
				</ul>
			</div>
		</div>

		<div class="left_box_kk">
			<div class="left_box_tit" onClick='showHide("items2_1")'>管理资料</div>
			<div class="left_box_nr" style='display:block' id='items2_1'>
				<ul>
					<li> <a href="admin.edit.inc.php" target='main'>修改密码</a>
					</li>
					<li> <a href="javascript:void(0);" onClick="self.top.location.href='logout.php'">安全注销</a>
					</li>
				</ul>
			</div>
		</div>
		<?php
		} elseif ( $_GET[ 'menu' ] == 'admin' ) {
				?>
		<div class="left_box_kk">
			<div class="left_box_tit" onClick='showHide("items3_1")'>管理员</div>
			<div class="left_box_nr" style='display:block' id='items3_1'>
				<ul>
					<li> <a id="1" href="admin.add.php" target='main'>添加管理员</a>
					</li>
					<li> <a id="a1" href="admin.inc.php" target='main'>查看管理员</a>
					</li>
					<li> <a id="a2" href="admin.edit.inc.php" target='main'>修改密码</a>
					</li>
					<li> <a id="a3" href="admin.login.php" target='main'>查看登录日志</a>
					</li>
				</ul>
			</div>
		</div>
		<?php
		} elseif ( $_GET[ 'menu' ] == 'user' ) {
				?>
		<div class="left_box_kk">
			<div class="left_box_tit" onClick='showHide("items4_1")'>用户信息管理</div>
			<div class="left_box_nr" style='display:block' id='items4_1'>
				<ul>
					<li> <a id="2" href="user.add.php" target='main'>新增用户</a>
					</li>
					<li> <a id="3" href="user.inc.php" target="main">用户信息管理</a>
					</li>
				</ul>
			</div>
		</div>
		<?php
		} elseif ( $_GET[ 'menu' ] == 'address' ) {
				?>
		<div class="left_box_kk">
			<div class="left_box_tit" onClick='showHide("items4_1")'>会议室管理</div>
			<div class="left_box_nr" style='display:block' id='items4_1'>
				<ul>
					<li> <a id="10" href="conroom.add.php" target='main'>添加会议室</a>
					</li>
					<li> <a id="11" href="conroom.inc.php" target="main">会议室信息管理</a>
					</li>
				</ul>
			</div>
		</div>
		<?php
		} elseif ( $_GET[ 'menu' ] == 'jyinf' ) {
				?>
		<div class="left_box_kk">
			<div class="left_box_tit" onClick='showHide("items4_1")'>会议信息管理</div>
			<div class="left_box_nr" style='display:block' id='items4_1'>
				<ul>
					<li> <a id="13" href="meeting.add.php" target='main'>添加会议信息</a>
					</li>
					<li> <a id="14" href="meeting.inc.php" target="main">修改会议信息</a>
					</li>
				</ul>
			</div>
		</div>
		<?php
		} elseif ( $_GET[ 'menu' ] == 'jfshop' ) {
				?>
		<div class="left_box_kk">
			<div class="left_box_tit" onClick='showHide("items4_1")'>消息管理</div>
			<div class="left_box_nr" style='display:block' id='items4_1'>
				<ul>
					<li> <a id="7" href="news.add.php" target='main'>发送系统消息</a>
					</li>
					<li> <a id="8" href="news.inc.php" target='main'>用户消息管理</a>
					</li>
				</ul>
			</div>
		</div>
		<?php
		} elseif ( $_GET[ 'menu' ] == 'class' ) {
				?>
		<div class="left_box_kk">
			<div class="left_box_tit" onClick='showHide("items4_1")'>未处理注册信息管理</div>
			<div class="left_box_nr" style='display:block' id='items4_1'>
				<ul>
					<li> <a id="23" href="temp_user.inc.php" target='main'>查看注册信息</a>
					</li>
				</ul>
			</div>
		</div>
		
		<?php
		}
		?>
	</div>

</body>
<script src="js/ajax_index.left.js"></script>

</html>