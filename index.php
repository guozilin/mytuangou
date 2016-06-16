<?php
include("config.php");
include("function.php");

$P_where=" where 1=1 ";
$P_search=$_GET['P_search'];
$sp_name=$_GET['keys'];
$sp_class=$_GET['sp_class'];
$sp_gys=$_GET['sp_gys'];
$p1= empty($_GET['price1'])?"":intval($_GET['price1']);
$p2= empty($_GET['price2'])?"":intval($_GET['price2']);
$tid=$_GET['tid'];

if(!empty($tid))
	$P_where = $P_where." and sp_class = ".$tid;
if(!empty($P_search)){
	if(!empty($sp_name))
		$P_where = $P_where." and sp_name like '%".$sp_name."%' ";
	if(!empty($sp_gys))
		$P_where = $P_where." and sp_gys = ".$sp_gys;
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
//echo $P_where;
$pagesize1 = 10;  //
if(($_GET[page])=="")  //判断当前page值是否为0，如果为0，则赋值page为1，
     $page1=1;
else
	$page1=intval($_GET[page]);//防止page前有空格，
$sql="select A.sp_id from tb_shangpin A inner join tb_type B on A.sp_class=B.tid inner join tb_com C on A.sp_gys=C.com_id ".$P_where;
$query=mysql_query($sql);
$count=mysql_num_rows($query);
$sql2="select A.sp_id,A.sp_name,A.sp_photo,A.sp_price,B.type_name,A.sp_miaoshu,A.sp_brand,A.sp_weight,A.sp_event,C.com_gys,A.sp_yn,A.sp_danwei,A.sp_num from tb_shangpin A inner join tb_type B on A.sp_class=B.tid inner join tb_com C on A.sp_gys=C.com_id ".$P_where." order by A.sp_num,A.sp_time limit ".($page1-1)*$pagesize1.",".$pagesize1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>货通团购网</title>
<link href="css/styles.css" rel="stylesheet"></link>
<script type="text/javascript" src="http://www.coding123.net/getip.ashx?js=1"></script>
<script type="text/javascript" src="htcss/function.js"></script>
<script>
	$ip=ip.substr(1,ip.length-1);
	window.onload=sendip($ip,0);
</script>
</head>
<body>
<div class="banner"> 
	<div class="sy_btn">
    <a href="http://www.httx668.com" target="_blank" title="联盟首页"></a>
    </div>
</div>
<div class="main_box">
	<div class="main_left">
    	<div class="left_title">
        </div>
  		<div class="left_em">
     <ul>
<?php  
$sql3="select type_name,tid from tb_type  order by t_num,tid " ;
$query3=mysql_query($sql3);
while($row=mysql_fetch_array($query3))  	
	echo "<li><a href=".$_SERVER['PHP_SELF']."?tid=".$row['tid']." ".tip_list($row['tid'],$tid,21).">".$row['type_name']."</a></li> \n";
?>
     </ul>
	</div>
	<div class="left_fot"><img src="imgs/left_bot.jpg"/></div>
</div>
<div class="main_right goods_list">
	<div class="search_box">
	<form action="<?php echo $_SERVER['PHP_SELF']?>" method="get" onsubmit="return checksp(this)">
		<input type="hidden" name="tid" value="<?php echo ($tid) ?>">
		<font class="f_l">品名查询：</font><input name="keys" type="text" value="<?php echo $sp_name?>" size="30"/>
		<font class="f_l">价格：从</font><input name="price1" type="text" size="5" value="<?php echo $p1?>"/><font class="f_l">到</font><input name="price2" type="text" size="5" value="<?php echo $p2?>"/>
        <span class="sel_box f_l">
        <select name="sp_gys"><option value="">供应商选择</option><?php SelectOptsList("com_id","com_gys","tb_com",$sp_gys); ?></select></span>
		<input name="P_search" type="submit" class="search_box2" value="搜 索" >
	</form>
	</div>
	<div class="main_title">所有商品列表</div>
        <?php
	    $query2=mysql_query($sql2);
	    while($rs=mysql_fetch_array($query2)) {	
		$sp_price=(empty($rs['sp_price'])||$rs['sp_price']==0)?"时价":$rs['sp_price']; 
		$sp_danwei=(empty($rs['sp_price'])||$rs['sp_price']==0)?"":unit_list($rs['sp_danwei']);
		$sp_photo=empty($rs['sp_photo'])?"no.jpg":$rs['sp_photo'];	
		$sp_weight=(empty($rs['sp_weight'])?"&nbsp;":($rs['sp_yn']==2?"&nbsp;":("净含量：".$rs['sp_weight'])));
		$sp_id=$rs['sp_id'];
		$sp_event=$rs['sp_event'];
		?>  
        <div class="items">
          <div class="items_img"><img src="uploads/<?php echo $sp_photo?>"  /></div>
            	<div class="items_int">
            	<div class="goods_title"><?php echo $rs['sp_name']?></div>
                <div class="goods_price">
                <table width="100%" border="0" cellpadding="0" cellspacing="0" style="font-size:14px;">
                  <tr>
                    <td width="40%" height="30" valign="middle">价格：<em><?php echo $sp_price?></em>&nbsp;<?php echo $sp_danwei?></td>
                    <td width="60%" valign="middle"><?php echo $sp_weight?></td>
                  </tr>
                  <tr>
                    <td height="30" valign="middle">品牌：<?php echo $rs['sp_brand']?></td>
                    <td valign="middle">供应商：<?php echo $rs['com_gys']?></td>
                  </tr>
                </table>
                <?php
				if(!empty($sp_event)){ ?>
                <div class="items_event">活动：<?php echo $sp_event?></div>
                                         <?php }?>
</div>
                <div class="cb"></div>
               <?php
              $sql3="select C.p_level,C.p_pinming,C.p_place,C.p_weight,A.sp_id,A.sp_yn from tb_shangpin A  inner join  tb_photos C on A.sp_id=C.sp_id where A.sp_id='$sp_id' limit 6";
              $query3=mysql_query($sql3);
			  $count3=mysql_num_rows($query3);
			  if($rs['sp_yn']==2&&($count3)>0){
			  ?>
                 <div class="goods_jjie">
                  <div class="title" >内装产品：（内装更多商品，点击详情查看更多）</div>
                    <div class="cb"></div>
                    <table cellpadding="0" cellspacing="0" class="goods_tbl f_l mr10" width="49%">
                       <tr>
                         <th width="30%">品名</th>
                        <th width="30%">原产地</th>
                        <th width="25%">重量</th>
                        <th width="15%">等级</th>
                      </tr>
                    <?php
                     for($i=1;$i<($count3/2+1);$i++){
                     $rw=mysql_fetch_array($query3);
                     $p_level=$rw[0];
                     $p_pinming=$rw[1];
                     $p_place=$rw[2];
                     $p_weight=$rw[3];
                     $rw=mysql_fetch_array($query3);?>
                     <tr>
                      <td><?php echo $p_pinming ?></td>
                      <td><?php echo $p_place ?></td>
                      <td><?php echo $p_weight ?></td>
                      <td><?php echo $p_level ?></td>
                     </tr>                 
                    <?php  } ?>
                    </table>
                    <?php
                   $sql4="select C.p_level,C.p_pinming,C.p_place,C.p_weight,A.sp_id,A.sp_yn from tb_shangpin A  inner join  tb_photos C on A.sp_id=C.sp_id where A.sp_id='$sp_id' limit 6";
                  $query4=mysql_query($sql4);
                  $count4=mysql_num_rows($query4);?>
                <table cellpadding="0" cellspacing="0" class="goods_tbl f_l" width="49%">
                    <tr>
                        <th width="28%">品名</th>
                        <th width="32%">原产地</th>
                        <th width="25%">重量</th>
                        <th width="15%">等级</th>
                  </tr>
                          <?php
                         for($a=1;$a<=($count4/2);$a++){
                         $rww=mysql_fetch_array($query4);
                         $rww=mysql_fetch_array($query4);
                         $p_level=$rww[0];
                         $p_pinming=$rww[1];
                         $p_place=$rww[2];
                         $p_weight=$rww[3];?>
                    <tr>
                       <td><?php echo $p_pinming ?></td>
                       <td><?php echo $p_place ?></td>
                       <td><?php echo $p_weight ?></td>
                       <td><?php echo $p_level ?></td>
                  </tr>                 
                    <?php  } ?>
                </table>
              </div>
       <?php
       } 
	   elseif($rs['sp_yn']==1){?>
              <div class="goods_jjie">
                 <div class="title" >产品描述</div>
                   <p style="text-indent:2em"><?php echo strlen($rs['sp_miaoshu'])>450?(iconv_substr($rs['sp_miaoshu'],0,140,'utf-8')."..."):$rs['sp_miaoshu']?></p>
              </div>
      <?php }?>  
      </div>
      <div class="text_r cb"><a href="detail.php?detail=<?php echo $rs['sp_id']?>" class="look_btn" target="_blank">查看详情</a>
    </div>
 </div> 
 <?php } ?>   
 <div class="page">
 <?php  
 $page=page($count,$pagesize1);
 echo $page['html'];
 ?>
        </div>
    </div>
</div>
<br/>
<br/>
</body>
</html>
