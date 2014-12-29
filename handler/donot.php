<?	


		require_once "../include/LoginConfig.php" ;
		require_once "../include/mysql.php";
	 
		 
			
		$mysql = new Mysql;
		$mysql -> connect();

		 
		$sql = "insert into ym_completedate(c_year, c_month) values(".date("Y").",".date("n").")";

		//echo "<script>alert('".$sql."'); </script>";
		$result = $mysql -> insert($sql) ;

		/*if($result)
 			echo "<script>alert('".$sql."'); </script>";
			else
 			echo "<script>alert('修改状态错误'); </script>";*/
		exit;
	
?>