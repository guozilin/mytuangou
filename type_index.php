<?php
include("config.php");
include("function.php");
checklogin();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>品类管理</title>
<link href="htcss/styles.css" rel="stylesheet">
<script type="text/javascript" src="htcss/jquery.1.8.2.js"></script>
<script type="text/javascript">
$(function(){
	$("tr:odd").addClass("odd");
	$("tr:even").addClass("even");
	$("tr").mouseover(
		function(){
		 $(this).addClass("over");
		 }).mouseout(function(){
		 $(this).removeClass("over")
	});  
});
</script>
</head>
<body>
<?php PageTop();?>

<div class="main_w">
<?php leftpage();?>
  <div class="right">
    <div class="right_tit">
      <div class="f_l">品类管理</div>
      <div class="f_r"><a href="javascript:viod();" onclick="window.location.href='type_edit.php'">新 建</a></div>
    </div>
    <table cellspacing="0" cellpadding="0" class="main_tbl">
<?php
$sql="select tid, type_name,t_num from tb_type order by t_num,tid desc";
$query=mysql_query($sql);
if(mysql_num_rows($query)){
//if(0){
?>
      <tr>
        <th>ID</th>
        <th>排序</th>
        <th>分类</th>
        <th>操作</th>
      </tr>
<?php	while($row=mysql_fetch_array($query)){?>
      <tr>
        <td><?php echo $row['tid'] ?></td>
        <td><?php echo $row['t_num'] ?></td>
        <td><?php echo $row['type_name'] ?></td>
        <td><a href="type_edit.php?edit=<?php echo $row['tid'] ?>">修改</a>&nbsp;&nbsp;<a href="javascript:viod();" onclick="if(confirm('确定要删除吗？')) self.location='type_pro.php?del=<?php echo $row['tid'] ?>';">删除</a></td>
      </tr>
<?php
	}
}
else
	echo "<tr><td>尚未新建类别</td></tr>";
?>
    </table>
  </div>
</div>
</body>
</html>
