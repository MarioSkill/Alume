<?php
	/**
	 * 
	 */
	class OfertasCnt extends Controlador {
		public function OfertasCnt() {
			parent::Controlador();
		}
		
		public function index(){
			$html=$this->view->dibujar("OfertasCnt");
			$texto=$this->loadTienda();
			$html=$this->view->putContent('<!--@fichas-->', $texto, $html);
			echo $html;
		}
		public function loadTienda(){
			//echo BASE_LINK.'tools'.DS.'ofertas.php';
			return require(VIEW_PATH.'tools'.DS.'ofertas.php');
			//$html=$controlador ->putContent("<!--@ofertas-->", $ofertas, $html);
		}
		
	}
	