<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath(dirname(dirname(__FILE__))) . DS);
define('APP_PATH', ROOT . 'nucleo' . DS);
define('CONTROLADORES',ROOT.'controladores'.DS);
define('CONTROLADOR_DEFECTO', 'Index');

define('VIEW_PATH',dirname(ROOT).DS.'_'.DS);
define('BASE_URL', "http://".$_SERVER['HTTP_HOST'].DS.'mvc-df/_/');
define('BASE_LINK', "http://".$_SERVER['HTTP_HOST'].DS.'mvc-df/');

?>