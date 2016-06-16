
<?php
include("config.php");
include("function.php");
checklogin();
//该页带参数是ok了，但是修改和删除的部分，都没有把参数带过去，导致修改或删除之后，又跳回到第一页了。要继续完善。
$P_where=" where 1=1 ";
$P_search=$_GET['P_search'];
$sp_name=$_GET['keys'];
$sp_class=$_GET['sp_class'];
$sp_gys=$_GET['sp_gys'];
$p1= empty($_GET['price1'])?"":intval($_GET['price1']);
$p2= empty($_GET['price2'])?"":intval($_GET['price2']);
$sp_editor=$_SESSION['name'];

if(!empty($P_search)){
	if(!empty($sp_name))
		$P_where = $P_where." and sp_name like '%".$sp_name."%' ";
	if(!empty($sp_class))
		$P_where = $P_where." and sp_class = '".$sp_class."' ";
	if(!empty($sp_gys))
		$P_where = $P_where." and sp_gys = '".$sp_gys."' ";
	
	if(!empty($p1)&&empty($p2))
		$P_where = $P_where." and sp_price >= ".$p1;
	elseif(empty($p1)&&!empty($p2))
		$P_where = $P_where." and sp_price <= ".$p2;
	elseif(!empty($p1)&&!empty($p2)){
		if($p1>=$p2)
			$P_where = $P_where." and sp_price between ".$p2." and ".$p1;
		else
			$P_where = $P_where." and sp_price between ".$p1." and ".$p2;
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商品管理</title>
<link href="htcss/styles.css" rel="stylesheet">
<script type="text/javascript" src="htcss/function.js"></script>
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
  	<div class="right_tit bd_fot">
    	<div class="f_l">商品管理</div>
        <div class="f_r"><a href="javascript:viod();" onclick="window.location.href='sp_edit.php'">新 建</a></div>
    </div>
    <div class="main_search">
    	<form action="<?php echo $_SERVER['PHP_SELF']?>" method="get" onsubmit="return checksp(this)">
		<select name="sp_class"><option value="">商品类别选择</option><?php SelectOptsList("tid","type_name","tb_type",$sp_class); ?></select>&nbsp;&nbsp;
        <select name="sp_gys"><option value="">供应商选择</option><?php SelectOptsList("com_id","com_gys","tb_com",$sp_gys); ?></select>&nbsp;&nbsp;
        商品名称：<input name="keys" type="text" size="25" value="<?php echo $sp_name?>">&nbsp;&nbsp;
        价格：从<input type="text" name="price1" size="3" value="<?php echo $p1?>"/>到<input type="text" name="price2" size="3" value="<?php echo $p2?>"/>&nbsp;&nbsp;
		<input type="submit" name="P_search" value="搜 索" class="sub_btn">
		</form>
    </div>
 <?php
	$pagesize1 = 20;  //每页要显示的条数
    if(($_GET[page])==""){  //判断当前page值是否为0，如果为0，则赋值page为1，
       $page1=1;
 	}else{$page1=intval($_GET[page]);//防止page前有空格，
}
       $sql="select A.sp_id from tb_shangpin A inner join tb_type B on A.sp_class=B.tid inner join tb_com C on A.sp_gys=C.com_id ".$P_where;
	   $query=mysql_query($sql);
       $count=mysql_num_rows($query);
	   $sql2="select A.sp_id,A.sp_name,A.sp_price,B.type_name,C.com_gys,A.sp_time,A.sp_yn,A.sp_editor from tb_shangpin A inner join tb_type B on A.sp_class=B.tid inner join tb_com C on A.sp_gys=C.com_id ".$P_where." order by A.sp_time desc limit ".($page1-1)*$pagesize1.",".$pagesize1;
      //echo $sql;
	  $query2=mysql_query($sql2);
?>
	 <table  cellpadding="0" cellspacing="0" class="main_tbl mt10">
          <tr>
            <th>ID</th>
            <th>礼盒类型</th>
            <th>商品名称</th>
            <th>价格(元)</th>
            <th>供应商</th>
            <th>类别</th>
            <th>更新时间</th>
            <th>编辑人</th>
            <th>操作</th>
         </tr>
<?phP  while($rs=mysql_fetch_array($query2)){ 
		$sp_id = $rs['sp_id'];
		$sp_yn = $rs['sp_yn']==1?"更多图片":"单品图文";
		$sp_yn2 = $rs['sp_yn']==1?"单品礼盒":"多品礼盒";
		$sp_name = $rs['sp_name'] ;
?>
         <tr>
            <td><?php echo $sp_id ?></td>
            <td><?php echo $sp_yn2 ?></td>
            <td><?php echo iconv_substr($sp_name,0,15,'utf-8') ?></td>
            <td><?php echo $rs['sp_price']==0?"时价":$rs['sp_price'] ?></td>
            <td><?php echo iconv_substr($rs['com_gys'],0,8,'utf-8') ?></td>
            <td><?php echo $rs['type_name']?></td>
            <td><?php echo iconv_substr($rs['sp_time'],0,10,'utf-8') ?></td>
            <td><?php echo $rs['sp_editor'] ?></td>
            <td> <a href="spduo.php?sp_yn=<?php echo $rs['sp_yn']?>&sp_id=<?php echo $sp_id?>"><?php echo $sp_yn; ?></a>&nbsp;&nbsp;<a href="sp_edit.php?edit=<?php echo $sp_id?>">编辑</a>&nbsp;&nbsp;<a href="javascript:viod();" onclick="if(confirm('确定要删除吗？')) self.location='sp_pro.php?del=<?php echo $sp_id?>';">删除</a> </td>
        </tr>
 <?php } ?>
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