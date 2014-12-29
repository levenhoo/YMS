<?
require_once "../include/LoginConfig.php" ;
	require_once "../include/mysql.php";



	 $dataid = trim($_REQUEST["dataid"]);

	 //
	//exit;

	if( !empty($dataid) )	{ 
		$mysql = new Mysql;
		$mysql -> connect();
		$sql = "delete from ym_remind where id = $dataid "; 
		$mysql -> update($sql); 
	/*	echo "<script>alert('delete data success'); </script>";*/
		echo "<script>location.href='../remind.php'</script>" ; 
		exit;
	}	 
 
?>