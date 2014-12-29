<?	

require_once "../include/LoginConfig.php" ;
	require_once "../include/mysql.php";
 



	$bjArray = $_REQUEST["bj"];

	$sjArray = $_REQUEST["sj"];

	$cdArray = $_REQUEST["cd"];

	$kgArray = $_REQUEST["kg"];

	$dataidArray = $_REQUEST["dataid"];

	$year = trim($_REQUEST["year"]);

	$month = trim($_REQUEST["month"]);





	$staffCount = count($dataidArray); //staff count



	if( empty($year) || empty($month) )

	{

		echo "<script>alert('需要填写年份和月份'); </script>";

		exit;

	}



	if($staffCount == 0){

		echo "<script>alert('没有检测到员工'); </script>";

		exit;	

	}

	 

	

	$hasDataRow = 0 ; $successRow = 0 ; $failRow = 0 ; 

	$trans = true;



	$mysql = new Mysql;

	$mysql -> connect();

	$mysql -> del("delete from ym_monthdata where dy = $year and dm = $month"); //clear data

	$mysql -> select("BEGIN");

	for ($i=0; $i < $staffCount ; $i++) { 

		# code... 

		$dataid = $dataidArray[$i];

		$sj = trim($sjArray[$i]);

		$cd = trim($cdArray[$i]);

		$kg = trim($kgArray[$i]);

		$bj = trim($bjArray[$i]);



		if( !empty($sj) || !empty($cd) || !empty($kg) || !empty($bj)  ){



			$hasDataRow++;		//有数据的行



			$sj = $sj == "" ? 0 : $sj; 

			$cd = $cd == "" ? 0 : $cd;

			$kg = $kg == "" ? 0 : $kg;

			$bj = $bj == "" ? 0 : $bj;

			

			$sql = "insert into ym_monthdata(sj,bj,cd,kg,staffid,dy,dm) value($sj,$bj,$cd,$kg,$dataid,$year,$month)";

			$result = $mysql -> insert($sql);

			//echo$sql;

			if($result) {

			    $successRow++; 

			}

			else { 

				$failRow++; 

				$trans=false;

				break; }

		}

	}



	 

	if($trans){

		$mysql -> select("COMMIT");  

		echo "<script>alert('成功加入了".$successRow."条数据!'); window.location = 'monthdata.php';</script>";

		exit;	

	}else{

		$mysql -> select("ROLLBACK");

		 echo "<script>alert('合共数据：".$staffCount."条,错误出现在第".($i+1)."条,请检查后再输入!'); </script>"; 

		 exit;	

	} 

  

?>