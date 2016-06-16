<?php
include("config.php");
include("function.php");
checklogin();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>访客分析</title>
<link href="htcss/styles.css" rel="stylesheet">
<script type="text/javascript" src="htcss/jquery.1.8.2.js"></script>
<script type="text/javascript" src="htcss/function.js"></script>
<script type="text/javascript" src="htcss/myjquery.js"></script>
<script type="text/javascript">
$(function(){
	$("#ip").click(function(){
		$("table tr td:nth-child(3)").each(function(){ 
		var ipid=$(this).siblings().find("input").val();
		var uip=$(this).html();
	 /* if(uip.length>15){
		  var arr=new Array();
		  arr=uip.split('|');
		  for(var i=0;i<arr.length;i++){
			  var uip=arr[1];
			}
	  }*/
	$.getScript('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip='+uip, function(_result){
		  var ipData = ""; //初始化保存内容变量
		  ip.country=remote_ip_info.country;
		  ip.province=remote_ip_info.province;
		  ip.city=remote_ip_info.city;
		$.get("tgajax.php" , {
			atype : 6,
			id : ipid,
			country : ip.country,
			province :  ip.province,
			city : ip.city,
			ranvar : Math.random(),
			},function(data){
				//alert(data);
				})
		});
	})
	})
});

</script>
</head>
<body>
<?php PageTop();?>
<div class="main_w">
<?php leftpage();?>
  <div class="right">
    <div class="right_tit">
      <div class="f_l">访客分析</div>
      <div class="f_c" id="lenid" style="display:none"></div>
      <div class="f_r">
        <input type="submit" id="ip" class="submit" value="ip"  />&nbsp;&nbsp;
       <input type="checkbox"  id="echoip" value="全选"/>显示IP&nbsp;&nbsp;
        <input name="按钮" type="button" class="submit" id="checkedre" value="反选" />&nbsp;&nbsp;
        <input type="submit" id="delete" class="submit" value="删除"  />&nbsp;&nbsp;
      </div>
    </div>
    
  <table cellspacing="0" cellpadding="0" class="main_tbl">
<?php 
	$pageurl="";
	$ip="";
	$time="";
	$spid="";
	$pagesize1 = 100;  //每页要显示的条数
if(($_GET[page])==""){  //判断当前page值是否为0，如果为0，则赋值page为1，
    $page1=1;
 	}else{$page1=intval($_GET[page]);//防止page前有空格，
}
	$sqq="select pageurl from tb_viewcount";
	$aqs=mysql_query($sqq);
	$count=mysql_num_rows($aqs);
	//$sss="select A.id,A.pageurl,A.ip,A.time,A.ip_province,A.ip_city,B.cat_name,B.cat_id from tb_viewcount A inner join tb_area B on A.ip_province=B.cat_id order by time desc limit ".($page1-1)*$pagesize1.",".$pagesize1."";
	//$aaa=mysql_query($sss);
	$sss1="select id,pageurl,ip,time,ip_province,ip_city from tb_viewcount order by time desc limit ".($page1-1)*$pagesize1.",".$pagesize1."";
	$aaa1=mysql_query($sss1);
?>      
	 <tr>
            <th width="10%"><input type="checkbox"  id="checkedall" value="全选"/>全选</th>
            <th width="25%">访问源</th>
            <th width="24%">IP地址</th>
            <th width="18%">IP来源</th>
            <th width="23%">访问时间</th>
     </tr>
      <?php while($row=mysql_fetch_array($aaa1)){
		  	$id=$row['id'];
			$ip_city=$row['ip_city'];
			$ip_province=$row['ip_province'];
			$pageurl =  $row['pageurl']==0?"团购首页":"<a href='detail.php?detail=".$row['pageurl']."'>".checksp($row['pageurl'])."</a>";
			$ip=strlen($row['ip'])>20?iconv_substr(stristr($row['ip'],'|',false),1,20,'utf-8'):$row['ip'];
			$time=$row['time']; 
			$cat_name= (empty($ip)?"未知":($ip_province==9999?"国外":selectIP($ip_province,0).",".selectIP($ip_city,1)));//

	?>
     <tr>
            <td><input type="checkbox" name="items" value="<?php echo $id ?>"/>&nbsp;&nbsp;<?php echo $id ?></td>
            <td><?php echo $pageurl?></td>
            <td><?php echo $ip ?></td>
            <td><?php echo $cat_name?></td>
            <td><?php echo $time ?></td>
     </tr>
      <?php }?>
 </table>
    <div id="ip_info"></div>
  <div class="page">
<?php  $page=page($count,$pagesize1);
		 echo $page['html'];
?> 
 
  </div>
 </div>
</div>
</body>
</html>
