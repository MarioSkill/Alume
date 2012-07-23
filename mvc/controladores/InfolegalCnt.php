<?php
	/**
	 * 
	 */
	class InfolegalCnt extends Controlador {
		public function InfolegalCnt() {
			parent::Controlador();
		}
		
		public function index(){
			$html=$this->view->dibujar("InfolegalCnt");
			$texto=$this->view->getTemplates("infolegal.html");
			$html=$this->view->putContent('<!--@fichas-->', $texto, $html);
			echo $html;
		}
		
	}
	