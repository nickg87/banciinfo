<?



/* --- --- --- Table01 --- --- --- */

class dbt_l2 extends dbt {
	var $tbl, $pri, $flds, $ta;
	
	function dbt_l2($t) {
		$this->tbl = $t['tbl'];
		$this->pri = $t['pri'];
		$this->flds = parent::getFields($this->tbl);
		//printr($this->flds);
		$this->ta = $t;
	}
	
	function filter($val) {
		foreach($val as $k => $v)
			if(!in_array($k, $this->flds))
				unset($val[$k]);
		return $val;
	}

	function insert($val) {
		$val = $this->filter($val);
		return parent::insertAssoc($this->tbl, $val);
	}
	
	function update($val, $id) {
		$val = $this->filter($val);
		return parent::updateAssoc($this->tbl, $val, $id, $this->pri);
	}

	function get01($id) {
		$a = parent::queryAssoc("SELECT * FROM `{$this->tbl}` WHERE `{$this->pri}` = '{$id}'");
		return $this->ret01($a);
	}

	function getAll() {
		$a = parent::queryAssoc("SELECT * FROM `{$this->tbl}`");
		return $a;
	}

	function ret01($a) {
		$ret = array();
		if(!empty($a)) {
			$ks = array_keys($a[0]);
			foreach($ks as $v)
				$ret[$v] = $a[0][$v];
		}
		return $ret;
	}

	function search01($q, $searerad_type, $limit = '') {
		$where = $this->getSearchQuery($q, $searerad_type);
		$Limit = $limit ? " LIMIT 0, $limit" : "";
		return parent::queryAssoc("SELECT * FROM `{$this->tbl}` WHERE {$where} {$Limit}");
	}
	
	function getSearchQuery($q, $st = 1) {
		switch($st) {
			case '1':
				$c = explode(' ', $q);
				$qy = array();
				$p = array();
				foreach($this->ta['searerad_fields'] as $v) {
					foreach($c as $v2)
						$p[] = " `{$v}` LIKE '%".$v2."%' ";
					$qy[] = implode(' OR ', $p);
				}
				$ret = '(' . implode(') OR (', $qy) . ')';
				break;
		}
		return $ret;
	}
	
	function getLastId() {
		return parent::queryScalar("SELECT DISTINCT LAST_INSERT_ID() FROM `".$this->tbl."`");
	}
}

?>