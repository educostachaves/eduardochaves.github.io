<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Carrega Módulo do sistema devolvendo a tela solicitada

function load_modulo($modulo=null, $tela=null, $diretorio='painel')
{
	$CI =& get_instance();
	if ( $modulo != null ) {
		return $CI->load->view("$diretorio/$modulo",array('tela'=>$tela),true);
	} else {
		return false;
	}
}

//seta valores ao $tema da classe sistema
function set_tema($prop, $valor, $replace=true){
	$CI =& get_instance();
	$CI->load->library('sistema');

	if ($replace) {
		$CI->sistema->tema[$prop] = $valor;
	} else {
		if (!isset($CI->sistema->tema[$prop])) {
			$CI->sistema->tema[$prop] = '';
		}
		$CI->sistema->tema[$prop] .= $valor;
	}
	
}

//retorna os valores da array $tema da classe sistema
function get_tema() {
	$CI =& get_instance();
	$CI->load->library('sistema');
	return $CI->sistema->tema;
}

// Iniciar o painel ADM com recursos necessários
function init_painel(){
	$CI =& get_instance();
	$CI->load->library(array('sistema', 'session', 'form_validation'));
	$CI->load->helper(array('form','url','array','text'));
	//carregamento dos Models
	$CI->load->model('usuarios_model','usuarios');

	set_tema('titulo_padrao','Painel Admin');
	set_tema('rodape','<p>&copy;2015</p>');
	set_tema('template','painel_view');

	set_tema('headerinc', load_css(array('normalize','foundation.min','main')),false);
	set_tema('footerinc', load_js(array('vendor/jquery','vendor/modernizr','foundation.min','main')),false);
}

// Iniciar o painel ADM com recursos necessários
function init_site(){
	$CI =& get_instance();
	$CI->load->library(array('sistema'));
	$CI->load->helper(array('form','url','array','text'));
	//carregamento dos Models
	//$CI->load->model('usuarios_model','usuarios');

	set_tema('titulo_padrao','Site');
	set_tema('rodape','<p>&copy;2015</p>');
	set_tema('template','site_view');

	set_tema('headerinc', load_css(array('normalize','foundation.min','main')),false);
	set_tema('footerinc', load_js(array('vendor/jquery','vendor/modernizr','foundation.min','main')),false);
}

//carrega um template passando $tema como parâmentro
function load_template() {
	$CI =& get_instance();
	$CI->load->library('sistema');
	$CI->parser->parse($CI->sistema->tema['template'],get_tema());
}

//carrega um ou vários arquivos .css de uma pasta
function load_css($arquivo = null, $pasta = 'css' , $media='all') {
	if ($arquivo != null) {
		$CI =& get_instance();
		$CI->load->helper('url');
		$retorno = '';

		if (is_array($arquivo)) {
			foreach ($arquivo as $css) {
				$retorno .= '<link rel="stylesheet" type="text/css" href="'.base_url("$pasta/$css.css").'" media="'.$media.'"/>';
			}
		} else {
			$retorno .= '<link rel="stylesheet" type="text/css" href="'.base_url("$pasta/$arquivo.css").'" media="'.$media.'"/>';
		}
	}
	return $retorno;
	
}

//carrega um ou vários arquivos .js de uma pasta ou servidor remoto
function load_js($arquivo = null, $pasta = 'js' , $remoto=false) {
	if ($arquivo != null) {
		$CI =& get_instance();
		$CI->load->helper('url');
		$retorno = '';

		if (is_array($arquivo)) {
			foreach ($arquivo as $js) {
				if ($remoto) {
					$retorno .= '<script type="text/javascript" src="'.$js.'"></script>';
				} else {
					$retorno .= '<script type="text/javascript" src="'.base_url("$pasta/$js.js").'"></script>';
				}		
			}
		} else {
			if ($remoto) {
				$retorno .= '<script type="text/javascript" src="'.$arquivo.'"></script>';
			} else {
				$retorno .= '<script type="text/javascript" src="'.base_url("$pasta/$arquivo.js").'"></script>';
			}
		}
	}
	return $retorno;
	
}

//mostrar erros de validação em forms
function erros_validacao() {
	if (validation_errors()) {
		echo '<div class="alert-box alert">'.validation_errors().'</div>';
	} 
}


//verifica se o usuário está logado no sistema
function esta_logado($redir = true) {
	$CI =& get_instance();
	$CI->load->library('session');

	$user_status = $CI->session->userdata("user_logado");
	if (!isset($user_status) || $user_status != true) {
		if ($redir) {
			redirect('usuarios/login');
		} else {
			return false;
		}
	} else {
		return true;
	}
	
}

//Define uma mensagem para ser exibida na próxima tela carregada
function set_msg($id='msgerro', $msg=null, $tipo='erro'){
	$CI =& get_instance();
	switch ($tipo) {
		case 'erro':
			$CI->session->set_flashdata($id, '<div class="alert-box alert"><p>'.$msg.'</p></div>');
			break;
		case 'sucesso':
			$CI->session->set_flashdata($id, '<div class="alert-box success"><p>'.$msg.'</p></div>');
			break;
		default:
			$CI->session->set_flashdata($id, '<div class="alert-box"><p>'.$msg.'</p></div>');
			break;
	}
}

//verifica se existe uma mensagem para ser exibida na tela atual
function get_msg($id, $printar=true){
	$CI =& get_instance();
	if ($CI->session->flashdata($id)) {
		if ($printar) {
			echo $CI->session->flashdata($id);
			return true;
		} else {
			return $CI->session->flashdata($id);
		}
	} 
	return false;
}

