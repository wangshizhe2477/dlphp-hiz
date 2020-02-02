<?php
class model_url extends model_base {
	var $tableName = 'url';
	
	var $belongsTo = array(
		array(
			'mappingName' => 'uc',
			'tableClass' => 'model_urlCate',
			'foreignKey' => 'uc_id',
		),
	);
}
?>
