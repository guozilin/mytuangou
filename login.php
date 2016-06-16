<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>login analysis</title>
</head>
<body>
<?php
include("config.php");
include("function.php");

if(!empty($_POST['sub'])){
	$name=$_POST['name'];
	$psd=$_POST['password'];
	$gip=$_POST['gip'];
	if(empty($name)||empty($psd)||empty($gip)){
		echo "<script language=JavaScript com=text/javascript>\n alert('".tip_list(1,1,19)."');\n self.location = 'denglu.html';\n </script>\n";
		exit;
	}
	else{
		$sql = "select adm_name,adm_password from tb_user where adm_name='$name' and adm_password='$psd' limit 1";    
		$query = mysql_query($sql);  
		$rows= mysql_num_rows($query); 	
		if ($rows>0){  
			session_start();
			$_SESSION['name'] = $name;
			if(checkIP($gip)){
				$_SESSION['legalIP'] = $gip;
				echo header("location:type_index.php");
			}
			else
				echo "<script language=JavaScript com=text/javascript>\n alert('".tip_list(1,1,18)."');\n self.location = 'denglu.html';\n </script>\n";
		}
		else
			echo "<script language=JavaScript com=text/javascript>\n alert('".tip_list(1,1,19)."');\n self.location = 'denglu.html';\n </script>\n";
	}
}
	
if($_GET['action'] == "logout"){
    session_start();
    session_unset('name');
	session_unset('legalIP');
    session_destroy();
	mysql_close();
    echo "<script language=JavaScript com=text/javascript>\n alert('".tip_list(1,1,20)."');\n self.location = 'denglu.html';\n </script>\n";
}

?>

</body>
</html>