<?php
function smarty_function_editor($params, &$smarty) {
	$height = 400;
	$width = 670;
	if (empty ( $params ['name'] ))
		$params ['name'] = 'other';
	
	$css = empty ( $params ['css'] ) ? 'default.css' : $params ['css'];
	
	$sync = ",
afterChange : function() {
	this.sync();
}";
	
	$str = "
<script type='text/javascript'>KindEditor.ready(function(K) {
K.create('#{$params['name']}', {
allowFileManager : true,
cssPath : 'css/{$css}'{$sync}
});
});
</script>
<textarea id='{$params['name']}' name='{$params['name']}' style='width:{$width}px;height:{$height}px;visibility:hidden;'>{$params['value']}</textarea>
";
	
//	$str = "<script type='text/javascript'>
//KE.show({id : '{$params['name']}',cssPath : 'css/{$css}',allowFileManager : true"; //,urlType : 'domain'
	

//	if ($params ['model'] == 2) {
//		$str .= ",items : ['source', 'fontname', 'fontsize', 'textcolor', 'bgcolor', 'bold', 'italic', 'underline','removeformat', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist','insertunorderedlist', 'link']";
//		$height = 150;
//		$width = 400;
//	} else {
//		$str .= ",items : ['source', '|', 'fullscreen', 'undo', 'redo', 'print', 'cut', 'copy', 'paste','plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright','justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript','superscript', '|', 'selectall', '-','title', 'fontname', 'fontsize', '|', 'textcolor', 'bgcolor', 'bold','italic', 'underline', 'strikethrough', 'removeformat', '|', 'image','flash', 'media', 'advtable', 'hr', 'link', 'unlink', '|', 'about']";
//	}
//	$str .= "});</script>
//<textarea id='{$params['name']}' name='{$params['name']}' style='width:{$width}px;height:{$height}px;visibility:hidden;'>{$params['value']}</textarea>";
	return $str;
}
?>