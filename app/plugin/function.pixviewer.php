<?php
/**
 * 幻灯片
 * $params['type'] 幻灯片类型
 * $params['width'] 宽度
 * $params['height'] 高度
 * $params['dc_id']
 */
function smarty_function_pixviewer($params, &$smarty) {
	$dc_id = $params ['dc_id'];
	$array = array ();
	if ($dc_id != null)
		$array ['dc_id'] = $dc_id;
	$dis = m ( 'dimg' )->findAll ( $array, 'sort_order' );
	
	echo "<script type='text/javascript'>";
	echo "var focus_width{$dc_id}={$params['width']};";
	echo "var focus_height{$dc_id}={$params['height']};";
	echo "var text_height{$dc_id}=0;";
	echo "var swf_height{$dc_id} = focus_height{$dc_id}+text_height{$dc_id};";
	echo "var pics{$dc_id}='';";
	echo "var links{$dc_id}='';";
	echo "var texts{$dc_id}='';";
	foreach ( $dis as $value ) {
		echo "pics{$dc_id}+='|upload/{$value['photo']}';";
		$value['url'] = str_replace("&amp;", "&", $value['url']);
		echo "links{$dc_id}+='|' + escape('{$value['url']}');";
		echo "texts{$dc_id}+='|{$value['name']}';";
	}
	echo "document.write('<embed src=\"swf/pixviewer.swf\" wmode=\"opaque\" FlashVars=\"pics='+pics{$dc_id}.substring(1)+'&links='+links{$dc_id}.substring(1)+'&texts='+texts{$dc_id}.substring(1)+'&borderwidth='+focus_width{$dc_id}+'&borderheight='+focus_height{$dc_id}+'&textheight='+text_height{$dc_id}+'&text_align=left\" menu=\"false\" quality=\"high\" width=\"'+ focus_width{$dc_id} +'\" height=\"'+ swf_height{$dc_id} +'\" allowScriptAccess=\"sameDomain\" type=\"application/x-shockwave-flash\" pluginspage=\"http://www.macromedia.com/go/getflashplayer\"/>');";
	echo '</script>';
}
?>