<?php
include("../includes/init.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>消息管理</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" href="kindeditor/themes/default/default.css" />
<script charset="utf-8" src="kindeditor/kindeditor.js"></script>
<script charset="utf-8" src="kindeditor/lang/zh_CN.js"></script>
<script language="javascript" type="text/javascript">			
			var editor;
			KindEditor.ready(function(K1) {
				editor = K1.create("textarea[name='content,description']", {
					allowFileManager : true,
					allowImageRemote:false, 
				});
			});
			KindEditor.ready(function(K) {
				var editor = K.editor({
					allowFileManager : true,
					
				});
				K('#image').click(function() {
					editor.loadPlugin('image', function() {
						editor.plugin.imageDialog({
							showRemote : false,
							imageUrl : K('#picurl').val(),
							clickFn : function(url, title, width, height, border, align) {
								K('#picurl').val(url);
								editor.hideDialog();
							}
						});
					});
				});
			});	


</script>
<script src="js/jquery-1.4.2.min.js"></script>
<script>
$(document).ready(function(e) {
    $('#duo').hide();
	$("#bt1,#bt2").click(function(){
		$('#author').attr("value",$(this).val());
	});
	$('#radio2').click(function(){
		
		$('#dan').hide();
		$('#duo').show();
		
	});
	$('#radio').click(function(){
		
		$('#dan').show();
		$('#duo').hide();
		
	});
	
});
</script>
</head>
<body>
<div id="wrap">
  <div class="tab">
    <ul>
      <li><a href="news.inc.php">发送系统消息</a></li>
      <li><a href="news.add.php" class="on">用户消息管理</a></li>     
    </ul>
  </div>
  <div class="main">
    <fieldset>
      <legend>操作提示</legend>
      1：主题不能为空；
    </fieldset>
    <form action="news_check.php" method="post" name="myform">     
      <table cellspacing="0" class="sub">
        
    
          <td width="100" align="right">消息主题：</td>
          <td><input type="text" name="title"  size="60"  />
            </td>
        </tr>
        <tr>
          <td width="100" align="right">消息内容：</td>
          <td><textarea name="content" style="width:750px;height:450px;display:none;" id="content"></textarea></td>
        </tr>
        <tr class="bg2">
          <td></td>
          <td>&nbsp;</td>
        </tr>
        <tr class="bg2">
          <td></td>
          <td><input type="submit" class="button"  value="确认发送" />
            <input type="reset" class="button" value="取消返回" />
            <input type="hidden" name="action" value="add" /></td>
        </tr>
      </table>
    </form>
  </div>
</div>
</body>
</html>