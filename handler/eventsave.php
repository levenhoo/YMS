<?	

		require_once "../include/LoginConfig.php" ;
		require_once "../include/mysql.php";

	 	

		$eventtype = $_POST["eventtype"];

		$dataid = $_POST["dataid"];

		$staffname = $_POST["staffname"]  ;

		$eventmemo =  $_POST["eventmemo"] ;

		$eventdate = $_POST["eventdate"] ; 





		  switch ($eventtype)

        {

            case "书面嘉奖":

                $eventnumber = "0.01";

                break;

            case "记小功":

                $eventnumber = "0.05";

                break;

            case "记大功":

                $eventnumber = "0.1";

                break;

            case "书面警告":

                $eventnumber = "-0.01";

                break;

            case "记小过":

                $eventnumber = "-0.05";

                break;

            case "记大过":

                $eventnumber = "-0.1";

                break;

            case "晋薪":

            case "晋职":

            case "降职":

            case "解雇":

                $eventnumber = "0";

                break;

            default :

                $eventnumber = "0";

                break;

        }





		$column[]="staffname='".$staffname."'";

		$column[]="eventtype='".$eventtype."'";

		$column[]="eventnumber='".$eventnumber."'";

		$column[]="eventmemo='".$eventmemo."'";

		$column[]="eventdate='".$eventdate."'"; 

		$column[]="createtime='".date("Y-m-d")."'"; 

		$column[]="staffid=".$dataid.""; 

			

		



		if( !empty ( $dataid ) ) {  



			$mysql = new Mysql;

			$mysql -> connect();

			$sql = "insert into ym_event set ".implode(",", $column)." ";

			$result = $mysql -> update($sql);





			if( $result ){

					echo "<script>alert('success'); </script>";

					echo "<script>location.href='../staffevent.php'</script>" ;

					exit;

			}





		} 

		

 		echo "<script>alert('保存错误'); </script>";

	 exit;

	

?>