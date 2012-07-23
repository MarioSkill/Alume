<?php
	/**
	 * 
	 */
	class ToolsCnt extends Controlador {
		public function ToolsCnt() {
			parent::Controlador();
		}
		
		public function index(){

			echo $this->loadTools();
		}
		public function destock(){
			$html= require (VIEW_PATH.'tools'.DS.'tools.php');
			
			//$html=$this->view->putContent('@css/', BASE_URL.'tools'.DS.'css'.DS, $html);
			echo $html;
		}
		public function loadTools(){
			return require(VIEW_PATH.'tools'.DS.'index.php');
		}
	}
	