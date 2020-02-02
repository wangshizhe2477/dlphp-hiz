<?php
/**
 * 加密
 */
function encrypt($str) {
	return md5 ( $str );
}
/**
 * 上一页URL
 */
function lastUrl() {
	return $_SERVER ['HTTP_REFERER'];
}
/**
 * 页面重定向，可以输出是否
 *
 * @param string $url
 * @param booble $b
 * @param string $alert
 */
function cScript($url, $b, $alert = '') {
	if ($b)
		js_alert ( $alert . '成功', $url );
	else
		js_alert ( $alert . '失败', $url );
}

/*当前时间，插入数据库时使用*/
function dbOfDate() {
	return date ( 'Y-m-d H:i:s' );
}

/*
* 随机生成文件名
*/
function r_filename() {
	return date ( 'ymdHis' ) . rand ( 100, 999 );
}
/**
 * 删除HTML
 */
function delete_htm($scr) {
	$str = '';
	for($i = 0; $i < strlen ( $scr ); $i ++) {
		if (substr ( $scr, $i, 1 ) == "<") {
			while ( substr ( $scr, $i, 1 ) != ">" )
				$i ++;
			$i ++;
		}
		$str = $str . substr ( $scr, $i, 1 );
	}
	return $str;
}
/* 去除js */
function clear_js($str) {
	$str = preg_replace ( "'<script[^>]*?>'", '', $str );
	$str = preg_replace ( "'</script[^>]*?>'", '', $str );
	return $str;
}

/**
 * 查询目录下所有文件
 */
function show_dir($dir) {
	$fis = array ();
	if (is_dir ( $dir )) {
		$dh = opendir ( $dir );
		if ($dh) {
			while ( ($file = readdir ( $dh )) !== false ) {
				if ($file != "." && $file != "..")
					array_push ( $fis, $file );
			}
			closedir ( $dh );
		}
	}
	return $fis;
}

/**
 * 把任何字符串类型都转化没utf-8
 */
function str_get_utf8($data) {
	$encode_arr = array ("ASCII", "CP936", "GBK", "GB2312", "BIG5", "ISO-8859-1", "JIS", "eucjp-win", "sjis-win", "EUC-JP", "UTF-8" );
	$encoded = mb_detect_encoding ( $data, $encode_arr );
	return mb_convert_encoding ( $data, 'utf-8', $encoded );
}

/* --------------------限制与具体架构中的通用函数------------------------ */
/**
 * 获取数据层类
 * 有model则加载，没有加载base类
 * m('goodsCate')对应goods_cate表
 * 不涉及多表级联不需要创建model类
 */
function m($ado) {
	if (file_exists ( APP . 'model' . DS . $ado . '.php' ))
		return FLEA::getSingleton ( 'model_' . $ado );
	$find = array ('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z' );
	$replace = array ('_a', '_b', '_c', '_d', '_e', '_f', '_g', '_h', '_i', '_j', '_k', '_l', '_m', '_n', '_o', '_p', '_q', '_r', '_s', '_t', '_u', '_v', '_w', '_x', '_y', '_z' );
	return new model_base ( array ('tableName' => str_replace ( $find, $replace, $ado ) ) );
}
/* ***************************** 逻辑封装 ***************************** */
/**
 * 图片上传
 * @param string $photoName 图片名称
 * @param string $formName 表单获取值
 * @param string $returnNull 是否上传图片失败返回空值
 * @return 成功返回图片名称 失败返回null
 */
function upload_photo($photoName = null, $formName = 'photo', $ext = 'jpg', $returnNull = false) {
	if ($photoName == null) {
		$dir = date ( 'Ymd' );
		$photoName = $dir . '/' . date ( 'His' ) . rand ( 100, 999 ) . '.' . $ext;
	} else
		$dir = substr ( $photoName, 0, 8 );
	
	if (! is_dir ( UPLOAD . $dir )) //创建目录
		mkdir ( UPLOAD . $dir );
	
	$uploader = new fileUploader ();
	if ($uploader->isFileExist ( $formName )) {
		$photo = $uploader->getFile ( $formName );
		if (! empty ( $photo )) {
			$photo->move ( UPLOAD . $photoName );
			return $photoName;
		}
	}
	if ($returnNull)
		return null;
	return $photoName;
}
/**
 * 删除文件
 * @param string $file_name 文件名
 */
function remove_photo($file_name) {
	unlink ( UPLOAD . $file_name );
}

class WSZ_Date {
	/**
	 * 根据字符串截取
	 */
	function strGetYear($str) {
		return substr ( $str, 0, 4 );
	}
	function strGetMonth($str) {
		return substr ( $str, 5, 2 );
	}
	function strGetDay($str) {
		return substr ( $str, 8, 2 );
	}
	/**
	 * 与当前时间所差的天数
	 */
	function lessDayForNow($date) {
		return (strtotime ( date ( "Y-m-d H:i:s" ) ) - strtotime ( $date )) / 86400;
	}
}

/* ***************************** validate start ***************************** */
/**
 * 是否是日期
 */
function is_date($ymd, $sep = '-') {
	if (empty ( $ymd ))
		return false;
	list ( $year, $month, $day ) = explode ( $sep, $ymd );
	return checkdate ( $month, $day, $year );
}

/**
 * 是否是EMAIL
 */
function is_email($email) {
	return strlen ( $email ) > 6 && preg_match ( "/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/", $email );
}

//验证手机号码
function is_mobile($mobilephone) {
	if (preg_match ( "/^13[0-9]{1}[0-9]{8}$|15[03189]{1}[0-9]{8}$|18[0-9]{1}[0-9]{8}$/", $mobilephone ))
		return true;
	return false;
}

//验证电话号码
function is_phone($phone) {
	if (preg_match ( '/^((\(\d{2,3}\))|(\d{3}\-))?(\(0\d{2,3}\)|0\d{2,3}-)?[1-9]\d{6,7}(\-\d{1,4})?$/', $phone ))
		return false;
	return true;
}

//验证邮编
function is_zipcode($zipcode) {
	if (preg_match ( '/^([0-9]{5})(-[0-9]{4})?$/i', $zipcode ))
		return true;
	return false;
}

//验证URL
function is_url($url) {
	if (preg_match ( '/^http\:\/\/[_a-zA-Z0-9-]+(.[_a-zA-Z0-9-]+)*$/', $url ))
		return true;
	return false;
}
/* ***************************** validate end ***************************** */

/* ***************************** csv start ***************************** */
/**
 * csv_output
 * $title "id,areaCode,areaName"
 * $data array()
 */
function csv_output($title, $data){
	header("Content-Type: text/csv");
	header("Content-Disposition: attachment; filename=test.csv");
	header('Cache-Control:must-revalidate,post-check=0,pre-check=0');
	header('Expires:0');
    header('Pragma:public');
	echo iconv( "UTF-8", "gbk", $title) . "\n";
	foreach($data as $values){
		$output_data = '';
		foreach($values as $value){
			$output_data .= iconv( "UTF-8", "gbk", $value) . ',';
		}
		if($output_data != '')
			$output_data = substr($output_data, 0, strlen($output_data) - 1);
		$output_data .= "\n";
		echo $output_data;
	}
}
/**
 * csv_input
 * $title "id,areaCode,areaName"
 * $data array()
 */
function csv_input($formName = 'file'){
	$file = $_FILES [$formName];
	$file_type = substr ( strstr ( $file ['name'], '.' ), 1 );
		
	// 检查文件格式
	if ($file_type != 'csv') {
		js_alert('文件格式不对,请重新上传!', lastUrl());
	}
	$handle = fopen ( $file ['tmp_name'], "r" );
	$file_encoding = mb_detect_encoding ( $handle );
	
	// 检查文件编码
	if ($file_encoding != 'ASCII')
		js_alert('文件编码错误,请重新上传!', lastUrl());
	$row = 0;
	$result = array();
	while ( $data = fgetcsv ( $handle, 1000, ',' ) ) {
		$row ++;
		if ($row == 1)
			continue;
		foreach($data as $key => $value)
			$data[$key] = iconv ( "gbk", 'utf-8', $value );
		array_push($result, $data);
	}
	fclose ( $handle );
	return $result;
}
/* ***************************** csv end ***************************** */
