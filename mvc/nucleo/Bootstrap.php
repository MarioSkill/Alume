<?php
	class Bootstrap {
		function Bootstrap(Request $peticion) {
			$controlador= ucwords($peticion->getControlador())."Cnt";
			$pathContolador=CONTROLADORES.$controlador.'.php';
			
			$metodo=$peticion->getMetodo();
			$args=$peticion->getArgumentos();
			
			//echo $pathContolador;
			if(!is_readable($pathContolador)){
				$pathContolador=CONTROLADORES.'ErrorCnt.php';
				$controlador='ErrorCnt';
			}
			
			require_once $pathContolador;
			$controlador=new $controlador(VIEW_PATH.'templates'.DS);
			

			
			if(is_callable(array($controlador, $metodo))){
                $metodo = $peticion->getMetodo();
            }
            else{
                $metodo = 'index';
            }
			
			if(isset($args)){
                call_user_func_array(array($controlador, $metodo), $args);
            }
            else{
                call_user_func(array($controlador, $metodo));
            }
		}
	}
	
?>