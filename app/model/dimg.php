<?php
class model_dimg extends model_base  {
	var $tableName = 'dimg';
	
	var $belongsTo = array(
		array(
			'mappingName' => 'dc',
			'tableClass' => 'model_dimgCate',
			'foreignKey' => 'dc_id',
		),
	);
}
?>