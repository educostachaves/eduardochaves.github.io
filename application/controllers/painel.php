<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Painel extends CI_Controller {

	public function __construct() {
		parent::__construct();
		init_painel();
	}

	public function index()	{
		$this->inicio();
	}

	public function inicio() {
		if (esta_logado(false)) {
			set_tema('titulo','Painel');
			set_tema('conteudo','<div class="large-12 columns">Escolha um menu para iniciar</div>');
			load_template();
		} else {
			redirect('usuarios/login');
		}
	}
	

}

/* End of file painel.php */
/* Location: ./application/controllers/painel.php */