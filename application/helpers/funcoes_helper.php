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

	set_tema('titulo_padrao','Painel Admin');
	set_tema('rodape','<p>&copy;2015</p>');
	set_tema('template','painel_view');
}

//carrega um template passando $tema como parâmentro
function load_template() {
	$CI =& get_instance();
	$CI->load->library('sistema');
	$CI->parser->parse($CI->sistema->tema['template'],get_tema());
}
