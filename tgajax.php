<?php
include ("config.php"); 
include ("function.php");
if($_GET["atype"]==1)
	insertIp($_GET["ip"],$_GET["spid"]);
	
if( $_GET['atype']==2){
	$strs=$_GET['strs'];
	$len=$_GET['len'];
	$sqll="select id from tb_viewcount where id in ($strs) ";
	$query=mysql_query($sqll);
	$count=mysql_num_rows($query);
	if($len==$count){
		$sql="delete from tb_viewcount where id in ($strs) ";
		mysql_query($sql);
		$countrow=mysql_affected_rows();
		echo "<xml><num><n>".$countrow."</n></num></xml>";
	}
		//printf(mysql_affected_rows());
	mysql_close();
}
if($_GET['atype']==3){
	$num=$_GET['value'];
	if(!empty($num)){
		$sql="select com_id,com_scs from tb_com where com_id = $num";
		$query=mysql_query($sql);
		$row=mysql_fetch_array($query);
		echo $row['com_scs'];
	}else
	echo "暂未选择供应商";
}
if( $_GET['atype']==4){
	$num=$_GET['value'];
	$sql="select cat_id,cat_name,parent_id from tb_area where parent_id = $num";
	$query=mysql_query($sql);
	echo "<option value='-1'>请选择城市</option>";
	while($row=mysql_fetch_array($query)){
		 $cat_id=$row['cat_id'];
		 $cat_name=$row['cat_name'];
	  echo "<option value=". $cat_id.">".$cat_name."</option>";
	  }
 }
if( $_GET['atype']==5){
	$num=$_GET['value'];
	$sql="select cat_id,cat_name,parent_id from tb_area where parent_id = $num";
	$query=mysql_query($sql);
	echo "<option value='-1'>请选择县区</option>";
	while($row=mysql_fetch_array($query)){
		 $cat_id=$row['cat_id'];
		 $cat_name=$row['cat_name'];
	echo "<option value=". $cat_id.">".$cat_name."</option>";
	  }
 }
if($_GET['atype']==6){
	$id=$_GET['id'];
	$country=$_GET['country'];
	$sql1="select cat_id,parent_id,cat_name from tb_area where cat_name like '%".$country."%' ";
	$query1 = mysql_query($sql1);  
	$rows= mysql_num_rows($query1); 
	if ($rows>0){  	
		$id=$_GET['id'];
		$province=$_GET['province'];
		$city=$_GET['city'];
		$sql="select cat_id,cat_name from tb_area where cat_name like '%".$province."%' and `parent_id`=0 ";
		$query=mysql_query($sql);
		$row=mysql_fetch_array($query);
		$cat_id= $row['cat_id'];
		$parent_id= $row['parent_id'];
		//echo $id,$cat_id,$city,$parent_id;
		$sq="update `tb_viewcount` set `ip_province`=$cat_id where `id` = $id";
		mysql_query($sq);
		$sql2="select cat_id,cat_name from tb_area where cat_name like '%".$city."%' and `parent_id`<>0 ";
		$query2=mysql_query($sql2);
		$row2=mysql_fetch_array($query2);
		$cat_id2= $row2['cat_id'];
		//echo $id,$cat_id,$city,$parent_id;
		$sq="update `tb_viewcount` set `ip_city`=$cat_id2 where `id` = $id";
		mysql_query($sq);

	}
	else{
		$sql="update `tb_viewcount` set `ip_province`=9999 where `id` = $id";
		mysql_query($sql);
	}
}
if( $_GET['atype']==7){
	$num=$_GET['value'];
    $sql ="select cat_id,cat_name,parent_id from art where parent_id='$num'";  
    $query = mysql_query($sql);  
	    $str .="<ul>";
    while ($row=mysql_fetch_array($query)) {
        $str .=  "<li value='".$row['cat_id']."'>".$row['cat_id'] . "-".$num ."-" . $row['cat_name']."</li>";  
        } 
	  $str .="</ul>";
	echo $str;  

 }
?>
