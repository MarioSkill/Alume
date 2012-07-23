<?php
/**
 *
 */
class PartnerCnt extends Controlador {
	public function PartnerCnt() {
		parent::Controlador();
	}

	public function index() {
		$html = $this -> view -> dibujar("partner");
		$partner = $this -> partner();
		$html = $this -> view -> putContent('<!--@fichas-->', $partner, $html);
		echo $html;
	}

	private function partner() {
		set_time_limit(0);
		error_reporting(0);

		require_once APP_PATH . 'excel_reader2.php';
		$excel = new Spreadsheet_Excel_Reader(VIEW_PATH . 'contenido' . DS . 'partner.xls');
		$ficha = $this -> view -> getTemplates('ficha.html');
		$ContFicha = '<ul class="thumbnails">';
		$path = VIEW_PATH . 'img' . DS . 'marcas' . DS;
		$path_img = BASE_URL . 'img' . DS . 'marcas' . DS;

		for ($row = 1; $row <= $excel -> rowcount(0); $row++) {
			$nombre = '';
			$descarga = '';
			$soporte = '';
			for ($col = 1; $col <= $excel -> colcount(0); $col++) {
				$val = $excel -> val($row, $col);
				if ($row != 1) {
					if ($col == 1) {
						$nombre = trim($val);
					} else if ($col == 2) {
						if (strlen(trim($val)) == 1)
							$descarga = '';
						else
							$descarga = '<a href="' . $val . '" name ="' . $nombre . '"><h6><i class="icon-download2"></i></h6></a>';
					} else if ($col == 3) {
						if (strlen(trim($val)) == 1)
							$link = $nombre;
						else
							$link = $val;
					} else if ($col == 4) {
						if (strlen(trim($val)) == 1)
							$soporte = '';
						else
							$soporte = '<a href="' . $val . '" name ="' . $nombre . '"><h6><i class="icon-wrench"></i> </h6></a>';
					} else if ($col == 5) {
						$aux .= '<td>' . $val . '</td>';
					}
				}

				$val = null;
			}
			if ($row > 1) {
				$auxficha = $this -> view -> putContent("@name", trim($nombre), $ficha);
				if ($descarga == "") {
					$auxficha = $this -> view -> putContent("@type", "none", $auxficha);
				}
				if (is_readable($path . trim($nombre) . '.jpg')) {
					$auxficha = $this -> view -> putContent("@src", $path_img . trim($nombre) . '.jpg', $auxficha);
				} else {
					$auxficha = $this -> view -> putContent("@src", 'http://placehold.it/200x200', $auxficha);
				}
				$auxficha = $this -> view -> putContent("@des", $descarga, $auxficha);
				$auxficha = $this -> view -> putContent("@sopor", $soporte, $auxficha);
				$auxficha = $this -> view -> putContent("@url", $link, $auxficha);
				$ContFicha .= $auxficha;

				if (($row - 1) % 6 == 0) {
					$ContFicha .= '</ul><ul class="thumbnails">';
				}
			}

		}
		$ContFicha .= '</ul>';
		return $ContFicha;
	}

}
