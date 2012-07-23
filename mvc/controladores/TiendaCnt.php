<?php
	/**
	 * 
	 */
	class TiendaCnt extends Controlador {
		public function TiendaCnt() {
			parent::Controlador();
		}
		
		public function index(){
			$html=$this->view->dibujar("TiendaCnt");
			$texto=$this->view->getTemplates("tienda.html");
			$html=$this->view->putContent('<!--@fichas-->', $texto, $html);
			echo $html;
		}
		
	}
	