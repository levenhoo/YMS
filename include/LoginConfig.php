<?php
	
	 session_start();
	 $LOGIN_NAME = $_SESSION["LOGIN_NAME"] ;
	 $LOGIN_TYPE = empty($_SESSION["LOGIN_TYPE"])?"":$_SESSION["LOGIN_TYPE"] ;
	 $LOGIN_ID =   empty($_SESSION["LOGIN_ID"])?"":$_SESSION["LOGIN_ID"] ;
	 error_reporting(E_ALL ^ E_NOTICE);
	 if( !isset( $LOGIN_NAME )  || empty( $LOGIN_NAME )  ){

	 		//echo '<script> alert("超出访问权限"); location = "login.html"; </script>';
	 	echo '<script> location = "login.html"; </script>';
	 }
?>