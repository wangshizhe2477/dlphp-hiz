<?php
/**
 * findAll(array('in()'=>array('rolename'=>$roles)))
 */
FLEA::loadClass ( 'FLEA_Db_TableDataGateway' );
class model_base extends FLEA_Db_TableDataGateway {
	var $primaryKey = 'id';
	var $tableName = '';
	
	function __construct($params = null) {
		parent::FLEA_Db_TableDataGateway($params);
	}
	
	function __prefix() {
		return $GLOBALS [G_FLEA_VAR] [APP_INF] ['dbTablePrefix'];
	}

	function __table(){
		return $this->__prefix() . $this->tableName;
	}
	
	//查询上一条数据
	function findLast($id, $para = array()) {
		array_push ( $para, array ($this->primaryKey, $id, '<' ));
		return $this->find($para, 'id desc');
	}
	
	//查询下一页数据
	function findNext($id, $para = array()) {
		array_push ( $para, array ($this->primaryKey, $id, '>' ));
		return $this->find($para, 'id asc');
	}
}
?>