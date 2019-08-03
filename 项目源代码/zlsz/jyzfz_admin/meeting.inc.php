<?php
include( "../includes/init.php" );
include( '../includes/page.php' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>会议室信息管理</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
	<link rel="stylesheet" type="text/css" href="css/style.css"/>


</head>

<body>
	<div id="wrap">
		<div class="tab">
			<ul>
				<li><a href="javascript:void(0);" >添加会议</a>
				</li>
				<li><a href="menu.add.php" class="on">会议信息修改</a>
				</li>
			</ul>
		</div>
		<div class="main">
			<fieldset>
				<legend>操作提示</legend>
				1：排序只能是数字； 2：用户名称不能留空。<span id="er"></span>
			</fieldset>
			<table cellspacing="0" class="datalist" id="list" width="98%">
				<tr>
					<th width="8%">ID</th>
					<th width="8%">会议名称</th>
					<th width="8%"> 开始时间 </th>
					<th width="8%"> 结束时间</th>
					
					<th width="5%">参加会议的人数</th>
					<th width="8%">组织者用户名</th>
					<th width="5%">会议类型</th>
					<th width="10%">操作</th>
				</tr>
				<?php
				$sql = "select * from hy_meeting";
				$res = $Db->query( $sql );
				$count = $Db->rows( $res );
				Page( $count, 4, "meeting.inc.php" );
				$arr = $Db->get_all( "meeting", "", "*", "id desc", $limit_first );
				foreach ( $arr as $row ) {
					?>
				<tr onMouseOver="this.style.backgroundColor='#79D3FF'" onMouseOut="this.style.backgroundColor='#fff'">
					<td align="center">
						<?php echo $row['id']?>
					</td>
					<td align="center">
						<?php echo $row['name']?>
					</td>
					<td align="center">
						<?php echo $row['stime']?>
					</td>
					<td align="center">
						<?php echo $row['ftime']?>
					</td>
					
					<td align="center">
						<?php echo $row['num']?>
					</td>
					<td align="center">
						<?php echo $row['username']?>
					</td>
					<td align="center">
						<?php 
						if($row['state']=='private'){
							echo "私密";
						}else if($row['state']=='protected'){
							echo "需审核";
						}else{
							echo "公开";
						}
						?>
					</td>
	
					<td align="center">
						<a onclick="return confirm('确定删除?')" href="meeting_check.php?id=<?php echo $row['id']?>&amp;action=del">删除</a> &nbsp;&nbsp;
						<!-- <a onclick="return confirm('确定删除?')" href="menu_check.php?id=<?php echo $row['id']?>&action=del">删除</a> &nbsp;&nbsp; -->
						<a href="meeting.edit.php?id=<?php echo $row['id']?>" title="修改" class="thickbox">修改</a> &nbsp;</td>
				</tr>
				<?php
				}
				?>
				<tr>
					<td colspan="7" align="center">
						<?php echo $pagenav?>
					</td>
				</tr>
			</table>
		</div>
	</div>
</body>

</html>