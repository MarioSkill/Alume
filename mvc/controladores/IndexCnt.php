<?php
	/**
	 * 
	 */
	class IndexCnt extends Controlador {
		public function IndexCnt() {
			parent::Controlador();
		}
		
		public function index(){
			$html=$this->view->dibujar("index");
			$texto=$this->view->getTemplates("inicio.html");
			$html=$this->view->putContent('<!--@fichas-->', $texto, $html);
			echo $html;
		}
		
	}
	