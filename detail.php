<?php
include("config.php");
include("function.php");
$sp_id = empty($_GET['detail'])?"":intval($_GET['detail']);
if(empty($sp_id)) {
	echo header("location:index.php");
	exit;
}
elseif(!checkspid($sp_id)){//check if sp_id exist
	echo header("location:index.php");
	exit;
}

$sql="select A.sp_id,A.sp_name,A.sp_photo,A.sp_brand,A.sp_danwei,A.sp_price,A.sp_weight,A.sp_event,C.com_gys,C.com_scs,C.com_intro,A.sp_yn,A.sp_miaoshu from tb_shangpin A inner join tb_com C on A.sp_gys=C.com_id where sp_id='$sp_id'";
$query=mysql_query($sql);
$rr=mysql_fetch_array($query);
$sp_name=$rr['sp_name'];
$sp_price=(empty($rr['sp_price'])||$rr['sp_price']==0)?"时价":$rr['sp_price']; 
$sp_danwei=(empty($rr['sp_price'])||$rr['sp_price']==0)?"":unit_list($rr['sp_danwei']);
$sp_brand=$rr['sp_brand'];
$com_gys=$rr['com_gys'];
$com_scs=$rr['com_scs'];
$com_intro=$rr['com_intro'];
$sp_yn=$rr['sp_yn'];
$sp_photo=empty($rr['sp_photo'])?"no.jpg":$rr['sp_photo'];	
$sp_miaoshu=$rr['sp_miaoshu'];
$sp_event=$rr['sp_event'];
$sp_weight=(empty($rr['sp_weight'])?"":($rr['sp_yn']==2?"":("<div class='item_list'>净含量：".$rr['sp_weight']."</div>")));
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="http://www.coding123.net/getip.ashx?js=1"></script>
<script type="text/javascript" src="htcss/function.js"></script>
<script>
 $ip=ip.substr(1,ip.length-1);
 window.onload=sendip($ip,<?php echo $sp_id ?>);
</script>
<title>货通团购网—<?php echo $sp_name ?>详情页</title>
<link href="css/styles.css" rel="stylesheet"></link>
</head>
<body>
<div class="banner">
	<div class="sy_btn">
    	<a href="http://www.httx668.com" target="_blank" title="联盟首页"></a>
    </div>
</div>
<div class="main_box detail_box">
	<div class="detail_intb">
    	<div class="main_title">商品详情</div>
            <div class="goods_detail">
                    <div class="detail_img"><img src="uploads/<?php echo $sp_photo?>" /></div>
                    <div class="detail_int">
                    	<div class="goods_title"><?php echo ($sp_name) ?></div>
                        <div class="item_list">价　格：<em><?php echo ($sp_price) ?></em>&nbsp;<?php echo $sp_danwei?></div>
                        <?php echo $sp_weight ?>
                        <div class="item_list">品　牌：<?php echo ($sp_brand) ?></div>
                        <div class="item_list">生产商：<?php echo ($com_scs) ?></div>
                        <div class="item_list">供应商：<?php echo ($com_gys) ?></div>
                    </div>
                    <div class="detail_int">
                    	<div class="contact">
                        	<dl>
                            <dt>联系我们：</dt>
                            <dd>电话：021—69787960</dd>
                            <dd>传真：021—69799666</dd>
                            <dd>邮箱：chuqq@httx668.com</dd>
                            <dd>邮编：201708</dd>
                            <dd>地址：上海市青浦区芦蔡北路1888号</dd>
                            </dl> 
                        </div>
                    </div>
                </div>
                <div class="cb"></div>
              <?php 
			 if(!empty($sp_event)){?>
                <div class="detail_con">
                <h3>活动 </h3>
                <P style="text-indent:2em;"><?php echo $sp_event ?></P>
                </div>
        <?php }  ?> 
                <div class="cb"></div>
                <?php 
				$sql2="select p_pinming,p_place,p_weight,p_level,p_photos,p_miaoshu,p_id from tb_photos where `sp_id`='$sp_id' ";
				$query2=mysql_query($sql2);
				$count=mysql_num_rows($query2);
				$aa=mysql_fetch_array($query2);
				$p_miaoshu=$aa['p_miaoshu'];
				$p_photos=$aa['p_photos'];
				if($sp_yn==2&&($count)>0){
				?>
                <div class="detail_con">
                	<h3>产品规格</h3>
                    <table cellpadding="0" cellspacing="0" class="goods_tbl f_l mr10" width="49%">
                    	<tr>
                            <th>品名</th>
                            <th>原产地</th>
                            <th>重量(克)</th>
                            <th>等级</th>
                        </tr>  
                        <?php
						$sa="select p_pinming,p_place,p_weight,p_level,p_id from tb_photos where `sp_id`='$sp_id' order by p_id ";
			           	$saa=mysql_query($sa);
						for($i=1;$i<($count/2+1);$i++){
						$saq=mysql_fetch_array($saa);
						$p_pinming=$saq[0];
						$p_place=$saq[1];
						$p_weight=$saq[2];
						$p_level=$saq [3];
						$saq=mysql_fetch_array($saa);
                          ?>                   
                        <tr>
                        <td><?php echo $p_pinming ?></td>
                        <td><?php echo $p_place ?></td>
                        <td><?php echo $p_weight ?></td>
                        <td><?php echo $p_level ?></td>
                        </tr>
                        <?php }?>
                    </table>
                    <table cellpadding="0" cellspacing="0" class="goods_tbl f_l" width="49%">
                    	<tr>
                    		<th>品名</th>
                            <th>原产地</th>
                            <th>重量(克)</th>
                            <th>等级</th>
                        </tr>  
                        <?php
				        $sa1="select p_pinming,p_place,p_weight,p_level,p_id from tb_photos where `sp_id`='$sp_id' order by p_id";
				        $saa1=mysql_query($sa1);
			            for($d=1;$d<=($count/2);$d++){
			            $sqq=mysql_fetch_array($saa1);
				        $sqq=mysql_fetch_array($saa1);
				        $p_pinming=$sqq[0];
				        $p_place=$sqq[1];
				        $p_weight=$sqq[2];
				        $p_level=$sqq[3];?>
                    	<tr>
                        <td><?php echo $p_pinming ?></td>
                        <td><?php echo $p_place ?></td>
                        <td><?php echo $p_weight ?></td>
                        <td><?php echo $p_level ?></td>
                        </tr>
                      <?php }?>
                    </table>
                   </div>  
                <?php }?>
                <?php
				  $qq="select p_photos,p_miaoshu,p_id from tb_photos where sp_id='$sp_id' order by p_id";
				  $qq1=mysql_query($qq);
                  if($sp_yn==2&&mysql_num_rows($qq1)>0){
				?>
                        <div class="detail_con">
                            <h3>单品描述</h3>
                            <?php 
                            $ss=1;
                          while($aa1=mysql_fetch_array($qq1)){?>
                            <div class="img_list">
                                <img src="picture/<?php echo ($aa1['p_photos']) ?>"/>
                                <p><?php echo ($aa1['p_miaoshu']) ?></p>
                            </div>
                         <?php
						  if($ss%5==0) echo  "<div class='cb'></div>";
						   $ss++;
						  } ?>
                        </div>
            <?php } 
				  elseif($sp_yn==1&&mysql_num_rows($qq1)>0){?>
                        <div class="detail_con">
                            <h3>产品图片</h3>
                            <?php
                           while( $aa2=mysql_fetch_array($qq1)){
                          ?>
                            <div class="img_list">
                                <img src="picture/<?php echo ($aa2['p_photos']) ?>"/>
                            </div>
                           <?php  } ?>
                        </div>
 			<?php } 
				if(!empty($sp_miaoshu)&&$sp_yn==1){
					$sp_miaoshu_title = ($sp_yn==1)?"产品详情":"产品备注" //这句是为了以后如果多品礼盒也需要整体备注描述的话，将条件去掉即可。?>
                    <div class="detail_con">
                        <h3><?php echo  $sp_miaoshu_title?></h3>
                    <P style="text-indent:2em;"><?php echo  $sp_miaoshu?></P>
                    </div>
             <?php } 
			 if(!empty($com_intro)){?>
                <div class="detail_con">
                	<h3>供应商简介</h3>
                <P style="text-indent:2em;"><?php echo  $com_intro ?></P>
                </div>
        <?php }  ?> 
                <center><a href="<?php echo $_SERVER['HTTP_REFERER']?>" target="_self" class="look_btn"   onclick="javascript:history.go(-1);">返回上一级</a></center>
            </div>
	</div>
</div>
<br/>
<br/>
<br/>
<br/>
<br/>
</body>
</html>
