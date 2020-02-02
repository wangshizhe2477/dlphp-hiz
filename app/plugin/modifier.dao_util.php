<?php
/**
 * 通用查询
 * @para model
 * @para id 主键
 * @para field 获取的字段值
 */
function smarty_modifier_dao_util($model, $id, $field) {
	$ob = m($model)->find($id);
	if(empty($field))
		return $ob;
	else
		return $ob[$field];
}
?>