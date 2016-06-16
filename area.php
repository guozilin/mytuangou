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
<script type="text/javascript" src="htcss/popup_layer.js"></script>
<script type="text/javascript">
$(function(){
	new PopupLayer({trigger:"#add",popupBlk:"#areadd",closeBtn:"#no",
	offsets:{x:300,y:50}
	});
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
    	<div class="f_l">地区类别管理</div>
    </div>
    <div><input type="submit" name="button3" id="add" value="添加" /></div>
    <table cellspacing="0" cellpadding="0" class="main_tbl">
      <tr>
         <th width="20%">类别</th>
         <th width="34%">内容</th>
         <th width="26%">创建时间</th>
         <th width="20%">操作</th>
         </tr>
<?php
	$sql="select `cat_name`,`cat_id`,`parent_id` from `tb_area` where `parent_id`=0 order by `cat_id`";
	$query=mysql_query($sql);
	while($row=mysql_fetch_array($query)){
		$cat_name=$row['cat_name'];
		$cat_id=$row['cat_id'];
		$parent_id=$row['parent_id'];
 ?>
        <tr>
        <td>省份/直辖市</td>
        <td><?php echo $cat_name?></td>
        <td>&nbsp;</td>
        <td><input type="submit" name="button" id="edit" value="修改" />
          |
            <input type="button" name="button2" id="next" value="子栏目管理" /></td>
        </tr>
        <?php }?>
</table>
<div id="areadd" style="display:'none';">
<form action="areapro.php" method="post" >
<input type="hidden" name="edit" value="<?php echo $cat_id ?>">
<input type="hidden" name="pedit" value="<?php echo $parent_id ?>">
	<div class="title">添加地区分类内容</div>
    <div class="cou">*地区内容: <input type="text" name="province" /></div>
	<div class="add"><input type="submit" name="yes" value="确定" /><input type="button" id="no"  value="取消" /></div>
  </form></div>
</div>
</div>
</body>
</html>
