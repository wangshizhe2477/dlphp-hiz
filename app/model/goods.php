<?php
class model_goods extends model_base {
	var $tableName = 'goods';
	
	var $belongsTo = array(
		array(
			'mappingName' => 'gc',
			'tableClass' => 'model_goodsCate',
			'foreignKey' => 'gc_id',
		),
	);
}
?>
