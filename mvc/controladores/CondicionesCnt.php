<?php
	/**
	 * 
	 */
	class CondicionesCnt extends Controlador {
		public function CondicionesCnt() {
			parent::Controlador();
		}
		
		public function index(){
			$html=$this->view->dibujar("Condiciones");
			$error=$this->view->getTemplates("condiciones.html");
			$html=$this->view->putContent('<!--@fichas-->', $error, $html);
			echo $html;
		}
		
	}
	
?>