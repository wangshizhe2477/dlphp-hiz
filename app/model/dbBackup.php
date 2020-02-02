<?php
class model_dbBackup {
	
	var $sqlFileContent;
	var $dboObj;

	function __construct(){
		$this->sqlFileContent = '';
		$this->dboObj = &FLEA::getDBO();
	}

	function _backupTableStructure($tableName){ //构造表结构
		$this->sqlFileContent .= "-- -----------------------------\r\n";
		$this->sqlFileContent .= "-- 表的结构 `$tableName`\r\n";
		$this->sqlFileContent .= "-- -----------------------------\r\n";
		$this->sqlFileContent .= "DROP TABLE IF EXISTS `$tableName`;\r\n";
		$sql = "SHOW CREATE TABLE $tableName";
		$res = $this->dboObj->getAll($sql);
		$this->sqlFileContent .= $res[0]['Create Table'].";\r\n";
	}

	function _backupTableData($tableName){ //表数据
		$sql = "SELECT * FROM $tableName";
		$res = $this->dboObj->getAll($sql);
		if(count($res) != 0){
			$this->sqlFileContent .= "-- -----------------------------\r\n";
			$this->sqlFileContent .= "-- 导出表中的数据 `$tableName`\r\n";
			$this->sqlFileContent .= "-- -----------------------------\r\n";
			$this->sqlFileContent .= "INSERT INTO `$tableName`(";

			$field = array();
			$keys = array_keys($res[0]);
			foreach ($keys as $key){
				$field[] = "`".$key."`";
			}
			$this->sqlFileContent .= implode(',',$field).')VALUES';
			$vals = array();
			foreach ($res as $row){
				$varstr = array();
				foreach ($row as $val){
					$val = mysql_real_escape_string($val);
					if($val == '') 
						$varstr[] = 'NULL';
					else 
						$varstr[] = "'".$val."'";
				}
				$vals[] = "(".implode(",",$varstr).")";
			}
			$this->sqlFileContent .= implode(",",$vals).";\r\n"; 
			$this->sqlFileContent .= "-- --------------------------------------------------------\r\n";
		}
	}
	function backupDB($tableName = ''){
		do{
			$sql = "SHOW TABLES";
			$res = $this->dboObj->getAll($sql);
			$tableNames = array();
			foreach ($res as $row){
				foreach ($row as $tableNames[]);
			}
			$sqlFile = ROOT . 'backup' . DS;
			if(!is_dir($sqlFile))
				mkdir($sqlFile);
			if($tableName != ''){
				if(array_search($tableName,$tableNames) === false){
					$msg = '数据表名称错误';
					break;
				}
				$tableNames = array();
				$tableNames[] = $tableName;
				$sqlFile .= $tableName.'_SQL_';
			}
			else {
				$sqlFile .= 'DB_SQL_';
			}
			$date = date('Y_m_d_H_i_s');
			$this->sqlFileContent = "#<?php die(); ?>";
			$this->sqlFileContent .= "-- 生成日期: $date\r\n";
			$this->sqlFileContent .= "-- --------------------------------------------------------\r\n";

			foreach ($tableNames as $table){
				$this->_backupTableStructure($table);
				$this->_backupTableData($table);
			}
			$sqlFile .= $date.'.php';
			if(file_exists($sqlFile)) unlink($sqlFile);
			$fp = fopen($sqlFile, "w");
			if(fwrite($fp,$this->sqlFileContent) === false){
				$msg = '生成备份文件出错';
				break;
			}
			$msg = '';
		}while (false);
		if (!isset($msg)||empty($msg)){
			fclose($fp);
			return true;
		}
		else{
			return $msg;
		} 
	}

	function resumeDB($sqlFile){
		do{
			$fp = fopen($sqlFile,"r");
			if($fp === false){
				$msg = '无法找到备份文件';
				break;
			}
			while (!feof($fp)) {
				$this->sqlFileContent .= fgets($fp, 4096);
			}
			fclose($fp);
			$this->sqlFileContent = str_replace("\r", '', $this->sqlFileContent);
			$sqlArr = explode(";\n", $this->sqlFileContent);
			foreach ($sqlArr as $sql){
				$sql = trim($sql, " \r\n;"); //剔除多余信息
				if (!empty($sql)){
					if($this->dboObj->execute($sql) === false){
						$msg = '执行SQL时出错';
					}
				}
			}
			if($msg == '执行SQL时出错') 
				break;
			$msg = '';
		}while (false);
		if (!isset($msg)||empty($msg))
			return true;
		else
			return $msg;
	}
}
?>