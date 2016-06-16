<?php
include("config.php");
include("function.php");
checklogin();

$tid= empty($_GET['edit'])?"":$_GET['edit'];
$process_title = empty($_GET['edit'])?"新增类别":"修改类别"; 
$leibie="";
$t_num = 1; 

if(!empty($tid)){
	 $sql="select type_name,t_num from tb_type where tid='$tid'";
	 $query = mysql_query($sql);
     $row= mysql_fetch_array($query);
	 $leibie =  $row['type_name'] ;
	 $t_num =  $row['t_num'] ;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>品类管理</title>
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
	 <form action="type_pro.php" method="post" onsubmit="return type_check(this)"> 
	  <input type="hidden" name="edit" value="<?php echo ($tid); ?>">
      <table width="99%" border="0" cellspacing="0" cellpadding="0" class="main_tbl2 mt10">
        <tr>
          <td width="29%" height="46" align="right"><font color="#FF0000">*</font>品&nbsp;&nbsp;类：</td>
          <td>
            <input type="text" name="leibie"  value="<?php echo ($leibie); ?>">
          </td>
        </tr>
        <tr>
          <td width="29%" height="46" align="right"><font color="#FF0000">*</font>排序码：</td>
          <td>
            <input type="text" name="t_num"  value="<?php echo ($t_num); ?>">
          </td>
        </tr>
     		<tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="sub" value="确定" class="main_btn"></td>
            </tr>
        </tr>
      </table>
	  </form>
    	</div>
	</div>
</body>
</html>