<?php
include("config.php");
include("function.php");
checklogin();

$tid= empty($_GET['edit'])?( empty($_POST['edit'])? "" : $_POST['edit'] ):($_GET['edit']); 
$delid= empty($_GET['del'])?"":$_GET['del'];

//以后添加和修改要检验前端值的合法性！

if(empty($delid)&&empty($tid)){// exe add
	$leibie=trim($_POST['leibie']);
	if(checkIfSame($leibie,'type_name','tb_type')>0)
		$type_alert = 14;
	else{
		 $t_num=intval($_POST['t_num']);
		 $sql4="insert into tb_type (type_name,t_num) values ('$leibie','$t_num')";
		 mysql_query($sql4);
		 $type_alert = 3;
	 }
	echo "<script language=JavaScript type=text/javascript>\n alert('".tip_list(1,1,$type_alert)."');\n self.location = 'type_index.php';\n </script>\n";
}

if(empty($delid)&&!empty($tid)){ // exe modify
     $leibie=$_POST['leibie'];
	 $t_num=intval($_POST['t_num']);
     $sql2="update tb_type set type_name='$leibie',t_num='$t_num' where tid='$tid'";
	 mysql_query($sql2);
	 echo "<script language=JavaScript type=text/javascript>\n alert('".tip_list(1,1,4)."');\n self.location = 'type_index.php';\n </script>\n"; 
}

if(!empty($delid)&&empty($tid)){ // exe del
    $sql="select sp_class from tb_shangpin where sp_class='$delid'";
	$query = mysql_query($sql);
	if(mysql_num_rows($query))
		$type_alert = 5;
	else{
		$sql="delete from tb_type where tid='$delid'";
		mysql_query($sql);
		$type_alert = 6;
	}
	echo "<script language=JavaScript type=text/javascript>\n alert('".tip_list(1,1,$type_alert)."');\n self.location = 'type_index.php';\n </script>\n"; 
}
?>