<?php
include( '../includes/init.php' );
$id = $_GET[ 'id' ];
$row = $Db->get_one( "meeting", "id=$id" );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>会议管理</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	<link rel="stylesheet" href="css/zzstyle.css">
	<script src="js/jquery-1.9.1.min.js"></script>
	<script src="js/Validform_v5.3.2.js"></script>
	<script  src="My97DatePicker/WdatePicker.js"></script>
</head>

<body>
	<div id="wrap">
		<div class="tab">
			<ul>
				<li><a href="menu.inc.php">会议添加</a>
				</li>
				<li><a href="javascript:;" class="on">会议信息管理</a>
				</li>
			</ul>
		</div>
		<div class="main">
			<fieldset>
				<legend>操作提示</legend>
				1：菜单名称不能为空；
			</fieldset>
			<form class="demoform" action="meeting_check.php" method="post" name="myform" enctype="multipart/form-data">
				<table cellspacing="0" class="sub">
					<tr>
						<td width="100" align="right">会议室名称：</td>
						<td><input name="officename" type="text" id="officename" value="<?php echo $row['officename']?>" size="20"/>
						</td>
						<td></td>
					</tr>
					<tr>
						<td width="100" align="right">会议开始时间：</td>
						<td>
							<input name="stime" type="text" id="d241" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" class="Wdate" value="<?php echo $row['stime']?>" style="width:150px"/>
						</td>
						<td></td>
               	 	</tr>
                 	<tr>
						<td width="100" align="right">会议结束时间：</td>
						<td>
							<input name="ftime" type="text" id="d241" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" class="Wdate" value="<?php echo $row['ftime']?>" style="width:150px"/>
						</td>
						<td></td>
                	</tr>
					<tr>
						<td width="100" align="right">会议名称：</td>
						<td><input type="text" name="name" id="name" size="20" value="<?php echo $row['name']?>"/>
						</td>
						<td></td>
					</tr>
					<tr>
						<td width="100" align="right">会议人数：</td>
						<td><input type="text" name="num" id="num" size="20" value="<?php echo $row['num']?>"/>
						</td>
						<td></td>
					</tr>
					<tr>
						<td width="100" align="right">组织者用户名：</td>
						<td><input type="text" name="username" id="usename" size="20" value="<?php echo $row['username']?>"/>
						</td>
						<td></td>
					</tr>
					<tr>
						<td width="100" align="right">会议类型：</td>
						<td>
					  	<select name="state">
						  <option value="private" <?php if($row['state']=='private'){echo "selected";}?>>私密</option>
						  <option value="protected" <?php if($row['state']=='protected'){echo "selected";}?>>需审核</option>
						  <option value="public" <?php if($row['state']=='public'){echo "selected";}?>>公开</option>
						</select>
					
					<tr class="bg2">
						<td></td>
						<td><input type="submit" class="button" value="修改管理"/>
							<input type="reset" class="button" value="取消返回"/>
							<input type="hidden" name="action" value="edit"/>
							<input type="hidden" name="gid" value="<?php echo $row['id']?>"/>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
	
</body>
<script src="js/ajax_jfshop.edit.js"></script>
</html>