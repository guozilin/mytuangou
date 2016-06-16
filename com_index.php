<?php
include("config.php");
include("function.php");
checklogin();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>供应商管理</title>
<link href="htcss/styles.css" rel="stylesheet"></link>
<script type="text/javascript" src="htcss/jquery.1.8.2.js"></script>
<script type="text/javascript">
$(function(){
	$("tr:odd").addClass("odd");
	$("tr:even").addClass("even");
	$("tr").mouseover(function(){
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
    	<div class="f_l">供应商管理</div>
        <div class="f_r"><a href="javascript:viod();" onclick="window.location.href='com_edit.php'">新 建</a></div>
    </div>
    <table cellspacing="0" cellpadding="0" class="main_tbl">
<?php
		$pagesize1 = 50;  //每页要显示的条数
		if(($_GET[page])==""){  //判断当前page值是否为0，如果为0，则赋值page为1，
		   $page1=1;
		 }
		else{
		   $page1=intval($_GET[page]);//防止page前有空格，
		 }
		$sql="select * from tb_com";
		$query=mysql_query($sql);
		$count=mysql_num_rows($query);
		$sql2="select com_gys,com_scs,com_id,com_intro from tb_com order by com_id desc limit ".($page1-1)*$pagesize1.",".$pagesize1;
		$query2=mysql_query($sql2);
 
?>    
         <tr>
         <th>ID</th>
         <th>供应商</th>
         <th>生产商</th>
         <th>供应商简介</th>
         <th>操作</th>
         </tr>
<?php  while($row=mysql_fetch_array($query2)){ ?>
        <tr>
        <td><?php echo $row['com_id'] ?></td>
        <td><?php echo $row['com_gys'] ?></td>
        <td><?php echo $row['com_scs'] ?></td>
        <td><?php echo strlen($row['com_intro'])>20?(iconv_substr($row['com_intro'],0,20,'utf-8')."..."):$row['com_intro']?></td>
        <td><a href="com_edit.php?edit=<?php echo $row['com_id'] ?>">修改</a> &nbsp;&nbsp;<a href="javascript:viod();" onclick="if(confirm('确定要删除吗？')) self.location='com_pro.php?del=<?php echo $row['com_id'] ?>';">删除</a></td>
        </tr>
<?php
  } 
?>
</table>
		<div class="page">
<?php  
	$page=page($count,$pagesize1);
	echo $page['html'];
?>
        </div>
  </div>
</div>
</body>
</html>
