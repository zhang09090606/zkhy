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
				<li><a href="admin.inc.php">管理员管理</a>
				</li>
				<li><a href="admin.add.php" class="on">添加管理员</a>
				</li>
				<li><a href="admin.edit.inc.php">修改密码</a>
				</li>
			</ul>
		</div>
		<div class="main">
			<fieldset>
				<legend>操作提示</legend>
				1：角色名称不能为空；
			</fieldset>
			<form action="admin_check.php" method="post" name="myform" class="demoform">
				<table cellspacing="0" class="sub">
					<tr>
						<td width="100" align="right">管理员账号：</td>
						<td><input type="text" name="username" value="" size="20"/>
						</td>
						<td></td>
					</tr>
					<tr>
						<td width="100" align="right">新密码：</td>
						<td><input type="password" name="pwd" id="password" size="20"/>
						</td>
						<td></td>
					</tr>
					<tr>
						<td width="100" align="right">确认密码：</td>
						<td><input type="password" name="repwd" id="password_t" size="20"/>
						</td>
						<td></td>
					</tr>
					<tr>
						<td width="100" align="right">权限：</td>
						<td id="list">
						
							<input id="checkall" type="checkbox" name="check[]" value="1"/>管理员管理<br>
							<input id="checkall" type="checkbox" name="check[]" value="2"/>新增用户管理
							<input id="checkall" type="checkbox" name="check[]" value="3"/>查看用户信息
							<input id="checkall" type="checkbox" name="check[]" value="4"/>删除/修改用户信息<br>
							<input id="checkall" type="checkbox" name="check[]" value="5"/>添加/修改会议室信息
							<input id="checkall" type="checkbox" name="check[]" value="22"/>添加/修改会议室
							<input id="checkall" type="checkbox" name="check[]" value="6"/>删除/修改规则信息<br>
							<input id="checkall" type="checkbox" name="check[]" value="13"/>审核用户注册信息
							<input id="checkall" type="checkbox" name="check[]" value="14"/>发送系统消息
							<input id="checkall" type="checkbox" name="check[]" value="15"/>删除/修改用户消息<br>
							<input id="checkall" type="checkbox" name="check[]" value="16"/>添加/修改系统消息
							<br>
					
							<input id="all" type="button" value="全选"/>
							<input id="other" type="button" value="反选"/>
						</td>
					</tr>
					<tr class="bg2">
						<td></td>
						<td><input type="submit" class="button" value="添加管理"/>
							<input type="reset" class="button" value="取消返回"/>
							<input type="hidden" name="action" value="add"/>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>

</body>
<script src="../admin/js/ajax_admin.add.js"></script>

</html>