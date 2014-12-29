<?
    session_start();
    unset( $_SESSION["LOGIN_NAME"] );
    unset( $_SESSION ) ;
    session_destroy();
    

    //echo '<script>location.href="/admin/login.html"</script>';
    header("Location:login.html"); 
?>