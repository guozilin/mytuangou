<?php
include("config.php");
include("function.php");
checklogin();

$p_miaoshu=empty($_POST['p_miaoshu'])?"":($_POST['p_miaoshu']);
$p_pinming=empty($_POST['p_pinming'])?"":($_POST['p_pinming']);
$p_place=empty($_POST['p_place'])?"":($_POST['p_place']);
$p_weight=empty($_POST['p_weight'])?"":($_POST['p_weight']);
$p_level=empty($_POST['p_level'])?"":($_POST['p_level']);
$p_id = empty($_POST['p_id'])?"":($_POST['p_id']);
$sp_id = empty($_POST['sp_id'])?"":($_POST['sp_id']);
$sp_yn = empty($_POST['sp_yn'])?"":($_POST['sp_yn']);
$p_editor=$_SESSION['name'];
//echo "sp_yn".$sp_yn;

if(!empty($_POST['edit'])&&empty($_POST['del'])){ //update
	$sql="update `tb_photos` set `p_miaoshu`='$p_miaoshu', `p_pinming`='$p_pinming' ,`p_place`='$p_place',  `p_weight`='$p_weight' ,`p_level`='$p_level',`p_editor`='$p_editor' where `p_id`='$p_id'";
	mysql_query($sql);
	echo "<script language=JavaScript type=text/javascript>\n alert('".tip_list(1,1,16)."');\n self.location = 'spduo.php?sp_yn=".$sp_yn."&sp_id=".$sp_id."';\n </script>\n";  
}

if(empty($_POST['edit'])&&!empty($_POST['del'])){ //del
	$sql="delete  from `tb_photos`  where `p_id`='$p_id'";
	mysql_query($sql);
	echo "<script language=JavaScript type=text/javascript>\n alert('".tip_list(1,1,17)."');\n self.location = 'spduo.php?sp_yn=".$sp_yn."&sp_id=".$sp_id."';\n </script>\n";  
}
?>