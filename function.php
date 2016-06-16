<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></mate>
<?php
function PageTop(){
	echo "<div class='main_w head'>\n";
	echo "  <div class=f_l>团购管理后台系统</div>\n";
	echo "  <div class=f_r><b><font color=red>".$_SESSION['name']."</font>，欢迎您团购后台管理系统！</b>&nbsp;&nbsp;&nbsp;&nbsp;<a href='login.php?action=logout'>退出登录</a></div>\n";
	echo "</div>\n"; 
}

function checklogin(){
	session_start();
	if(empty($_SESSION['name'])){
		echo "<script language=JavaScript com=text/javascript>\n alert('".tip_list(1,1,19)."');\n self.location = 'denglu.html';\n </script>\n";
		exit;
	}
	elseif(empty($_SESSION['legalIP'])){
		echo "<script language=JavaScript com=text/javascript>\n alert('".tip_list(1,1,18)."');\n self.location = 'denglu.html';\n </script>\n";
		exit;
	}
}

function checkspid($para){
	$sql="select sp_id from tb_shangpin where sp_id = ".$para;
	$query=mysql_query($sql);
	if(mysql_num_rows($query)==0)
		return false;
	else
		return true;
}

function checkIP($ipfrom){
	$xml_array=simplexml_load_file('ip_analysis.xml'); //将XML中的数据,读取到数组对象中 
	foreach($xml_array as $tmp){ 
		$ip= $tmp->ip;
		if($ip==$ipfrom){
			return true;
			exit;//退出程序，break只是退出循环
		}
	}
	return false;
}

function insertIp($ip,$para){
	if(!checkIP($ip)){//当访客IP不存在合法IP地址列表时
		$sql="select ip,time,pageurl from tb_viewcount where ip=\"".$ip."\" and pageurl=".$para." and TO_DAYS(NOW()) - TO_DAYS(time) < 1 ";//同IP，来源和当日的访客不予登记
		$query=mysql_query($sql);
		if(mysql_num_rows($query)==0){
			$sqll = "insert into tb_viewcount (ip,pageurl,time) values ('$ip','$para',now())";
			mysql_query($sqll);
		}
	}
}

function checksp($cc){
	$sql="select sp_id,sp_name from tb_shangpin where sp_id = $cc ";
	$query=mysql_query($sql);
	if(mysql_num_rows($query)!=0)
		$row=mysql_fetch_array($query);
		return $row['sp_name'];
}

function selectIP($ipc,$n){
	$sql="select cat_name,cat_id from tb_area where cat_id ='$ipc' and cat_type='$n'";
	$query=mysql_query($sql);
	if(mysql_num_rows($query)!=0)
		$row=mysql_fetch_array($query);
		return $row['cat_name'];
	}


function leftpage(){
	echo "<div class=left>\n";
	echo "	<dl>\n";
	echo "    	<dt>后台菜单</dt>\n";
	echo "        <dd id='dd1'><a href='type_index.php'>品类管理</a></dd>\n";
	echo "        <dd id='dd3'><a href='com_index.php'>供应商信息管理</a></dd>\n";
	echo "        <dd id='dd4'><a href='sp_index.php'>商品管理</a></dd>\n";
	echo "        <!--<dd><a href='login.php?action=logout'>退出登录</a></dd> -->\n";
	echo "    	<dt>数据分析</dt>\n";
	echo "        <dd id='dd5'><a href='visitor.php'>访问记录</a></dd>\n";
	echo "        <dd id='dd2'><a href='#'>地区管理</a></dd>\n";
	echo "        <dd id='dd6'><a href='analysis.php'>访客分析</a></dd>\n";
	echo "    </dl>\n";
	echo "</div>\n";
}

function unit_list($para_num){
	switch ($para_num){
		case 1:
		  return "元/盒";
		  break;
		case 2:
		  return "元/吨";
		  break;
		case 3:
		  return "元/千克";
		  break;
		case 4:
		  return "元/箱";
		  break;
		case 5:
		  return "元/袋";
		  break;
		case 6:
		  return "元/提";
		  break;
		case 7:
		  return "元/罐";
		  break;
		case 8:
		  return "元/瓶";
		  break;
		case 9:
		  return "元/枚";
		  break;
		case 10:
		  return "元/包";
		  break; 
		case 11:
		  return "元/篮";
		  break; 
		case 12:
		  return "元/听";
		  break; 
		case 13:
		  return "元/筒";
		  break; 
		case 14:
		  return "元/杯";
		  break;
		case 15:
		  return "元/桶";
		  break; 
		default:
		  return "No unit";
	}
}

function tip_list($a,$b,$para_num){
	if($a==$b){
		switch ($para_num)
		{
		case 1:
		  return " selected";
		  break;
		case 2:
		  return " checked";
		  break;
		case 3:
		  return "类别添加成功！";
		  break;
		case 4:
		  return "类别修改成功！";
		  break;
		case 5:
		  return "请首先删除引用该类别的商品！";
		  break;
		case 6:
		  return "类别删除成功！";
		  break;
		case 7:
		  return "供应商添加成功！";
		  break;
		case 8:
		  return "供应商修改成功！";
		  break;
		case 9:
		  return "请首先删除引用该供应商的商品！";
		  break;
		case 10:
		  return "供应商删除成功！";
		  break; 
		case 11:
		  return "商品新建成功！";
		  break; 
		case 12:
		  return "商品修改成功！";
		  break; 
		case 13:
		  return "商品删除成功！";
		  break; 
		case 14:
		  return "类别已存在！";
		  break; 
	    case 15:
		  return "供应商已存在！";
		  break; 
		case 16:
		  return "单品图文更新成功！";
		  break; 
		case 17:
		  return "单品图文删除成功！";
		  break; 
		case 18:
		  return "非法的登录IP地址！";
		  break; 
		case 19:
		  return "错误的用户名或者密码！";
		  break; 
		case 20:
		  return "成功退出登录！";
		  break; 
		case 21:
		  return " class=\"on\" ";
		  break; 
		case 22:
		  return "错误的文件类型，值允许jpg,gif,png为扩展名的图片上传！";
		  break; 
		default:
		  return "No tips :( ).";
		}
	}
}

function checkIfSame($value1,$field1,$table1){
	$sql="select $field1 from $table1 where $field1='$value1'";
	//echo $sql;
	$rs=mysql_query($sql);
	return mysql_num_rows($rs);
}

function SelectOptsList($f1,$f2,$table,$ischeck){//f1 is id,f2 is value.
	$sql="select ".$f1." f1,".$f2." f2 from ".$table;
	//echo $sql;
	$query=mysql_query($sql);
	while($rs=mysql_fetch_array($query))
		echo "<option value=".$rs['f1'].tip_list($rs['f1'],$ischeck,1).">".$rs['f2']."</option> \n";
}

function SelectOp($f1,$f2,$table,$ischeck,$f3){//f1 is id,f2 is value.
	$sql="select ".$f1." f1,".$f2." f2 from ".$table." where cat_type='$f3' ";
	echo $sql;
	$query=mysql_query($sql);
	while($rs=mysql_fetch_array($query))
		echo "<option value=".$rs['f1'].tip_list($rs['f1'],$ischeck,1).">".$rs['f2']."</option> \n";
}

 /*
调用$page=page(100,10,5)
返回值 array ('limit','html')
参数说明
$count总数量
$page_size每页显示的数量
$num_btn 要展示的页码按钮数目
$page分页的get参数 
 */
function page($count,$page_size,$num_btn=10,$page='page'){
  if(!isset($_GET[$page])||!is_numeric($_GET[$page])||$_GET[$page]<1){
		 $_GET[$page]=1;
	 }
	$page_num_all=ceil($count/$page_size);//总页数
	if($_GET[$page]>$page_num_all){
		$_GET[$page]=$page_num_all;
	}
	$start=($_GET[$page]-1)*$page_size;
	$limit="limit {$start},{$page_size}";
	//echo $limit;
	$current_url=$_SERVER['REQUEST_URI'];//拆分url到数组里面
	$arr_current=parse_url($current_url);
	$current_path=$arr_current['path'];
	//var_dump($arr_current);
	if (isset($arr_current['query'])){
		parse_str($arr_current['query'],$arr_query);
		unset($arr_query[$page]);
        //var_dump($arr_query);
		if(empty($arr_query)){
			$url="{$current_path}?{$page}=";
		}else{
			$other=http_build_query($arr_query);
			$url="{$current_path}?{$other}&{$page}=";
		}
	}else{$url="{$current_path}?{$page}=";	
	}
	//var_dump($url);
	$html=array();
	if($num_btn>=$page_num_all){
		//把所有页码数量显示
		for($i=1;$i<=$page_num_all;$i++){//$i既是控制循环次数以控制按钮显示数目的变量，也是记录页码号
			if($_GET[$page]==$i){
				$html[$i]="<span>{$i} </span>";
			}else{
			$html[$i]="<a href='{$url}{$i}'>{$i} </a>";
			}
	   }	
	}
	else{
		$num_left=floor(($num_btn-1)/2);
		$start=$_GET[$page]-$num_left;
		$end=$start+($num_btn-1);//结束按钮号
		if($start<1){
			$start=1;
		}else if($end>$page_num_all){
				$start=$page_num_all-($num_btn-1);
		}
			
		for($i=0;$i<$num_btn;$i++){
		    if($_GET[$page]==$start){
				$html[$start]="<span>{$start} </span>";
				}else{
				 $html[$start]="<a href='{$url}{$start}'>{$start} </a>";
				}
				$start++;		
		     }
			if(count($html)>=3){
				reset($html);
			    $key_first=key($html);
			    end($html);
			    $key_end=key($html);
			if($key_first!=1){
			   array_shift($html);
			   array_unshift($html,"<a href='{$url}1'>1</a>...");
			}
			if($key_end!=$page_num_all){
			   array_pop($html);
			   array_push($html,"...<a href='{$url}{$page_num_all}'>{$page_num_all}</a>");
				 }
			 }
	      }
	   if($_GET[$page]!=1){
		   $prev=$_GET[$page]-1;
		  if($prev>-1) array_unshift($html,"<a href='{$url}{$prev}'><<</a>");  
	   }
	   if($_GET[$page]!=$page_num_all){
		   $next=$_GET[$page]+1;
		  array_push($html,"<a href='{$url}{$next}'>>></a>");  
	   }
	  $html=implode('',$html);
	  $showcount = $count>0?"共<b>".$count."</b>条":"";
	  $data=array(
	  'limit'=>$limit,
	  'html'=>$html."&nbsp;&nbsp;&nbsp;&nbsp;".$showcount);
	  return $data;
 }
   /* $page=page(100,1,4);
   echo $page['html'];*/
?>