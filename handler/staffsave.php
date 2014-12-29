<?	

require_once "../include/LoginConfig.php" ;
	require_once "../include/mysql.php";
	 
		$address = $_POST["address"];
		$birthplace = $_POST["birthplace"];
		$birthday = $_POST["birthday"]  ;
		$contract =  $_POST["contract"] ;
		$contractend = $_POST["contractend"] ; 
		$memo = $_POST["memo"];
		$degree = $_POST["degree"];
		$idnumber = $_POST["idnumber"];
		$jobdate = $_POST["jobdate"] ;
		$jobtype = $_POST["jobtype"];
		$phone = $_POST["phone"];
		$school = $_POST["school"];
		$sex = $_POST["sex"];
		$staffno = $_POST["staffno"];
		$staffname = $_POST["staffname"]; 

		$department = $_POST["department"];
		$company = $_POST["company"];
		$s_position = $_POST["position"];
		$status = $_POST["status"];

		$testtime = $_POST["testtime"] == "" ? 0 : $_POST["testtime"];
		$testpass = $_POST["testpass"] == "on" ? 1 : 0;
	
		$sequence = $_POST["sequence"] == "" ? 0 : $_POST["sequence"];

		$dataid = $_POST["dataid"];


		$leavedate =$_POST["leavedate"]; 


		$column[]="address='".$address."'";
		$column[]="birthplace='".$birthplace."'";
		$column[]="birthday='".$birthday."'";
		$column[]="contract='".$contract."'";
		$column[]="contractend='".$contractend."'";
		$column[]="memo='".$memo."'";
		$column[]="degree='".$degree."'";
		$column[]="idnumber='".$idnumber."'";
		$column[]="jobdate='".$jobdate."'";
		$column[]="jobtype='".$jobtype."'";
		$column[]="phone='".$phone."'";
		$column[]="school='".$school."'";
		$column[]="sex='".$sex."'";
		$column[]="staffno='".$staffno."'";
		$column[]="staffname='".$staffname."'";

		$column[]="department='".$department."'";
		$column[]="company='".$company."'";
		$column[]="s_position='".$s_position."'";

		$column[]="truejobdate='".date ("Y-m-d" , strtotime("$testtime month", strtotime($jobdate)  ) ) ."'";

	 	$column[]="status=".$status."";
		$column[]="leavedate='".$leavedate."'";
		$column[]="testtime=".$testtime."";
		$column[]="testpass=".$testpass."";
		$column[]="sequence=".$sequence."";
			
		$mysql = new Mysql;
		$mysql -> connect();

		if( empty ( $dataid ) ) { 

		

			$sql = "insert into ym_staff set ".implode(",", $column)." ";
		}
		else
		{
 			
			 $sql = "update ym_staff set   ".implode(",", $column)." where id =$dataid ";

		}


		$result = $mysql -> update($sql);


		if( $result ){
				echo "<script>alert('success'); </script>";
				echo "<script>location.href='../stafflist.php'</script>" ;
				exit;
		}

		
		 //header("location:../tables.php");
	  //echo $sql;
 	  //echo "<script>alert('保存错误'); </script>";
	 /*echo "<script>alert('客户电话格式错误,多个号码请以分号隔开！'); </script>";*/
	 		echo "<script>location.href='../stafflist.php'</script>" ;
	 exit;
	
?>