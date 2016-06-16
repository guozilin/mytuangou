<?php
include("config.php");
include("function.php");
checklogin();

$sp_id= empty($_GET['edit'])?( empty($_POST['edit'])? "" : $_POST['edit'] ):($_GET['edit']);
$delid= empty($_GET['del'])?"":$_GET['del'];

$sp_name=empty($_POST['sp_name'])?"":$_POST['sp_name'];
$sp_price=empty($_POST['sp_price'])?0:$_POST['sp_price'];
$sp_danwei=empty($_POST['sp_danwei'])?"":$_POST['sp_danwei'];
$sp_brand=empty($_POST['sp_brand'])?"":$_POST['sp_brand'];
$sp_gys=empty($_POST['sp_gys'])?"":$_POST['sp_gys'];
$sp_class=empty($_POST['sp_class'])?"":$_POST['sp_class'];
$sp_yn=empty($_POST['sp_yn'])?"":$_POST['sp_yn'];
$sp_photo_orginal=empty($_POST['sp_photo_orginal'])?"no.jpg":$_POST['sp_photo_orginal'];
$sp_miaoshu=empty($_POST['sp_miaoshu'])?"":$_POST['sp_miaoshu'];
$sp_weight=empty($_POST['sp_weight'])?"":$_POST['sp_weight'];
$sp_event=empty($_POST['sp_event'])?"":$_POST['sp_event'];
$sp_time= empty($_POST['sp_time'])? date('Y-m-d H:i:s',time()) :$_POST['sp_time'];
$sp_editor=$_SESSION['name'];

if(strlen($_FILES['sp_photo']['type'])>0){//这里是要判断有没有上传文件，count() sizeof()数组都没办法识别，只能用此方法
	$tp = array("image/gif","image/pjpeg","image/jpeg","image/png"); //检查上传文件是否在允许上传的类型
	if(!in_array($_FILES['sp_photo']['type'],$tp)){ 
		echo " <script language=JavaScript type=text/javascript>\n alert('".tip_list(1,1,22)."');\n //self.location = \"spduo.php?sp_yn=".$_POST['sp_yn']."&sp_id=".$sp_id."\";\n </script>\n"; 
		exit; 
	} 
	if(is_uploaded_file($_FILES['sp_photo']['tmp_name'])){
		$arr=pathinfo($_FILES['sp_photo']['name']);
		$newname=date('YmdGis').rand(1000,9999);
		$new=$newname.".".$arr['extension'];
		move_uploaded_file($_FILES['sp_photo']['tmp_name'],"uploads/$new");
	}
}
else
	$new = $sp_photo_orginal;

if(empty($delid)&&empty($sp_id)){  //add
	$sql="insert into `tb_shangpin` (`sp_name`,`sp_price`,`sp_danwei`,`sp_brand`,`sp_gys`, `sp_class`,`sp_yn`,`sp_miaoshu`,`sp_photo`,`sp_time`,`sp_weight`,`sp_editor`,`sp_event`) values('$sp_name','$sp_price','$sp_danwei','$sp_brand','$sp_gys','$sp_class','$sp_yn','$sp_miaoshu','$new','$sp_time','$sp_weight','$sp_editor','$sp_event')";
	mysql_query($sql);
	echo " <script language=JavaScript type=text/javascript>\n alert('".tip_list(1,1,11)."');\n self.location = 'sp_index.php';\n </script>\n";
}

if(empty($delid)&&!empty($sp_id)){// modify
	$sql="update `tb_shangpin` set `sp_name`='$sp_name',`sp_price`='$sp_price',`sp_danwei`='$sp_danwei',
	  `sp_brand`='$sp_brand',`sp_gys`='$sp_gys',`sp_class`='$sp_class',`sp_yn`='$sp_yn', 
	  `sp_miaoshu`='$sp_miaoshu',`sp_photo`='$new',`sp_time`='$sp_time',`sp_weight`='$sp_weight',`sp_editor`='$sp_editor',`sp_event`='$sp_event' where `sp_id`='$sp_id'";
	mysql_query($sql);
    echo "<script language=JavaScript type=text/javascript>\n alert('".tip_list(1,1,12)."');\n self.location = 'sp_index.php';\n </script>\n"; 
}

if(!empty($delid)&&empty($sp_id)){
     $sql="delete from tb_shangpin where sp_id='$delid'";
	 mysql_query($sql);
	 echo  "<script language=JavaScript type=text/javascript>\n alert('".tip_list(1,1,13)."');\n self.location = 'sp_index.php';\n </script>\n"; 
}
?>