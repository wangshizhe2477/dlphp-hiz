/**
 * jquery-hiz 0.1.2
 * Shall not be used without permission communication.
 * Copyright (c) 2009-2012 dlphp.com
 * @author Wang Shizhe
 * jquery ext
 */

//初始化验证表单
$(function(){
	//cForm表单ID， cSubmit提交按钮ID
	$.validate('cForm', 'cSubmit');
});

$.extend({
	
	/* ---------------------------- validate start ---------------------------- */
	/**
	 * 表单自动效验
	 * cForm表单ID， cSubmit提交按钮ID
	 * $.validate('cForm', 'cSubmit');
	 * 
	 * <form id="cForm" action="" method="post">
	 * <input name="name" title="name" type="text" check='notEmpty|mail'/><br/>
	 * <textarea id="content" name="content" rows="20" cols="100" check='notEmpty|int'></textarea>
	 * <input id="cSubmit" type="submit" value="submit"/>
	 * </form>
	 * 
	 * 支持效验方法：
	 * notEmpty|mail|int|float|tel|qq|min_10|max_50|file_img|url
	 */
	validate: function(formId, submitId){

		var cform = $('#' + formId);//form元素
		var submitId = submitId;//提交按钮ID
	
		//验证表单入库
		if(cform.size() > 0){
			var formSubmit = false;
			//禁止form提交
			cform.submit( function () {
				if(formSubmit){
					cform.find('#' + submitId).attr('disabled', 'disabled');
					cform.find('#' + submitId).val(cform.find('#' + submitId).val() + '...');
				}
				return formSubmit;
			});
			//form提交按钮
			cform.find('#' + submitId).click(function(){
				var cfe = checkFormElement();
				if(cfe == true){
					formSubmit = true;
				}
			});
		}
	
		//遍历需要效验的表单
		checkFormElement = function(){
			var resultRet = true;
			var datas = cform.find("input, select, textarea");
			$.each(datas, function(k, v){
				var checkFun = $(v).attr('check');
				if(typeof(checkFun) != "undefined"){
					resultRet = checkFactory(checkFun, $(v).val());
					if(resultRet != true){
						alert($(v).attr('title') + resultRet);
						$(v).focus();
						return false;
					}
				}
			});
			return resultRet;
		};
	
		//验证工厂
		checkFactory = function(checkFun, value){
			var resultRet = true;
			var checks = checkFun.split('|');
			$.each(checks, function(k, c){
				var v = funNameFormat(c, 0);
				
				resultRet = eval("check_" + v + "('" + value + "', '" + funNameFormat(c, 1) + "')");
				if(resultRet != true)
					return false;
			});
			return resultRet;
		};
	
		//验证方法 start
	
		//验证空
		check_notEmpty = function(str){
			if(str == '')
				return '不能为空';
			return true;
		};
	
		//验证邮箱
		check_mail = function(str){
			if(str != ''){
				var myreg = /^[a-z0-9._%-]+@[a-z0-9.-]+\.[a-z]{2,4}$/i;
				if(!myreg.test(str))
					return '格式不正确';
				return true;
			}
			return true;
		};
	
		//判断是否为正整数
		check_int = function(str) { 
			if(str != ''){
				var patrn = /^[0-9]{1,20}$/; 
				if(patrn.exec(str))
					return true;
				return '必须为整数';
			}
			return true;
		};
		
		//正浮点数
		check_float = function(str){
			if(str != ''){
				//		var patrn = /(^[1-9]\\d*.\\d*|0.\\d*[1-9]\\d*$)/; 
				//			if(patrn.exec(str))
				//			return true;
				//			return '必须为数字';
			}
			return true;
		};
	
		//验证电话
		check_tel = function(str){
			if(str != ''){
				var pattern = /(^[0-9]{3,4}\-[0-9]{3,8}$)|(^[0-9]{3,8}$)|(^\([0-9]{3,4}\)[0-9]{3,8}$)|(^0{0,1}13[0-9]{9}$)/; 
				if(pattern.test(str))
					return true; 
				return '格式不正确';
			}
			return true;
		};
	
		//验证qq
		check_qq = function(str){
			if(str != ''){
				var pattern = /(^[1-9]*[1-9][0-9]*$)/; 
				if(pattern.test(str))
					return true; 
				return '格式不正确';
			}
			return true;
		};
		
		//最小长度
		check_min = function(str, length){
			if(str.length < length)
				return '长度不能小于' + length;
			return true;
		};
	
		//最大长度
		check_max = function(str, length){
			if(str.length > length)
				return '长度不能大于' + length;
			return true;
		};
	
		//文件上传 type:img暂时只封装图片
		check_file = function(str, type){
			var re = /(\\+)/g; 
			var filename = str.replace(re,"#");
			var one = filename.split("#");
			var two = one[one.length-1];
			var three = two.split(".");
			var last = three[three.length-1];
			var tp = '';
			if(type == 'img')
				tp = "jpg,gif,png,bmp,JPG,GIF,PNG,BMP";
			else
				return '系统不支持格式';
			var result = tp.indexOf(last.toLowerCase( ));
			if(result > -1)
				return true;
			return '格式不正确';
		};
		
		//url
		check_url = function(str){
			if(str != ''){
				var pattern = /^(http|https|ftp)\:\/\/[a-z0-9\-\.]+\.[a-z]{2,3}(:[a-z0-9]*)?\/?([a-z0-9\-\._\?\,\'\/\\\+&%\$#\=~])*$/i; 
				if(pattern.test(str))
					return true; 
				return '格式不正确';
			}
			return true;
		};
		//验证方法 end
	
		//字符串根据"_"转数据
		funNameFormat = function(str, n){
			var reArray = str.split('_');
			return reArray[n];
		};
	},
	/* ---------------------------- validate end ---------------------------- */

	/* ---------------------------- totop start ---------------------------- */
	/**
	 * 返回顶部
	 * $.totop();
	 */
	totop: function(){
		function toTopHide(){
			document.documentElement.scrollTop+document.body.scrollTop>400?document.getElementById("toTop").style.display="block":document.getElementById("toTop").style.display="none";
		}
		$(window).scroll( function() {
			toTopHide();
		});
		
		var style = '<style>';
		style += '#toTop {width: 54px;height: 54px;display: block;position: fixed;right: 25px;bottom: 45px;background-image: url(img/sys/return_top.png);opacity: 0.6;filter: alpha(opacity=60);display:none;}';
		style += '#toTop:HOVER {opacity: 1;filter: alpha(opacity=100);}';
		style += '</style>';
		$('body').append(style);
		$('body').append('<a href="#" target="_self" id="toTop" title="返回顶部" onclick="window.scrollTo(0,0);return false"></a>');
	},
	/* ---------------------------- totop end ---------------------------- */
	
	/* ------------------------------------ 无缝滚动 start ------------------------------------ */
	/**
	 * 无缝滚动-向左
	 * $.marqueeLeft('context', 30);
	 * id div id
	 * speed 滚动速度
	 */
	marqueeLeft: function(id, speed){
		speed = (speed) ? speed : 30;
		var context = $('#' + id);
		var in_id = id + '_textin';
		var text1_id = id + '_text1';
		var text2_id = id + '_text2';
		//定义样式
		context.css("overflow", "hidden");
		//存储原始数据
		var html_date = context.html();
		//重构context
		context.html("<div id='" + in_id + "' style='width: 800%;'><div id='" + text1_id + "' style='float: left;'>" + html_date + "</div><div id='" + text2_id + "' style='float: left;'>" + html_date + "</div><div style='clear:both;'></div></div>");
		//滚动触发函数
		function marquee_run(){
			//如果不超过正常宽度，充斥内容不显示
			if($('#' + text1_id).width() < context.width())
				$('#' + text2_id).html("");
			
			if($('#' + text2_id).width() - context.scrollLeft() <= 0)
				context.scrollLeft(context.scrollLeft() - $('#' + text1_id).width());
			else
				context.scrollLeft(context.scrollLeft() + 1);
		}
		//启动定时任务
		var inter = setInterval(marquee_run, speed);
		//触摸停止
		context.hover(
			function () {
				clearInterval(inter);
			},
			function () {
				inter = setInterval(marquee_run, speed);
			}
		);
	},
	
	/**
	 * 无缝滚动-向上/向下
	 * $.marqueeTop('context', 30);
	 * id div id
	 * speed 滚动速度
	 */
	marqueeTop: function(id, speed){
		speed = (speed) ? speed : 20;
		var context = $('#' + id);
		context.css("overflow", "hidden");
		
		var html_data = context.html();

		var text1_id = id + '_text1';
		var text2_id = id + '_text2';

		context.html('<div id="' + text1_id + '">' + html_data + '</div><div id="' + text2_id + '">' + html_data + '</div>');
		function marquee_run(){
			if($('#' + text1_id).height() - (context.scrollTop() + context.height() - $('#' + text1_id).height()) <= 0)
				context.scrollTop(0);
			else
				context.scrollTop(context.scrollTop() + 1);
		}
		var inter = setInterval(marquee_run,speed);//设置定时器
		
		context.hover(
			function () {
				clearInterval(inter);
			},
			function () {
				inter = setInterval(marquee_run, speed);
			}
		);
	}
	/* ------------------------------------ 无缝滚动 end ------------------------------------ */

});
