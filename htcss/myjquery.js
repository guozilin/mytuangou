$(function(){
	$("tr:odd").addClass("odd");
	$("tr:even").addClass("even"); 
	var $tmp=$('[name=items]:checkbox');
	$("#checkedall").click(function(){
		$tmp.attr("checked", this.checked );
		var len = $("[name=items]:checkbox:checked").length;
		len>0?$('#lenid').html("你当前已选择"+len+"条").show():$('#lenid').hide();
	});
	$tmp.click(function(){
		$('#checkedall').attr('checked',$tmp.length==$tmp.filter(':checked').length);
		$('#checkedall').prop('indeterminate',$tmp.filter(':checked').length>0&&$tmp.length!=$tmp.filter(':checked').length);
		var len = $("[name=items]:checkbox:checked").length; 
		len>0?$('#lenid').html("你当前已选择"+len+"条").show():$('#lenid').hide();
	})
	$("#checkedre").click(function(){
		$tmp.each(function(){
			this.checked=!this.checked;
		});
		$('#checkedall').attr('checked',$tmp.length==$tmp.filter(':checked').length);
		$('#checkedall').prop('indeterminate',$tmp.filter(':checked').length>0&&$tmp.length!=$tmp.filter(':checked').length);
		var len = $("[name=items]:checkbox:checked").length;
		len>0?$('#lenid').html("你当前已选择"+len+"条").show():$('#lenid').hide();
	});
	$("#delete").click(function(){
		var str="";
		$("[name=items]:checkbox:checked").each(function(){
		str +=$(this).val() + ",";
		len = $("[name=items]:checkbox:checked").length;
		});
		if($("[name=items]:checkbox:checked").length==0?alert("请选择要删除的条目"):confirm("确定删除"+len+"条吗？")){
		$.get("tgajax.php" , {
			atype : 2,
			len : $("[name=items]:checkbox:checked").length,
			strs : str.substring(0, str.length - 1),
			ranvar : Math.random(),
			},function(data,textStatus){
			var numcontent = $(data).find("num n").text();
			alert("成功删除"+numcontent+"条")
			window.location.href = window.location.href;
			/*var numcontent = $(data).find("num n").text();
			if(numcontent==len){ 
				$("[name=items]:checkbox:checked").each(function(){
				n = $(this).parents("tr").index();   
				$("table").find("tr:eq("+n+")").remove();
				$('#lenid').hide();
				});
			}*/
		});
		}
	});
    $("table tr td:nth-child(3)").hover(function(e){
	  $(this).parent().addClass("over");
	  var uip=$(this).html()
	  $.getScript('http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=js&ip='+uip, function(_result){
		  var ipData = ""; //初始化保存内容变量
		  if (remote_ip_info.ret == '1'){
			  ipData += "IP 详细信息：<br>";
			  ipData += "IP：" + uip + "<br>";
			  ipData += "国家：" + remote_ip_info.country + "<br>";
			  ipData += "省份：" + remote_ip_info.province + "<br>";
			  ipData += "城市：" + remote_ip_info.city + "<br>";
			  ipData += "区：" + remote_ip_info.district + "<br>";
			  ipData += "ISP：" + remote_ip_info.isp + "<br>";
			  ipData += "类型：" + remote_ip_info.type + "<br>";
			  ipData += "其他：" + remote_ip_info.desc + "<br>";
			  $("#ip_info").html(ipData); //显示处理后的数据
			  } else  
				  alert('no IP info');
	  }); 
	  $("#ip_info").css("top",(e.pageY) + "px"); 
	  },function(){ 
	  $(this).parent().removeClass("over");
	 // $("#ip_info").fadeOut("fast"); 
	  });
$("#echoip").click(function(){
	if($("#echoip").is(":checked"))
		 $("#ip_info").fadeIn("slow"); 
	else
		 $("#ip_info").fadeOut("fast"); 	  
	});
});