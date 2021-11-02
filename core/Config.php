<?php
session_start();
ob_start();

define('URLADM', 'http://192.168.1.2/caixa/');
define('URL', 'http://192.168.1.2/caixa/');

define('CONTROLER', 'Home');
define('METODO', 'index');
define('ROOT',$_SERVER['DOCUMENT_ROOT']);
define('DS', DIRECTORY_SEPARATOR);
define('SITE_ROOT',ROOT.DS.'caixa');

//Credenciais de acesso ao BD
define('HOST', 'localhost');
define('USER', 'mazera');
define('PASS', 'mazera');
define('DBNAME', 'caixa');
define('PORT', 3308);

/* setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo'); */