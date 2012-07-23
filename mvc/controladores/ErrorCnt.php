<?php
	/**
	 * 
	 */
	class ErrorCnt extends Controlador {
		public function ErrorCnt() {
			parent::Controlador();
		}
		public function index(){
			$html=$this->view->dibujar("index");
			$error=$this->view->getTemplates("404.html");
			$html=$this->view->putContent('<!--@fichas-->', $error, $html);
			echo $html;
		}
		
	}
	
?>