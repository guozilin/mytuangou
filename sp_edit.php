 <?php
include("config.php");
include("function.php");
checklogin();
$sp_id=empty($_GET['edit'])?( empty($_POST['edit'])? "" : $_POST['edit'] ):($_GET['edit']);
$process_title = empty($_GET['edit'])?"新增商品":"修改商品"; 
$sp_name="";
$sp_price="";
$sp_brand="";
$sp_gys="";
$sp_class="";
$sp_yn="";
$sp_miaoshu="";
$sp_photo="";
$sp_time=date('Y-m-d H:i:s',time());
$sp_danwei="";
$sp_weight="";
$sp_event="";
if(!empty($sp_id)){
	$sql="select sp_name,sp_price,sp_brand,sp_gys,sp_class,sp_yn,sp_miaoshu,sp_photo,sp_time,sp_danwei,sp_weight,sp_event from tb_shangpin where sp_id='$sp_id'";
	 $query = mysql_query($sql);
     $row= mysql_fetch_array($query);
	 $sp_name=$row['sp_name'];
	 $sp_price=$row['sp_price'];
	 $sp_brand=$row['sp_brand'];
	 $sp_price=$row['sp_price'];
	 $sp_gys=$row['sp_gys'];
	 $sp_class=$row['sp_class'];
	 $sp_yn=$row['sp_yn'];
	 $sp_miaoshu=$row['sp_miaoshu'];
	 $sp_photo=$row['sp_photo'];
	 $sp_time=$row['sp_time'];
	 $sp_danwei=$row['sp_danwei'];
	 $sp_weight=$row['sp_weight'];
	 $sp_event=$row['sp_event'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>团购管理系统</title>
<link href="htcss/styles.css" rel="stylesheet"></link>
<script type="text/javascript" src="htcss/function.js"></script>
<script type="text/javascript" src="htcss/jquery.1.8.2.js"></script>
<script type="text/javascript">
$(function(){
	var num = $("#com_gys").val();
		$.get("tgajax.php",{
			atype: 3,
			value:num,
		},function(data,textstatues){
		$("#com_scs").html(data);
	})
	$("#com_gys").change(function(){
		var num=$(this).val();	
		$.get("tgajax.php",{
			atype: 3,
			value:num,
		},function(data,textstatues){
		$("#com_scs").html(data);
	})
	})
})
</script>
</head>
<body> 
<?php PageTop();?>
<div class="main_w">
<?php leftpage();?>
    <div class="right">
     <form name="form" method="POST" action="sp_pro.php"  enctype="multipart/form-data" onsubmit="return checkspadd(this)">
        <div class="right_tit bd_fot">
            <div class="f_l"><?php echo ($process_title); ?></div>
            <div class="f_r"></div>
           <input type="hidden" name="edit" value="<?php echo ($sp_id) ?>">
        </div>
<table cellpadding="0" cellspacing="0" class="main_tbl2 mt10">
      <tr>
         <td class="td_right"><font color="#FF0000">*</font>礼盒类别：</td>
  		 <td><input name="sp_yn" id="a1" type="radio" onclick="IfShow(document.getElementById('d1'),document.getElementById('d2'),1)"  value="1" <?php echo tip_list(1,$sp_yn,"2");?>/><label for="a1" style="cursor:pointer">单品礼盒</label>&nbsp;&nbsp;
     		 <input name="sp_yn" id="a2" type="radio" onclick="IfShow(document.getElementById('d1'),document.getElementById('d2'),0)"  value="2" <?php echo tip_list(2,$sp_yn,"2");?>/><label for="a2" style="cursor:pointer">多品礼盒</label>
 		</td>
	</tr>
      <tr>
        <td width="179" class="td_right"><font color="#FF0000">*</font>商品名称：</td>
        <td><input type="text" name="sp_name" value="<?php echo ($sp_name) ?>" /></td>
      </tr>
      <tr>
        <td class="td_right"><font color="#FF0000">*</font>价格：</td>
        <td><input type="text" name="sp_price" value="<?php echo ($sp_price) ?>"/>
          <select name="sp_danwei" >
          <?php 
		  for($i=1;$i<16;$i++)
			  echo "<option value=".$i.tip_list($i,$sp_danwei,1).">".unit_list($i)."</option> \n";
		  ?> 
          </select>
          </td>
      </tr>
      <tr id="d2" style="display:<?php echo ($sp_yn==1)?'':'none' ?>">
        <td class="td_right">净含量:</td>
        <td><input type="text" name="sp_weight" value="<?php echo ($sp_weight) ?>"/></td>
      </tr>
      <tr >
        <td class="td_right">品牌：</td>
        <td><input type="text" name="sp_brand" value="<?php echo ($sp_brand) ?>"/></td>
      </tr>
      <tr>
        <td class="td_right"><font color="#FF0000">*</font>类别：</td>
        <td>
        <select name="sp_class"><option value="">选择商品类别</option><?php SelectOptsList("tid","type_name","tb_type",$sp_class); ?></select>
        </td>
  	</tr>
    <tr>
   	    <td class="td_right"><font color="#FF0000">*</font>供应商：</td>
   		<td>
        <select name="sp_gys" id="com_gys"><option value="">选择供应商</option><?php SelectOptsList("com_id","com_gys","tb_com",$sp_gys); ?></select>
        </td>
      </tr>
      <tr>
        <td class="td_right">生产商：</td>
        <td id="com_scs"></td>
      </tr>
      <tr>
         <td class="td_right">商品图片：</td>
         <td> <img src="uploads/<?php echo empty($sp_photo)?"no.jpg":$sp_photo ?>" width="100" height="100" />
              <input name="sp_photo" type="file"><input type="hidden" name="sp_photo_orginal" value="<?php echo ($sp_photo) ?>"></td>
      </tr>
  	  
 	<tr id="d1" style="display:<?php echo ($sp_yn==1)?'':'none' ?>">
      <td valign="top" class="td_right" >商品描述：</td>
      <td ><textarea name="sp_miaoshu"  cols="60" rows="5" value=""><?php echo ($sp_miaoshu)?></textarea></td>
  	</tr>
    <tr>
      <td class="td_right">活动：</td>
      <td><textarea name="sp_event"  cols="60" rows="5" value=""><?php echo ($sp_event)?></textarea></td>
    </tr>
    <tr>
        <td class="td_right">发布时间：</td>
        <td><input type="text" name="sp_time" value="<?php echo ($sp_time) ?>"/></td>
      </tr>
  	<tr>
   	   <td>&nbsp;</td>
       <td><input type="submit" name="sub"  value="提交"  class="main_btn"/></td>
    </tr>
</table>
</form> 
</div>
</div>
</body>
</html>


  