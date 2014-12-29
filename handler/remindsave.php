<?	

	require_once "../include/LoginConfig.php" ;
	require_once "../include/mysql.php";

	 

		$title = $_POST["title"];

		$dataid = $_POST["dataid"];

		$memo = $_POST["memo"]  ;

		$finishdate =  $_POST["finishdate"] ;

		$status = $_POST["status"] ; 



		$column[]="title='".$title."'";

		$column[]="memo='".$memo."'";

		$column[]="finishdate='".$finishdate."'"; 

		$column[]="status=".$status.""; 

			

		$mysql = new Mysql;

		$mysql -> connect();



		if( empty ( $dataid ) ) {   

			$sql = "insert into ym_remind set ".implode(",", $column)." ";

		}

		else

		{ 

			 $sql = "update ym_remind set ".implode(",", $column)." where id =$dataid "; 

		}



		//echo $sql;

		$result = $mysql -> update($sql);





		if( $result ){

				echo "<script>alert('success'); </script>";

				echo "<script>location.href='../remind.php'</script>" ;

				exit;

		}else

		{

				echo "<script>alert('保存错误'); </script>"; 

				exit;

		}

 

	 exit;

	

?>