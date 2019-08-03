<?php
include( "../includes/init.php" );
$id = $_GET[ 'id' ];
$row = $Db->get_one( "user", "id=$id" );

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>角色管理</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	<link rel="stylesheet" href="css/zzstyle.css">
	<script src="js/jquery-1.9.1.min.js"></script>
	<script src="js/Validform_v5.3.2.js"></script>
</head>

<body>
	<div id="wrap">
		<div class="tab">
			<ul>
				<li><a href="user.inc.php" class="on">查看注册信息</a>
				</li>
				
			</ul>
		</div>
		<div class="main">
			<fieldset>
				<legend>操作提示</legend>
				1：角色名称不能为空；
			</fieldset>
			<form action="user_check.php" method="post" name="myform" class="demoform" enctype="multipart/form-data">
				<table cellspacing="0" class="sub">
					<tr>
						<td width="100" align="right">员工id：</td>
						<td><input type="text" name="uid" value="<?php echo $row['uid']?>" size="20"/>
							<td></td>
					</tr>
					<tr>
						<td width="100" align="right">用户名：</td>
						<td><input type="text" name="username" value="<?php echo $row['username']?>" size="20"/>
							<td></td>
					</tr>
					<tr>
						<td width="100" align="right">新密码：</td>
						<td><input type="password" name="pwd" id="password" value="<?php echo $row['pwd']?>" size="20"/>
							<td> </td>
					</tr>
					<tr>
						<td width="100" align="right">确认密码：</td>
						<td><input type="password" name="repwd" id="password_t" value="<?php echo $row['pwd']?>" size="20"/>
						</td>
						<td></td>
					</tr>
					<tr>
						<td width="100" align="right">职位</td>
						<td>
							<input type="radio" name="job" id="" value="员工" <?php if($row['job']=="员工" ){echo "checked";}?>>员工
							<input type="radio" name="job" id="" value="领导" <?php if($row['job']=="领导" ){echo "checked";}?>>领导
							<td></td>
						</td>
					</tr>
					<tr>
						<td width="100" align="right">名字：</td>
						<td><input type="text" name="name" id="name" size="20" value="<?php echo $row['name']?>"/>
							<td></td>
					</tr>
					<tr>
						<td width="100" align="right">物品图片：</td>
						<td width="100"> <input type="file" name="file" id="file" value="上传图片"/>
						</td>
						<td></td>
					</tr>
					
				 <tr class="bg2">
					<td></td>
					<td><input type="submit" class="button" value="提交">
						<input type="reset" class="button" value="取消返回"/>
						<input type="hidden" name="gid" value="<?php echo $id?>"/>
						<input type="hidden" name="action" value="edit"/>
						
					</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</body>
<script src="js/ajax_user.edit.js"></script>

</html>