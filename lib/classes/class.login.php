<?


class LoginManagement {
	
	
	
	function login($usr, $pass) {
		global $DBF;
		
		$Usr = new UserManagement($DBF['erad_users']);
		if(strlen($usr)>0 and strlen($pass)>0) $u = $Usr->getAll();
		#printr($u);exit;
		$lg = 0;
	  
		for($i = 0; $i < count($u); $i++) {
			if($u[$i][del]==0 && $u[$i][email] == $usr && $u[$i][password] == md5($pass)) {
				$_SESSION[iduser]=$u[$i][id_user];
				$_SESSION[user] = $u[$i];
				$_SESSION[user][login] = 1;
				$lg = 1;
				break;
			}
		}
	 
		return $lg ? true : false;
	}
	
	
	function logout() {
		session_unregister('user');
		unset($_SESSION[user]);
		return true;
	}
	
	
	function check_login() {
		return $_SESSION[user][login] ? true : false;
	}
	
}


?>