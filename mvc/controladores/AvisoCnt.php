<?php
	/**
	 * 
	 */
	class AvisoCnt extends Controlador {
		public function AvisoCnt() {
			parent::Controlador();
		}
		
		public function index(){
			$html=$this->view->dibujar("AvisoCnt");
			$texto=$this->view->getTemplates("aviso.html");
			$html=$this->view->putContent('<!--@fichas-->', $texto, $html);
			echo $html;
		}
		
	}
	