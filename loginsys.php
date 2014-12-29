<?
    header( 'Content-type: text/html; charset=utf-8' );	
	header( 'Expires: Mon, 26 Jul 1997 05:00:00 GMT' );
    header( 'Last-Modified: ' . gmdate( 'D, d M Y H:i:s' ) . ' GMT' );
    header( 'Cache-Control: no-store, no-cache, must-revalidate' );
    header( 'Cache-Control: post-check=0, pre-check=0', false );
    header( 'Pragma: no-cache' );  
    /*include*/
    include_once 'include/mysql.php'; 

    $log = trim ( $_REQUEST["log"] );
    $pwd = trim ( $_REQUEST["pwd"] );
    $remember = empty($_REQUEST["check-field"])?"":$_REQUEST["check-field"]; 
    /*$lang = $_GET["language"];*/ 
    
    $sql = "select * from loginuser where loginpwd = '". md5($pwd) ."' and loginname = '".md5($log)."' ";
    $mysql = new Mysql;
    if( $mysql -> connect () )
    {
        $result = $mysql -> select($sql);
    }
    else{
        //print_r('Database connect fail!');
        echo '{"status":"fail","text":"Database connect fail!"}';
        exit;
    } 
  
  /*  print_r('result:');print_r($result);
    print_r('count:');print_r(count( $result ));
    print_r('is_array:');print_r(is_array ( $result ));*/

    if(   is_array ( $result ) and count( $result ) == 0 )
    {
        //echo '<script>alert("login in fail");location.href="login.html"</script>';
         echo '{"status":"fail","text":"用户名或者密码错误！"}';
        exit;
    }
    else
    {   
        $saveTime = 60 * 60 * 24 * 7 * 12 ;        
        if($remember){ 
            setcookie( "remember" , $log , strtotime("+1 week") );
        }else{
            setcookie( "remember" , "" , -strtotime("-1 week")  );
            unset( $_COOKIE["remember"] );
        } 
        session_start();
        $_SESSION["LOGIN_NAME"] = $log;			
        echo '{"status":"success","text":"检测通过！"}';
         //echo '<script>location.href="feedback.php"</script>'; 
        exit;
    }
  
	 
?>