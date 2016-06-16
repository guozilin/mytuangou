<?php  
include("config.php"); 

$sp_id = empty($_POST['sp_id'])?"":intval($_POST['sp_id']);
if(empty($sp_id)) {
	echo header("location:sp_index.php");
	break;
}

$uploadfile; // 图片的名字
if($_POST['uploadpic']=='上传'){  
	$dest_folder = "picture/"; //上传图片保存的路径图片放在跟你upload.php同级的picture文件夹里
	$arr=array(); //定义一个数组存放上传图片的名称方便你以后会用的。
	$count=0; 

	if(!file_exists($dest_folder)) 
		mkdir($dest_folder,700); //创建文件夹，并给予最高权限
	//使用file_exists 可能会出现目录权限，中文名等都影响该函数，导致报错
 
	$tp = array("image/gif","image/pjpeg","image/jpeg","image/png"); //检查上传文件是否在允许上传的类型
	foreach ($_FILES["uploads"]["error"] as $key => $error) { 
		if(!in_array($_FILES["uploads"]["type"][$key],$tp)){ 
			echo "<script language='javascript'>"; 
			echo "alert(\"No file selected or wrong filename extension!\");"; 
			echo "self.location=\"spduo.php?sp_yn=".$_POST['sp_yn']."&sp_id=".$sp_id."\";"; 
			echo "</script>"; 
			exit; 
		} 
		if ($error == UPLOAD_ERR_OK) { 
			$tmp_name = $_FILES["uploads"]["tmp_name"][$key]; 
			$a=explode(".",$_FILES["uploads"]["name"][$key]);//截取文件名跟后缀 
			$prename = substr($a[0],10); //如果你到底的图片名称不是你所要的你可以用截取字符得到
			$prename = $a[0];  
			$name = date('YmdHis').mt_rand(100,999).".".$a[1]; // 文件的重命名（日期+随机数+后缀）
			$uploadfile = $dest_folder.$name; // 文件的路径
			move_uploaded_file($tmp_name, $uploadfile); 
			$arr[$count]=$uploadfile; 
			$query="insert into tb_photos(p_photos,sp_id) values('$name','$sp_id')"; // 插入到数据库
			$res=mysql_query($query); 
			//if($res) 
			//	echo $uploadfile."<br/> \n"; 
			$count++;
		} 
	}
	echo "<script language='javascript'> \n"; 
	echo "alert('all ".$count." files uploaded successfully.'); \n";
	echo "self.location=\"spduo.php?sp_yn=".$_POST['sp_yn']."&sp_id=".$sp_id."\"; \n"; 
	echo "</script> \n"; 
} 
?>