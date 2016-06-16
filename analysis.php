
<?php
include("config.php");
include("function.php");
//checklogin();
//该页带参数是ok了，但是修改和删除的部分，都没有把参数带过去，导致修改或删除之后，又跳回到第一页了。要继续完善。

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>访客分析</title>
<link href="htcss/styles.css" rel="stylesheet">
<script type="text/javascript" src="htcss/function.js"></script>
<script type="text/javascript" src="htcss/jquery.1.8.2.js"></script>
<script type="text/javascript">
$(function(){
		$('.title-list li').mouseover(function(){
		var liindex = $('.title-list li').index(this);
		$(this).addClass('on').siblings().removeClass('on');
		$('.product-wrap div.product').eq(liindex).fadeIn(150).siblings('div.product').hide();
		var liWidth = $('.title-list li').width();
		$('.contain .title-list p').stop(false,true).animate({'left' : liindex * liWidth + 'px'},300);
	});
	
	//设计案例hover效果
	$('.product-wrap .product li').hover(function(){
		$(this).css("border-color","#0ea3aa");
		$(this).find('p > a').css('color','#0ea3aa');
	},function(){
		$(this).css("border-color","#fafafa");
		$(this).find('p > a').css('color','#666666');
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
    	<div class="f_l">访问分析</div>
        <div class="f_r"></div>
    </div>
  	
    <div class="contain">
  <div class="title cf">
    <ul class="title-list fr cf ">
      <li class="on">访问次数</li>
      <li>访问来源地</li>
      <li>访问区域</li>
      <li>分析1</li>
      <li>分析2</li>
      <p><b></b></p>
    </ul>
  </div>
  <div class="product-wrap">
    <!--分析1-->
    
    <div class="product show">
    <table width="100%" border="1">
      <tr>
        <td>序号</td>
        <td>日期</td>
        <td>访问次数</td>
      </tr>
     <?php 
	 	$startime='2015-09-01';
		$endtime='2022-12-30';
		$num=0;
	 	$sql="SELECT id,DATE_FORMAT(time,'%Y-%m-%d') AS day,COUNT(id) as numcount FROM tb_viewcount where time BETWEEN '$startime' AND '$endtime' GROUP BY day order by day desc limit 30";
		$query=mysql_query($sql);
		while($row=mysql_fetch_array($query)){
			$numcount=$row['numcount'];
			$day=$row['day'];
			$num =$num+1;
			//$time=floor(strtotime($row['time'])/86400);
			//$id=$row['id'];
			
	 ?>
     
      <tr>
        <td><?php echo $num ?></td>
        <td><?php echo $day ?></td>
        <td><?php echo $numcount ?></td>
      </tr>
      <?php } ?>
    </table>
     
    </div>
    <!--分析2-->
    <div class="product">
		 <p style="font-size:20px;font-family:'Comic Sans MS', cursive, '微软雅黑'; color:#69BC95; text-align:center;">正在建设中......</p>
    </div>
    <!--分析3-->
    <div class="product">
	 <p style="font-size:20px;font-family:'Comic Sans MS', cursive, '微软雅黑'; color:#69BC95; text-align:center;">正在建设中......</p>
    </div>
    <!--分析4-->
    <div class="product">
    <p style="font-size:20px;font-family:'Comic Sans MS', cursive, '微软雅黑'; color:#69BC95; text-align:center;">正在建设中......</p>
    </div>
    <!--分析5-->
    <div class="product">
      <p style="font-size:20px;font-family:'Comic Sans MS', cursive, '微软雅黑'; color:#69BC95; text-align:center;">正在建设中......</p>
    </div>
  </div>
</div>
	</div>
</div>

</body>
</html>