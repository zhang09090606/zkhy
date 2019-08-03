<?php
include( "../includes/init.php" );
include( '../includes/PHPExcel-1.8/Classes/PHPExcel.php' );
	$id=$_GET['id'];
	$arr0=$Db->get_one("meeting","id=$id");
	$arr=$Db->get_all("meeting_peo","meetingid=$id");
	
    // 实例化excel类
    $objPHPExcel = new PHPExcel();
    // 操作第一个工作表
    $objPHPExcel->setActiveSheetIndex(0);
    // 设置sheet名
    $objPHPExcel->getActiveSheet()->setTitle('xx列表');
 
    // 设置表格宽度
    $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
    $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
    $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
    $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(50);

 
 
    // 列名表头文字加粗
    $objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getFont()->setBold(true);
    // 列表头文字居中
    $objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getAlignment()
        ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
 
    // 列名赋值
    $objPHPExcel->getActiveSheet()->setCellValue('A1', '编号');
    $objPHPExcel->getActiveSheet()->setCellValue('B1', '员工姓名');
    $objPHPExcel->getActiveSheet()->setCellValue('C1', '是否参加');
    $objPHPExcel->getActiveSheet()->setCellValue('D1', '参加时间');
	for($i=2;$i<sizeof($arr)+2;$i++){
		$name=$arr[$i-2]['username'];
		$isjoin=$arr[$i-2]['isjoin'];
		$time=$arr[$i-2]['time'];
		$num=$i-1;
		$objPHPExcel->getActiveSheet()->setCellValue("A".$i, "$num");
		$objPHPExcel->getActiveSheet()->setCellValue('B'.$i, "$name");
		$objPHPExcel->getActiveSheet()->setCellValue('C'.$i, "$isjoin");
		$objPHPExcel->getActiveSheet()->setCellValue('D2'.$i, "$time");

	}

 
  
 
    $outputFileName = 'teacher_' . time() . '.xls';
    $xlsWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
 	ob_end_clean();
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");
    header('Content-Disposition:inline;filename="' . $outputFileName . '"');
    header("Content-Transfer-Encoding: binary");
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Pragma: no-cache");
    $xlsWriter->save("php://output");
print_r($arr);


?>