<?php
session_start();
ob_start();

define('URLADM', 'http://192.168.1.2/bibelivre/');
define('URL', 'http://192.168.1.2/bibelivre/');

define('CONTROLER', 'Home');
define('METODO', 'index');
define('ROOT',$_SERVER['DOCUMENT_ROOT']);
define('DS', DIRECTORY_SEPARATOR);
define('SITE_ROOT',ROOT.DS.'bibelivre');

//Credenciais de acesso ao BD
define('HOST', 'localhost');
define('USER', 'mazera');
define('PASS', 'mazera');
define('DBNAME', 'biblivre');
define('PORT', 3308);
