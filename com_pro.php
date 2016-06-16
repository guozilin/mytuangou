<?php
include("config.php");
include("function.php");
checklogin();
$com_gys="";
$com_scs="";
$com_intro="";
$com_id= empty($_GET['edit'])?( empty($_POST['edit'])? "" : $_POST['edit'] ):($_GET['edit']);//多了一个get方式的判断，仅供练习之用 
$delid= empty($_GET['del'])?"":$_GET['del'];

 if(empty($delid)&&empty($com_id)){// add
 	$com_gys=$_POST['com_gys'];
	if(checkIfSame($com_gys,'com_gys','tb_com')>0)
		$type_alert = 15;
	else{
     $com_scs=$_POST['com_scs'];
     $com_intro=$_POST['com_intro'];
     $sql="insert into tb_com (com_gys,com_scs,com_intro) values ('$com_gys','$com_scs','$com_intro')";
	 mysql_query($sql);
	  $type_alert = 7;
	}
	 echo "<script language=JavaScript com=text/javascript>\n alert('".tip_list(1,1,$type_alert)."');\n self.location = 'com_index.php';\n </script>\n";
	 //echo header("location:com_index.php");
}
if(!empty($com_id)&&empty($delid)){  //modify
	 $com_gys=$_POST['com_gys'];
     $com_scs=$_POST['com_scs'];
     $com_intro=$_POST['com_intro'];
     $sql="update `tb_com` set `com_gys`='$com_gys',`com_scs`='$com_scs',`com_intro`='$com_intro' where com_id='$com_id'";
	 mysql_query($sql);
	 echo "<script language=JavaScript com=text/javascript>\n alert('".tip_list(1,1,8)."');\n self.location = 'com_index.php';\n </script>\n"; 
}

if(!empty($delid)&&empty($com_id)){ // del
    $sql="select sp_gys from tb_shangpin where sp_gys='$delid'";
	$query = mysql_query($sql);
	if(mysql_num_rows($query))
		$type_alert = 9;
	else{
		 $sql="delete from tb_com where com_id='$delid'";
	     mysql_query($sql);
		 $type_alert = 10;
	}
	echo "<script language=JavaScript type=text/javascript>\n alert('".tip_list(1,1,$type_alert)."');\n self.location = 'com_index.php';\n </script>\n"; 
}
?>