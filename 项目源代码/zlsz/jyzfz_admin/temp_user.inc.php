<?php
include( "../includes/init.php" );
include( '../includes/page.php' );
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<title>角色管理</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7"/>
	<link rel="stylesheet" type="text/css" href="css/style.css"/>
	<script src="../assets/js/core/jquery.3.2.1.min.js"></script>

</head>

<body>
<div id="outerdiv" style="position:fixed;top:0;left:0;background:rgba(0,0,0,0.7);z-index:2;width:100%;height:100%;display:none;">
    <div id="innerdiv" style="position:absolute;">
        <img id="bigimg" style="border:5px solid #fff;width: 300px;margin-left: 500px;margin-top: 200px" src="" />
    </div>
</div> 
	<div id="wrap">
		<div class="tab">
			<ul>
				<li><a href="user.inc.php" class="on" style="z-index: 0">查看注册信息</a>
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
					<th width="5%">ID</th>
					<th width="5%"> 员工用户名 </th>
					<th width="5%"> 注册时间 </th>
					<th width="5%">身份</th>
					<th width="5%">姓名</th>
					<th width="10%">照片</th>
					<th width="10%">操作</th>
				</tr>
				<?php
				$sql = "select * from hy_register";
				$res = $Db->query( $sql );
				$count = $Db->rows( $res );
				Page( $count, 6, "temp_user.inc.php" );
				$arr = $Db->get_all( "register", "", "*", "id desc", $limit_first );
				$temp = 0;
				foreach ( $arr as $row ) {
					$temp++;
					?>
				<tr onMouseOver="this.style.backgroundColor='#79D3FF'" onMouseOut="this.style.backgroundColor='#fff'">
					<td align="center">
						<?php echo $temp?>
					</td>
					<td align="center">
						<?php echo $row['username']?>
					</td>
					<td align="center">
						<?php echo $row['datetime']?>
					</td>
					<td align="center">
						<?php echo $row['job']?>
					</td>	
					<td align="center">
						<?php echo $row['name']?>
					</td>
					
					<td align="center">
						<a id="showpic" style="float: left;margin-left: 50px">查看图片</a> &nbsp;
						 <img hidden height="100" width="100" src="<?php 
						$p=str_replace("\\","/",$row['pic']);
						echo "../".$p?>" />
						
						<a style="float: right;margin-right: 50px" onClick="pan()">审核图片</a>
						
					</td>
				
					<td align="center">
						<a onclick="return confirm('确认已审核无误?')" href="temp_user_check.php?id=<?php echo $row['id']?>&amp;action=yes">通过</a> &nbsp;&nbsp;
						<!-- <a onclick="return confirm('确定删除?')" href="admin_check.php?id=<?php echo $row['id']?>&action=del">删除</a> &nbsp;&nbsp; -->
						<a href="temp_user.edit.php?id=<?php echo $row['id']?>" title="修改密码" class="thickbox">修改</a> &nbsp;
						<a onclick="return confirm('确认不通过?')" href="temp_user_check.php?id=<?php echo $row['id']?>&amp;action=no">不通过</a>
						</td>
						
				</tr>
				<?php
				}
				?>
				<tr>
					<td colspan="6" align="center">
						<?php echo $pagenav?>
					</td>
				</tr>
			</table>
		</div>
	</div>
</body>
<script>
	function pan(){
	
		$(function(){
			$return=<?php
//						$dir=dirname(__FILE__);
//						$dir=str_replace("/","\\\\",$dir);
//						$dir=str_replace("\\","\\\\",$dir);
//						$pname=$row['pic'];
//						
//						$dir2=dirname(dirname(__FILE__));
//						$dir2=str_replace("/","\\",$dir2);
//						$pic=$dir."\\\\"."$pname";
//						//echo $dir2;
//						$sum=shell_exec($dir2.'\python\hello.py '.$pic);
						$pname=$row['pic'];
						$pic="\\xampp\\htdocs\\zlsz\\"."$pname";
						$sum=shell_exec('\xampp\htdocs\zlsz\python\hello.py '.$pic);
						echo $sum;
					?>;
		
			if($return==1){
				alert("符合照片规范，含有人脸")
			}else{
				alert("照片中不含有人脸，或者照片格式不符合规范");
			}	
		})
		
	}
	
 $(function(){  
        $("#showpic").click(function(){  
			
            var _this = $(this);//将当前的pimg元素作为_this传入函数  
            imgShow("#outerdiv", "#innerdiv", "#bigimg", _this);  
        });  
    });  

    function imgShow(outerdiv, innerdiv, bigimg, _this){  
        var src = _this.next().attr("src")//获取当前点击的pimg元素中的src属性  
			$("#bigimg").attr("src", src);//设置#bigimg元素的src属性  
           
			$(outerdiv).fadeIn("fast");
            /*获取当前点击图片的真实大小，并显示弹出层及大图*/  
          
        $(outerdiv).click(function(){//再次点击淡出消失弹出层  
            $(this).fadeOut("fast");  
        });  
    }  
</script>
</html>