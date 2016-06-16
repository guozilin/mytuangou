function IsNum(num){//仅允许输入整数
	var reNum = /^\d*$/ ;
	return(reNum.test(num));
}

function checklogin(f){
	if(f.name.value==""){
		alert("请输入用户名！");
		f.name.focus();
		return false;
	}
	if(f.password.value==""){
		alert("请输入密码！");
		f.password.focus();
		return false;
	}
	if(f.gip.value==""){
		alert("请输入您的IP地址！");
		f.gip.focus();
		return false;
	}
	else{
		//var regx = /\d+\.\d+\.\d+\.\d+/; //the most simple IP test way
		var regx = /^(25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[0-9]{1,2})(\.(25[0-5]|2[0-4][0-9]|1[0-9][0-9]|[0-9]{1,2})){3}$/;
		if(!regx.test(f.gip.value)){
			alert("请输入正确的IP地址格式!");
			f.gip.value="";
			f.gip.focus();
			return false;
		}
	}
}

function type_check(f){
	if(f.leibie.value==""){
		alert("请输入类别名称！");
		f.leibie.focus();
		return false;
	}
	if(f.t_num.value==""){
		alert("请输入排序码！");
		f.t_num.focus();
		return false;
	}
	if(!IsNum(f.t_num.value)){
		alert("排序码请输入整数！");
		f.t_num.focus();
		f.t_num.value="";
		return false;
	}
	if(f.t_num.value.length>2){
		alert("排序码必须在1-99之间！");
		f.t_num.focus();
		return false;
	}
}

function com_check(f){
	if(f.com_gys.value==""){
		alert("请输入供应商名称！");
		f.com_gys.focus();
		return false;
	}
	if(f.com_intro.value==""){
		alert("请输入供应商简介！");
		f.com_intro.focus();
		return false;
	}
}

function checksp(f){
	if(isNaN(f.price1.value)){
		alert("价格请输入数字！");
		f.price1.focus();
		f.price1.value="";
		return false;
	}
	if(isNaN(f.price2.value)){
		alert("价格请输入数字！");
		f.price2.focus();
		f.price2.value="";
		return false;
	}
}
function checkspadd(f){
	ifc = 0;
	for(var i=0;i<f.sp_yn.length;i++){ 
		if(f.sp_yn[i].checked) {
			ifc = 1;
			break; 
		}	
	} 
	if(ifc==0){
		alert("请选择礼盒类别！");
		//f.sp_yn[0].focus();无法实现聚焦
		return false;
	}
	if(f.sp_name.value==""){
		alert("请输入商品名称！");
		f.sp_name.focus();
		return false;
	}
	if(f.sp_price.value==""){
		alert("请输入商品的价格！");
		f.sp_price.focus();
		return false;
	}
	if(isNaN(f.sp_price.value)){
		alert("价格请输入数字！");
		f.sp_price.value="";
		f.sp_price.focus();
		return false;
	}
	if(f.sp_class.options[f.sp_class.selectedIndex].value==""){
		alert("请选择商品类别！");
		f.sp_class.focus();
		return false;
	}
	if(f.sp_gys.options[f.sp_gys.selectedIndex].value==""){
		alert("请选择商品关联的供应商！");
		f.sp_gys.focus();
		return false;
	}
}

function IfShow(e1,e2,para){
	if(para){
		e1.style.display="";
		e2.style.display="";
	}
	else{
		e1.style.display="none";
		e2.style.display="none";
	}
}


var xmlHttp;
var ranvar=Math.random();
function GetXmlHttpObject(){  
	var xmlHttp=null;
	try {// Firefox, Opera 8.0+, Safari
	 xmlHttp=new XMLHttpRequest();
	}
	catch (e){
		 try{
	 xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
	}
	catch (e){
	  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
 }
	return xmlHttp;
}

function sendip(ip,spid){ //ajax insert ip
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null){
		 alert ("Browser does not support HTTP Request");
		 return;
	 }
	var url="tgajax.php?atype=1&randomvar="+ranvar+"&ip="+ip+"&spid="+spid;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}

function deletesql(idsstr,num){
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null){
		 alert ("Browser does not support HTTP Request");
		 return;
	 }
	var url="tgajax.php?atype=2&randomvar="+ranvar+"&idsstr="+idsstr+"&num="+num;
	xmlHttp.onreadystatechange=stateChanged; 
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}

function stateChanged() { 
	if(xmlHttp.readyState==4 || xmlHttp.readyState== "complete" ){
		//returntext=xmlHttp.responseXML;
		//returnnum=(returntext.substring(79,83));//80 81  82
		document.getElementById("mydiv").innerHTML=xmlHttp.responseText;
		$("<xml><r><rvalue></rvalue></r></xml>").find("rvalue").length;
	}
}
	//a="https://css-tricks.com/indeterminate-checkboxes/    .is(':checked'):    " ;

