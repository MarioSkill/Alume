<?php
/**
 *
 */
class Vista {
	private $controlador;
	private $nombreMenu;
	public function Vista(Request $peticion) {
		$this -> controlador = $peticion -> getControlador();
	}

	public function dibujar($vista) {
		return $this->load();
	}

	public function getTemplates($nombre) {	
		return file_get_contents(VIEW_PATH.'templates'.DS. $nombre);
	}

	public function getStyle($css) {
		return '<link rel="stylesheet"  href="' . VIEW_PATH . $css . '"';
	}

	public function putContent($hasg, $content, $document) {
		return str_replace($hasg, $content, $document);
	}

	function load() {
	
		$aux = "";
		$cabecera = $this -> getTemplates("cabecera.html");
		$cabecera=$this->putContent("@url", BASE_LINK, $cabecera);
		$cabecera=$this->putContent("@img/", BASE_URL.'img'.DS, $cabecera);
		$cuerpo = $this -> getTemplates("cuerpo.html");
		
		$cuerpo=$this->putContent("@css/", BASE_URL.'css'.DS, $cuerpo);
		$cuerpo=$this->putContent("@js/", BASE_URL.'js'.DS.'libs'.DS, $cuerpo);
		
		$carrusel = $this -> loadCarrusel(VIEW_PATH . "carrusel" . DS);
		//$carrusel=$this->putContent("@img/", BASE_URL.'img'.DS, $cabecera);
		
		$menu = $this -> getTemplates("menu.html");
		$menuList = $this -> listDir(VIEW_PATH . "Galeria_Tecnica" . DS, $aux);
		
		$pie = $this -> getTemplates("pie.html");
		$pie=$this->putContent("@img/", BASE_URL.'img'.DS, $pie);

		$cuerpo = $this -> putContent("@cabecera", $cabecera, $cuerpo);
		$cuerpo = $this -> putContent("@slide", $carrusel, $cuerpo);
		$menuList = '<li class="clk expandable" id="menu">
								<span class="nav-header">Galeria Tecnica</span>
								<ul >' . $menuList . '</ul></li>';
		$menu = $this -> putContent("@datos", $menuList . $this -> menu(), $menu);
		$cuerpo = $this -> putContent("@menu", $menu, $cuerpo);
		$cuerpo = $this -> putContent("@pie", $pie, $cuerpo);

		return $cuerpo;
	}

	public function acentuar($Cadena, $encode) {
		$Cadena = trim($Cadena);
		if ($encode)
			$Cadena = utf8_encode($Cadena);

		$Cadena = str_replace('á', '&aacute;', $Cadena);
		$Cadena = str_replace('é', '&eacute;', $Cadena);
		$Cadena = str_replace('í', '&iacute;', $Cadena);
		$Cadena = str_replace('ó', '&oacute;', $Cadena);
		$Cadena = str_replace('ú', '&uacute;', $Cadena);
		$Cadena = str_replace('Á', '&Aacute;', $Cadena);
		$Cadena = str_replace('É', '&Eacute;', $Cadena);
		$Cadena = str_replace('Í', '&Iacute;', $Cadena);
		$Cadena = str_replace('Ó', '&Oacute;', $Cadena);
		$Cadena = str_replace('Ú', '&Uacute;', $Cadena);
		$Cadena = str_replace('ñ', '&ntilde;', $Cadena);
		$Cadena = str_replace('Ñ', '&Ntilde;', $Cadena);
		$Cadena = str_replace('ä', '&auml;', $Cadena);
		$Cadena = str_replace('ë', '&euml;', $Cadena);
		$Cadena = str_replace('ï', '&iuml;', $Cadena);
		$Cadena = str_replace('ö', '&ouml;', $Cadena);
		$Cadena = str_replace('ü', '&uuml;', $Cadena);
		$Cadena = str_replace('Ä', '&Auml;', $Cadena);
		$Cadena = str_replace('Ë', '&Euml;', $Cadena);
		$Cadena = str_replace('Ï', '&Iuml;', $Cadena);
		$Cadena = str_replace('Ö', '&Ouml;', $Cadena);
		$Cadena = str_replace('Ü', '&Uuml;', $Cadena);
		$Cadena = str_replace('²', '&sup2;', $Cadena);
		$Cadena = str_replace('ñ', '&ntilde;', $Cadena);
		$Cadena = str_replace('Ñ', '&Ntilde;', $Cadena);
		return $Cadena;
	}

	public function loadCarrusel($path) {

		if (is_dir($path)) {//Si es un directorio
			$html = $this -> getTemplates("carrusel.html");
			$path_img = BASE_URL.'carrusel'.DS;
			$aux = "";
			if ($dh = opendir($path)) {//"abrimos" el directorio q vamos a recorrer
				while ($file = readdir($dh)) {//Recorremos el direcctorio
					if ($file != "." && $file != "..") {
						if ($aux == "") {
							$aux2 = $this -> putContent("@activo", "active", $html);
						} else {
							$aux2 = $this -> putContent("@activo", "", $html);
						}
						$aux .= $this -> putContent("@img", $path_img . $file, $aux2);
					}
				}
			}
		} else {
			$aux = "No es un direcctorio";
		}
		return $aux;
	}

	public function listDir($dir, $aux) {

		if (is_dir($dir)) {//Si es un directorio
			if ($dh = opendir($dir)) {//"abrimos" el directorio q vamos a recorrer
				while ($file = readdir($dh)) {//Recorremos el direcctorio
					if (is_dir($dir . $file)) {
						if ($file != "." && $file != "..") {
							//$this -> galeriaMenuBarra[$this -> i] = $file;
							$this -> i++;

							if ($this -> nombreMenu == strtolower($file)) {
								$aux .= '<li class="open collapsable clk"><span class="nav-header">' . $this -> deleteExtension($file) . '</span><ul style="display: block;">';
							} else {
								$aux .= '<li class="expandable clk"><span class="nav-header">' . $this -> deleteExtension($file) . '</span><ul style="display: none;">';
							}
							$aux = $this -> listDir($dir . $file, $aux);
							$aux .= '</ul></li>';
						}
					} else {
						if ($file != "." && $file != "..") {
							if (is_dir($dir . DS . $file)) {//Directorio dentro de directorio

								$aux .= '<li class="expandable clk"><span class="nav-header">' . $this -> deleteExtension($file) . '</span><ul style="display: none;">';
								$aux = $this -> listDir($dir . DIRECTORY_SEPARATOR . $file, $aux);
								$aux .= '</ul></li>';
							} else {
								$auxDir = substr($dir, strpos($dir, "_/") - 1);
								$aux .= '<li><a href=".' . $auxDir . DS . $file . '">' . $this -> deleteExtension($file) . '</a></li>';

							}
						}

					}

				}//end while

			}
		}
		return $aux;
	}

	public function deleteExtension($file) {
		$extension = (explode('.', $file));
		if (sizeof($extension) > 1) {
			$file = substr($file, 0, strpos($file, "."));

		}
		$file = str_replace("_", " ", $file);
		return $file;
	}

	public function menu() {
		$aux = '
		<li class="clk expandable">
			<span class="nav-header">Sobre Nosotros</span>
			<ul>
				<li>
					<a href="?target=condiciones">Condiciones Generales</a>
				</li>
				<li>
					<a href="?target=aviso">Aviso Legal</a>
				</li>
				<li>
					<a href="?target=infolegal">Informaci&oacute;n Legal</a>	
				</li>
				<li>
					<a href="?target=contacto">Contacte</a>
				</li>
				<li class="nav-header">
					<h6>formularios<h6>
				</li>
				<li>
					<a href="#">Alta Distribuidor</a>
				</li>
				<li>
					<a href="#">Recibir Ofertas</a>
				</li>
				<li>
					<a href="#">RMA</a>
				</li>
			</ul>
		</li>
		<li class="@partner">
			<a href="?target=Partner">Partner</a>
		</li>
		<li class="@soporte">
			<a href="?target=soporte">Soporte</a>
		</li>
		<li class="@ofertas">
			<a href="?target=ofertas">Ofertas</a>
		</li>
		<li class="@tienda">
			<a href="?target=tienda">Tienda</a>
		</li>
		';
		return $aux;
	}

}
?>