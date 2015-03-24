<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//$this->load->library('sistema');
		init_painel();
	}

	public function index()	{
		//$this->load->view('painel_view');
	}

	public function login() {
		$this->form_validation->set_rules('usuario', 'USUÁRIO', 'trim|required|min_length[4]|strtolower');
		$this->form_validation->set_rules('senha', 'SENHA', 'trim|required|min_length[4]|strtolower');

		if ($this->form_validation->run() == true) {
			$usuario = $this->input->post('usuario',true);
			$senha = md5($this->input->post('senha',true));
			if ($this->usuarios->do_login($usuario,$senha) == true) {
				$query = $this->usuarios->get_bylogin($usuario)->row();
				$dados = array( 'user_id' => $query->id,
								'user_nome' => $query->nome,
								'user_admin' => $query->adm,
								'user_logado' => TRUE,
								);
				$this->session->set_userdata($dados);
				redirect('painel');
			} else {
				$query = $this->usuarios->get_bylogin($usuario)->row();
				if (empty($query)) {
					set_msg('errologin','Usuário Inexistente', 'erro');
				} elseif($query->senha != $senha) {
					set_msg('errologin','Senha incorreta', 'erro');
				} elseif($query->ativo == 0) {
					set_msg('errologin','Usuário inativo', 'erro');
				} else {
					set_msg('errologin','Erro desconhecido', 'erro');
				}
				redirect('usuarios/login');
				
			}
			
		} 
		
		set_tema('titulo','Login');
		set_tema('conteudo',load_modulo('usuarios','login'));
		set_tema('rodape','');
		load_template();
	}

	public function logoff() {
		$this->session->unset_userdata(array('user_id' => '', 'user_nome' => '', 'user_admin' => '' , 'user_logado' => ''));
		$this->session->sess_destroy();
		$this->session->sess_create();
		set_msg('logoffok','Logoff efetuado com sucesso','sucesso');
		redirect('usuarios/login');
	}

	public function nova_senha() {
		$this->form_validation->set_rules('email', 'E-MAIL', 'trim|required|valid_email|strtolower');
		
		if ($this->form_validation->run() == true) {
			$email = $this->input->post('email');
			$query = $this->usuarios->get_byemail($email);
			if($query->num_rows()==1){
				$nova_senha = substr(str_shuffle('qwertyuiopasdfghjklzxcvbnm0123456789'),0,6);
				$msg = '<p>Você solicitou uma nova senha para acesso ao painel de administração do site. Sua senha agora é a seguinte:</p>';
				$msg .= '<p><b>$nova_senha</b></p>';
				$msg = '<p>troque sua senha a seguir por segurança.</p>';
				if ($this->sistema->enviar_email($email,'Nova Senha de Acesso','$msg')) {
					set_msg('msgok','Uma nova senha foi enviada para seu e-mail','sucesso');
					redirect('usuarios/nova_senha');
				} else {
					set_msg('msgerro','Erro ao enviar nova senha. Contacte o Administrador','erro');
					redirect('usuarios/nova_senha');
				}
				set_msg('msgerro','Este e-mail não foi encontrado','erro');
				redirect('usuarios/nova_senha');
			}
		} 

		set_tema('titulo','Nova Senha');
		set_tema('conteudo',load_modulo('usuarios','nova_senha'));
		set_tema('rodape','');
		load_template();
	}

}

/* End of file usuarios.php */
/* Location: ./application/controllers/usuarios.php */