<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

switch ($tela) {
	case 'login':
		echo 'Tela de Login';
		break;
	
	default:
		echo '<div class="alert-box alert"><p>Nenhuma Página foi encontrada</p></div>';
		break;
}