/**
 * 超链接
 * @param url
 * @param title
 * @return
 */
function url(url, title){
	if(title != null){
		window.open(url, title);
	}else{
		location.href=url;
	}
}

/**
 * 用户去除搜索框的默认文字
 * @param str 默认文字
 * @param e this
 */
function clear_str(str, e){
	if($(e).val() == str){
		$(e).val('');
	}
	$(e).blur(function(){
		if($(e).val() == '')
			$(e).val(str);
	});
}

/**
 * 数据效验
 */
//短时间，形如 (13:04:06)
function is_time(str){
	var a = str.match(/^(\d{1,2})(:)?(\d{1,2})\2(\d{1,2})$/);
	if (a == null) {return false}
	if (a[1]>24 || a[3]>60 || a[4]>60)
	{
		return false;
	}
	return true;
}

//短日期，形如 (2003-12-05)
function is_date(str){
	var r = str.match(/^(\d{1,4})(-|\/)(\d{1,2})\2(\d{1,2})$/); 
	if(r==null)return false; 
	var d= new Date(r[1], r[3]-1, r[4]); 
	return (d.getFullYear()==r[1]&&(d.getMonth()+1)==r[3]&&d.getDate()==r[4]);
}

//长时间，形如 (2003-12-05 13:04:06)
function is_datetime(str){
	var reg = /^(\d{1,4})(-|\/)(\d{1,2})\2(\d{1,2}) (\d{1,2}):(\d{1,2}):(\d{1,2})$/; 
	var r = str.match(reg); 
	if(r==null) return false; 
	var d= new Date(r[1], r[3]-1,r[4],r[5],r[6],r[7]); 
	return (d.getFullYear()==r[1]&&(d.getMonth()+1)==r[3]&&d.getDate()==r[4]&&d.getHours()==r[5]&&d.getMinutes()==r[6]&&d.getSeconds()==r[7]);
}

//判断是否为正整数
function is_int(str) { 
	var patrn=/^[0-9]{1,20}$/; 
	if(patrn.exec(str))
		return true;
	return false;
}