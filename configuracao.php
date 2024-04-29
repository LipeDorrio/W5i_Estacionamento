<?php
date_default_timezone_set('America/Bahia');
global $config;


$config["servidor"]		= "localhost";
$config["bd"]			= "bd_estacionamento";
$config["usuario"]		= "root";
$config["senha"]		= "";
$config["banco"]		= "mysql";

$debug = true;
if ($debug){
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
} else {
	error_reporting(0);
}

$site = "projeto";
$caminho = "/projeto/";
$path_inc = dirname(realpath($_SERVER['SCRIPT_FILENAME']));

$aux = explode($site,$path_inc);
$path_serv = $aux[0];
$path_inc = $aux[0].$site;
?>