<?

class dbt {
	
	function dbt() {
		
	}
	
	function query($q) {
		$rs = @mysql_query($q);
		$er = mysql_error();
		if(!strlen($er)) {
			return $rs;
		} else {
			if(LOG_DB_ERRORS) {
				// log errors
				
			}

			if(DISPLAY_DB_ERRORS) {
				echo '<strong>Query:</strong> ' . $q;
				echo '<br/>';
				echo '<font color=red><strong>Error['.mysql_errno().']:</strong> ' . $er . '</font>';
				echo '<br/>';
			}

			return false;
		}
	}

	function insertAssoc($t, $val) {
		$qx = array();
		foreach($val as $k => $v) {
			$v = $this->escape($v);
			$qx[] = "`{$k}` = '{$v}'";
		}
		return $this->query("INSERT INTO `{$t}` SET " . implode(', ', $qx));
	}

	function updateAssoc($t, $val, $id, $pri) {
		$qx = array();
		foreach($val as $k => $v) {
			$v = $this->escape($v);
			$qx[] = "`{$k}` = '{$v}'";
		}
		return $this->query("UPDATE `{$t}` SET " . implode(', ', $qx) . " WHERE `{$pri}` = '{$id}'");
	}

	function queryAssoc($sql) {
		$res = $this->query($sql);
		$ret = array();
		if($res) {
			while($row = mysql_fetch_assoc($res))
				$ret[] = $row;
			mysql_free_result($res);
		}
		return $ret;
	}
	
	function queryScalar($sql) {
		$res = $this->query($sql);
		$ret = '';
		if($res) {
			$row = mysql_fetch_row($res);
			$ret = $row[0];
			mysql_free_result($res);
		}
		return $ret;
	}

	function escape($c) {
		$c = trim($c);
		if(!get_magic_quotes_gpc()) 
			$c = addslashes($c);
		return $c;
	}

	function getFields($tbl) { // fara primary key
		$flds = array();
		$r = $this->queryAssoc("SHOW COLUMNS FROM `{$tbl}`");
		for($i = 0; $i < count($r); $i++) {
			if(strpos($r[$i]['Key'], 'PRI') === false)
				$flds[] = $r[$i]['Field']; 
		}
		return $flds;
	}
}



?>