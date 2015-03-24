<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

	public function do_login($usuario=null, $senha=null){
		if ($usuario && $senha) {
			$this->db->where('login',$usuario);
			$this->db->where('senha',$senha);
			$this->db->where('ativo',1);
			$query = $this->db->get('usuarios');
			if ($query->num_rows == 1) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function get_bylogin($login = null){
		if ($login != null) {
			$this->db->where('login', $login);
			$this->db->limit(1);
			return $this->db->get('usuarios');
		} else {
			return false;
		}
		
	}

	public function get_byemail($email = null){
		if ($email != null) {
			$this->db->where('email', $email);
			$this->db->limit(1);
			return $this->db->get('usuarios');
		} else {
			return false;
		}
		
	}

}

/* End of file usuarios_model.php */
/* Location: ./application/models/usuarios_model.php */