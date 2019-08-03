<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>会议管理管理</title>
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
				<li><a href="conroom.inc.php"  class="on">会议信息</a>
				</li>
				<li><a href="jfshop.add.php">添加会议</a>
				</li>
			</ul>
		</div>
		<div class="main">
			<fieldset>
				<legend>操作提示</legend>
				1：会议名称最长不超过50字符,汉字占3字符
			</fieldset>
			<form class="demoform" action="meeting_check.php" method="post" name="myform" enctype="multipart/form-data">
				<table cellspacing="0" class="sub">
					<tr>
						<td width="100" align="right">会议室名称：</td>
						<td><input name="officename" type="text" id="officename" value="" size="20"/>
						</td>
						<td></td>
					</tr>
					<tr>
						<td width="100" align="right">会议开始时间：</td>
						<td>
							<input name="stime" type="text" id="d241" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" class="Wdate" style="width:150px"/>
						</td>
						<td></td>
               	 	</tr>
                 	<tr>
						<td width="100" align="right">会议结束时间：</td>
						<td>
							<input name="ftime" type="text" id="d241" onfocus="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" class="Wdate" style="width:150px"/>
						</td>
						<td></td>
                	</tr>
					<tr>
						<td width="100" align="right">会议名称：</td>
						<td><input type="text" name="name" id="name" size="20"/>
						</td>
						<td></td>
					</tr>
					<tr>
						<td width="100" align="right">会议人数：</td>
						<td><input type="text" name="num" id="num" size="20"/>
						</td>
						<td></td>
					</tr>
					<tr>
						<td width="100" align="right">组织者的用户名：</td>
						<td><input type="text" name="peo_name" id="inf" size="20"/>
						</td>
						<td></td>
					</tr>
					<tr>
						<td width="100" align="right">会议类型：</td>
						<td>
					  	<select name="state">
						  <option selected="selected">--请选择--</option>
						  <option value="private" >私密</option>
						  <option value="protected">需审核</option>
						  <option value="public">公开</option>
						</select>
						</td>
						<td></td>
						<td></td>
					</tr>
					<tr class="bg2">
						<td></td>
						<td><input type="submit" class="button" value="添加会议"/>
							<input type="reset" class="button" value="取消返回"/>
							<input type="hidden" name="action" value="add"/>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
	
</body>
<script src="js/ajax_jfshop.add.js"></script>
</html>