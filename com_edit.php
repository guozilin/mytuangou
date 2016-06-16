<?php
include("config.php");
include("function.php");
checklogin();

$com_id= empty($_GET['edit'])?( empty($_POST['edit'])? "" : $_POST['edit'] ):($_GET['edit']);
$process_title = empty($_GET['edit'])?"新增供应商":"修改供应商"; 
$com_gys="";
$com_scs = ""; 
$com_intro = ""; 

if(!empty($com_id)){
	 $sql="select com_gys,com_scs,com_intro from tb_com where com_id='$com_id'";
	 $query = mysql_query($sql);
     $row= mysql_fetch_array($query);
	 $com_gys =  $row['com_gys'] ;
	 $com_scs =  $row['com_scs'] ;
	 $com_intro =  $row['com_intro'] ;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>供应商管理</title>
<link href="htcss/styles.css" rel="stylesheet">
<script type="text/javascript" src="htcss/function.js"></script>
</head>
<body>
<?php PageTop();?>
<div class="main_w">
<?php leftpage();?>
	<div class="right">
       <div class="right_tit bd_fot">
    	<div class="f_l"><?php echo ($process_title); ?></div>
     </div>
<form action="com_pro.php" method="post" onsubmit="return com_check(this)">  
<input type="hidden" name="edit" value="<?php echo ($com_id); ?>">
  <table cellspacing="0" cellpadding="0" class="main_tbl2 mt10">
    <tr>
       <td width="19%" class="td_right"><font color="#FF0000">*</font>供应商名称：</td>
       <td width="81%" align="left" valign="middle">
        <input type="text" name="com_gys"  value="<?php echo  ($com_gys); ?>"></td>
    </tr>
    <tr>
      <td class="td_right">生产商名称：</td>
      <td align="left" valign="middle"><input name="com_scs" type="text" value="<?php echo  ($com_scs); ?>"></td>
    </tr>
	<tr>
      <td valign="top" class="td_right"><font color="#FF0000">*</font>供应商简介：</td>
      <td align="left" valign="middle"><textarea  name="com_intro" cols="90" rows="10" ><?php echo ($com_intro); ?></textarea></td>
    </tr>
	<tr>
       <td>&nbsp;</td>
       	<td><input type="submit" name="sub" value="确定" class="main_btn"></td>
    </tr>
 </table>
	  </form>
</div>
</div>
</body>
</html>