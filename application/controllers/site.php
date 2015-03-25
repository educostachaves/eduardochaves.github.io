<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller {

	public function __construct() {
		parent::__construct();
		init_site();
	}

	public function index()	{
		set_tema('titulo','Login');
		set_tema('conteudo',load_modulo('index','home','site'));
		set_tema('rodape','');
		load_template();
	}

	public function portfolio() {
		set_tema('titulo','Portfolio');
		set_tema('conteudo',load_modulo('index','portfolio','site'));
		set_tema('rodape','');
		load_template();
	}
	

}

/* End of file site.php */
/* Location: ./application/controllers/site.php */