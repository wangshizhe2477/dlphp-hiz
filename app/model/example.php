<?php
class model_example extends model_base {
	var $tableName = 'example';
	
	var $belongsTo = array(
		array(
			'mappingName' => 'ec',
			'tableClass' => 'model_exampleCate',
			'foreignKey' => 'ec_id',
		),
	);
}
?>