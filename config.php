<?php
	error_reporting(E_ALL & ~E_NOTICE);
	//这句话表示提示除去 E_NOTICE 之外的所有错误信息，对于post之前的空数组，显示字段的值得空数组等错误信息，都可以屏蔽掉。否则就会出现：没有申明$_POST['submit']之类的错误。
    $db_host = '127.0.0.1';
    $db_user = 'root';
    $db_pass = 'tuangou123'; //YL is tuangou123
    $db_name = 'tuangou';
	$con=mysql_connect($db_host,$db_user,$db_pass) or die("数据库连接出错!");
	@mysql_select_db($db_name)or die("db链接失败");
	mysql_query("set names 'utf8' "); 
	mysql_query("set character_set_client=utf8"); 
	mysql_query("set character_set_results=utf8"); 

/* another way to connect db
 @mysql_connect("localhost:3306","root","root")or die("mysql连接失败");
 @mysql_select_db("tuangou")or die("db链接失败");
*/
?> 
