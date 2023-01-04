<?php
 


class CartManagement {

	var $ob;
	var $cart;
	var $cart_total;
	
	/*
	function getInstance() {
		static $init;
		if($init) {
			return $this->ob;
		} else {
			$init = 1;
			return $this->ob = new CartManagement($_SESSION[cart]);
		}
	}
	
	function getInstance() {
		static $init;
		if($this) {
			printr($this);
			echo 1;exit;
			return $this;
		} else {
			echo 2;exit;
			$init = 1;
			return new CartManagement($_SESSION[cart]);
		}
	}
	*/
	
	function CartManagement($cart) {
		$this->cart = array_empty($cart[items]) ? array() : $cart[items];
		$this->cart_total = $cart[total] > 0 ? $cart[total] : 0;
	}
	
	function addToCart($id, $cant = 1) {
		$prd = mysql_query_assoc("SELECT * FROM erad_produse WHERE id_produs = '{$id}'");
		if(empty($prd) || $cant < 1)
			return false;
		$entry = array();
		$entry[id_produs] = $id;
		$entry[produs] = $prd[0][produs].' '.$prd[0][produs_cod];
		 
		$entry[cant] = $cant;
		$entry[pret_unitar] = $prd[0][pret_oferta] > 0 ? $prd[0][pret_oferta] : $prd[0][pret];
		$entry[pret_total] = $cant * $entry[pret_unitar];
		
		$deja_in_cos = 0;
		foreach($this->cart as $k => $v) {
			if($k == $entry[id_produs]) {
				$this->cart[$k][cant] += $entry[cant];
				$this->cart[$k][pret_total] += $entry[pret_total];
				$deja_in_cos = 1;
				$this->cart_total += $entry[pret_total];
				break;
			}
		}
		if(!$deja_in_cos) {
			$this->cart[$entry[id_produs]] = $entry;
			$this->cart_total += $entry[pret_total];
		}
		
		$this->cart_total = number_format($this->cart_total, 2, '.', '');
		$this->cartUpdate();
		$this->redirect();
		
		return true;
	}
	
	function cantUpdate($cant) {
		foreach($this->cart as $k => $v) {
			if($cant[$k] > 0) {
				if($cant[$k] > $this->cart[$k][cant]) {
					$pret_mod = ($cant[$k] - $this->cart[$k][cant]) * $this->cart[$k][pret_unitar];
					$this->cart[$k][pret_total] += $pret_mod;
					$this->cart_total += $pret_mod;
				} elseif($cant[$k] < $this->cart[$k][cant]) {
					$this->cart_total;
					$pret_mod = ($this->cart[$k][cant] - $cant[$k]) * $this->cart[$k][pret_unitar];
					$this->cart[$k][pret_total] -= $pret_mod;
					#echo $this->cart_total . ' # ' . $pret_mod;
					$this->cart_total -= $pret_mod;
					#exit;
				}
				$this->cart[$k][cant] = $cant[$k];
			}
		}

		$this->cart_total = number_format($this->cart_total, 2, '.', '');
		$this->cartUpdate();
		$this->redirect();
	}
	
	function removeFromCart($k) {
		if(!array_empty($this->cart[$k])) {
			#$this->cart_total -= $this->cart[$k][pret_total];
			$this->cart_total = $this->cart_total == $this->cart[$k][pret_total] ? 0 : $this->cart_total - $this->cart[$k][pret_total];
			unset($this->cart[$k]);
		}

		$this->cart_total = number_format($this->cart_total, 2, '.', '');
		$this->cartUpdate();
		$this->redirect();
	}

	

	function cartUpdate() {
		$_SESSION[cart][items] = $this->cart;
		$_SESSION[cart][total] = $this->cart_total;
	}
	
	function redirect() {
		header('location: ' . SITE_URL . 'viewcart');
		exit;
	}


	function insertDB($id_comanda) {
		$ok = 0;
		$p = 0;
		foreach($this->cart as $k => $v) {
			$ins = mysql_query("INSERT INTO erad_cart SET
				id_comanda = '".$id_comanda."',
				id_produs = '".$this->cart[$k][id_produs]."',
				produs = '".$this->cart[$k][produs]. $this->cart[$k][coordx]."',
				cant = '".$this->cart[$k][cant]."',
				pret_unitar = '".$this->cart[$k][pret_unitar]."',
				pret_total = '".$this->cart[$k][pret_total]."'
			");
			$ok += $ins ? 1 : 0;
			$p++;
		}
		return $ok == $p ? true : false;
	}

}


?>
