<?
		
 
	include_once('./core/mail.php');

	$mail = new Mail();
	$mymail = 'yama@imleven.com'; 
	
	//$mail -> getOAuth();

	//echo 'token:'.$mail -> TOKEN;


	echo 'NewMailCount:'.$mail -> getMailNewCount($mymail);
	//$mail -> getUserList($mymail);

?>