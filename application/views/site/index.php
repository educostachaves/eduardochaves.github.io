<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

switch ($tela) {
	case 'home':
		echo '<div class="large-5 columns large-centered">';
		echo '<p>Olá eu sou a Home!</p>';
		echo '</div>';
		break;
	case 'portfolio':
		echo '<div class="large-5 columns large-centered">';
		echo '<p>Olá eu sou o portfolio!</p>';
		echo '</div>';
		break;
	default:
		echo '<div class="alert-box alert"><p>Nenhuma Página foi encontrada</p></div>';
		break;
}