<?php
include("config.php");
include("function.php");
checklogin();
$ifshow = $_GET['sp_yn']==1?"none":"";
$ifshow2 = $_GET['sp_yn']==1?"单品礼盒，仅仅管理图片！":"多品礼盒，管理图片和各单品规格、内容等描述！";
$sp_id = empty($_GET['sp_id'])?"":intval($_GET['sp_id']);
if(empty($sp_id)) {
	echo header("location:sp_index.php");
	exit;
}
elseif(!checkspid($sp_id)){//check if sp_id exist
	echo header("location:sp_index.php");
	exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>团购管理系统</title>
<link href="htcss/styles.css" rel="stylesheet">
</head>
<body> 
<?php PageTop();?>
<div class="main_w">
<?php leftpage();?>
<div class="right">
  	<div class="right_tit bd_fot">
    	<div class="f_l">商品图片管理</div>
        <div class="f_r"><?php echo $ifshow2?></div>
    </div>
   <div class="main_search">
   	  <form method="post" action="upload.php" enctype="multipart/form-data"> 
          <input name='uploads[]' type="file" multiple>
          <input type='hidden'  name="sp_id" value="<?php echo $sp_id ?>">
          <input type='hidden'  name="sp_yn" value="<?php echo $_GET['sp_yn'] ?>">
          <input name="uploadpic" type="submit" class="sub_btn" value="上传"> 
     </form>  
    </div>
	<table cellspacing="0" cellpadding="0" class="main_tbl mt10">
 <?php 
	$ss=1;
    $sql="select p_id,p_photos,p_miaoshu,p_pinming,p_place,p_weight,p_level from `tb_photos` where `sp_id`='".$sp_id."' order by p_id desc ";
	$query = mysql_query($sql);
?>
        <tr>
            <th width="5%">商品ID</th>
            <th width="5%">图ID</th>
            <th width="10%">图片</th>
            <th style="display:<?php echo $ifshow?>" width="22%">描述</th>
            <th style="display:<?php echo $ifshow?>" width="12%">品名</th>
            <th style="display:<?php echo $ifshow?>" width="11%">克重</th>
            <th style="display:<?php echo $ifshow?>" width="12%">产地</th>
            <th style="display:<?php echo $ifshow?>" width="12%">等级</th>
            <th style="display:<?php echo $ifshow?>" width="11%">操作</th>
        </tr>

<?php while ($rs=mysql_fetch_array($query)){ ?>
	<form name="form<?php echo $ss ?>" method="post" action="spchuli.php" >
      <tr>
        <td><?php echo $sp_id?><input type="hidden" name="sp_id" value="<?php echo $sp_id?>"></td>
        <td><?php echo $rs['p_id'] ?></td>
        <td><img src="picture/<?php echo $rs['p_photos'] ?>" width="100" height="70" /></td>
        <td style="display:<?php echo $ifshow?>"><textarea name="p_miaoshu"  cols="20" rows="5"><?php echo $rs['p_miaoshu'] ?></textarea></td>
        <td style="display:<?php echo $ifshow?>"><input name="p_pinming" type="text" class="text"  value="<?php echo $rs['p_pinming'] ?>" size="10" /></td>
        <td style="display:<?php echo $ifshow?>"><input name="p_weight" type="text" class="text"  value="<?php echo $rs['p_weight'] ?>" size="10" /></td>
        <td style="display:<?php echo $ifshow?>"><input name="p_place" type="text" class="text" value="<?php echo $rs['p_place'] ?>" size="10" /></td>
        <td style="display:<?php echo $ifshow?>"><input name="p_level" type="text" class="text"  value="<?php echo $rs['p_level'] ?>" size="10" /></td>
        <td align="left" valign="middle">
        <input type="hidden" name="p_id" value="<?php echo $rs['p_id']?>">
        <input type='hidden'  name="sp_yn" value="<?php echo $_GET['sp_yn']?>">
        <?php echo $_GET['sp_yn']==1?"":"<input name=edit type=submit class=sub_btn  value=修改 /><br><br> \n";?> 
        <input name="del" type="submit" class="sub_btn"  value="删除" onclick="return confirm('确定要删除吗？')"/>
        </td>
    </tr>	
    </form>
<?php $ss++; 
	} 
?> 
    </table>
  </div>
</body>
</html>