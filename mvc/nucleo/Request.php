<?php
/**
 *
 */
class Request {

	private $controlador=NULL;
	private $metodo=NULL;
	private $argumentos=NULL;

	function Request() {
		if (isset($_GET['url'])) {
			$url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
			$url = explode('/', $url);
			$url = array_filter($url);

			$this -> controlador = strtolower(array_shift($url));
			$this -> metodo = strtolower(array_shift($url));
			$this -> argumentos = $url;
		}
	}

	public function getControlador() {
		if (!isset($this -> controlador))
			$this -> controlador = CONTROLADOR_DEFECTO;

		return $this -> controlador;
	}

	public function getMetodo() {
		if (!isset($this -> metodo))
			$this -> metodo = "inicio";
		
		return $this -> metodo;
	}

	public function getArgumentos() {
		if (!isset($this -> argumentos))
			$this -> argumentos = array();
		return $this -> argumentos;
	}
	public function __toString(){
		$i=0;
		$args="";
		while($i<sizeof($this -> argumentos)){
			$args.=$this -> argumentos[$i]." ";
			$i++;
		}
		return $this -> controlador." ".$this -> metodo." ".$args;
	}
}
?>