<?php
/**
 *
 */
abstract class Controlador {
	private $template;
	private $style;
	private $nombreMenu = "";
	protected $view;

	function Controlador() {
		//$this -> template = $template . DS;
		 $this->view = new Vista(new Request);
	}
	abstract public function index();
	

	

	
	
	public function __toString() {
		return $template;
	}

}
?>