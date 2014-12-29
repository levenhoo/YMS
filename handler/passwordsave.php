<?	

		require_once "../include/LoginConfig.php" ;
	require_once "../include/mysql.php";

	 	

		$curpwd = $_REQUEST["curpwd"]; 
		$newpwd = $_REQUEST["newpwd"]; 
		if( !empty($newpwd) )

		{

		/*$newpwd = md5($newpwd);

		$curpwd = md5($curpwd);

*/

		$sql = "update loginuser set loginpwd = '".md5($newpwd)."' where loginpwd = '".md5($curpwd)."' and loginname = '".md5($LOGIN_NAME)."' ";

		$mysql = new MYsql;
		$mysql -> connect(); 
		$result = $mysql -> update($sql); 
		}

		//echo $sql;

		if($result)

		echo "<script>alert('Change password success');location.href='password.php';</script>";

		else

		echo "<script>alert('Change password fail');</script>";    

		//echo "<script>location.href='password.php';</script>"; 



	 

		exit;

	

?>