<?php 
	require_once "../include/LoginConfig.php" ;
	require_once "../include/mysql.php";
	require_once "../include/function.php" ;


 $include_file = '../include/PHPExcel/PHPExcel.php';
  if(file_exists( $include_file)) {
    require_once( $include_file );
    print_r('ok');
  } else {
    print_r('PHPExcel not installed.', 'error');
    return;
  }

  exit;
	$company = trim($_REQUEST["company"]);
  $status = trim($_REQUEST["status"]) == "" ? "1" : trim($_REQUEST["status"]) ;
  $turnon = trim($_REQUEST["turnon"]);
  $sataffname = trim($_REQUEST["sataffname"]);
  $where = " 1=1 ";
    
    if( !empty( $company ) )
        $where .= " and company = '".$company."' ";
    if( $status != "all" )
        $where .= " and status = ".$status." ";
    if( $turnon != "" )
        $where .= " and testpass = ".$turnon." ";
    if( !empty( $sataffname ) )
        $where .= " and staffname like '%".$sataffname."%' ";

    $mysql = new Mysql;
    $mysql -> connect();     
    $sql = "select (select count(*) from ym_event where  ym_event.staffid = ym_staff.id ) totaleven , ym_staff.* from ym_staff  where $where  order by company asc , sequence desc , id desc ";
    $resultStaff = $mysql->select($sql); 

 
	$html .="<table border=\"1\">"; 
	$html .="<tr style=\"height:25px;\">";
	$html .="<td>公司</td>";
	$html .="<td>部门</td>";
	$html .="<td>职位</td>";
	$html .="<td>姓名</td>";
	$html .="<td>性别</td>";
	$html .="<td>电话</td>";
	$html .="<td>户口所在地</td>";
	$html .="<td>身份证号码</td>";
	$html .="<td>出生日期</td>";
	$html .="<td>籍贯</td>";
	$html .="<td>学历</td>";
	$html .="<td>毕业学院</td>";
	$html .="<td>用工形式</td>";
	$html .="<td>入职日期</td>";
	$html .="<td>年资</td>";
	$html .="<td>年假</td>";
	$html .="<td>劳动合同</td>";
	$html .="<td>工作证编号</td>";
	$html .="<td>状态</td>";
	$html .="<td>离职日期</td>";
	$html .="</tr>";

		for ($i = 0; $i < count($resultStaff); $i++)
		{

		$address = $resultStaff[$i]["address"];
		$birthplace = $resultStaff[$i]["birthplace"];
		$birthday = date("Y-m-d",strtotime($resultStaff[$i]["birthday"]));
		$contract = $resultStaff[$i]["contract"];
		$contractend = $resultStaff[$i]["contractend"];
		$memo = $resultStaff[$i]["memo"];
		$degree = $resultStaff[$i]["degree"];
		$idnumber = $resultStaff[$i]["idnumber"];
		$jobdate = $resultStaff[$i]["jobdate"];
		$jobtype = $resultStaff[$i]["jobtype"];
		$phone = $resultStaff[$i]["phone"];
		$school = $resultStaff[$i]["school"];
		$sex = $resultStaff[$i]["sex"];
		$staffno = $resultStaff[$i]["staffno"];
		$staffname = $resultStaff[$i]["staffname"];
		$department = $resultStaff[$i]["department"];
		$company = $resultStaff[$i]["company"];
		$testtime = $resultStaff[$i]["testtime"];
		$s_position = $resultStaff[$i]["s_position"];

		$status = $resultStaff[$i]["status"] == "1" ? "在职" : "离职";
		$leavedate = $resultStaff[$i]["leavedate"];
		$jd = JobYear($jobdate);//年资
		$jv = JobVacation($jobdate);//年假
 

		$html .="<tr>";
		$html .="<td>".$company."</td>";
		$html .="<td>".$department . "</td>";
		$html .="<td>".$s_position . "</td>";
		$html .="<td>".$staffname . "</td>";
		$html .="<td>".$sex . "</td>";
		$html .="<td>&nbsp;".$phone . "</td>";
		$html .="<td>".$address . "</td>";
		$html .="<td>&nbsp;" . $idnumber . "</td>";
		$html .="<td>&nbsp;" . $birthday . "</td>";
		$html .="<td>" .$birthplace . "</td>";
		$html .="<td>".$degree . "</td>";
		$html .="<td>" .$school . "</td>";
		$html .="<td>" .$jobtype . "</td>";
		$html .="<td>" .$jobdate . "</td>";
		$html .="<td>" .$jd . "年</td>";
		$html .="<td>" . $jv . "天</td>";
		$html .="<td>" .$contract . "--" . $contractend . "</td>";
		$html .="<td>" .$staffno . "</td>";
		$html .="<td>" .$status . "</td>";
		$html .="<td>" .$leavedate . "</td>";
		$html .="</tr>";

        }
    $html .="</table>";
             

    $objPHPExcel = new \PHPExcel();
    $worksheet = $objPHPExcel->getActiveSheet();
    $worksheet->fromArray( $this->arr_columns, NULL, 'A1' );
    $worksheet->fromArray( $this->arr_rows, NULL, 'A2' );
    $objWriter = new \PHPExcel_Writer_Excel2007($objPHPExcel);
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");
    header("Content-Transfer-Encoding: binary");
    header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Pragma: no-cache");
    $objWriter->save('php://output');    
		exit;
?>