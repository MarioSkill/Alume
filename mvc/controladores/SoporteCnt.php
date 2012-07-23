<?php
/**
 *
 */
class SoporteCnt extends Controlador {
		public function SoporteCnt() {
			parent::Controlador();
		}
	
	public function index() {
		$html=$this->view->dibujar("Soporte");
		$soporte=$this->soporte();
		$html = $this ->view-> putContent('<!--@fichas-->', $soporte, $html);
		echo $html;
	}

	private function soporte() {
		set_time_limit(0);
		error_reporting(0);
		require_once APP_PATH.'excel_reader2.php';
		$excel = new Spreadsheet_Excel_Reader(VIEW_PATH .'contenido'.DS.'soporte.xls');
		$excel -> setUTFEncoder('iconv');
		$excel -> setOutputEncoding("UTF-8");
		$ruta = VIEW_PATH . 'img' . DS . 'marcas' . DS;
		$path_img=BASE_URL.'img'.DS.'marcas'.DS ;
		$xml = '<table class="table table-bordered table-condensed">
				        <thead>
				          <tr>
				            <th>' . trim($excel -> val(1, 1)) . '</th>
				            <th>' . trim($excel -> val(1, 2)) . '</th>
				            <th>' . $this ->view-> acentuar(trim($excel -> val(1, 5)), TRUE) . '</th>		         
				          </tr>
				        </thead>
				        <tbody>';
		$prev = "";
		$count = 2;
		$sw = true;
		for ($row = 2; $row <= $excel -> rowcount(0); $row++) {
			$xml .= "<tr>";
			if ($prev != $excel -> val($row, 1)) {
				$xml = $this ->view-> putContent("@" . trim($prev), $count, $xml);
				$sw = true;
				$count = 1;
			}
			for ($col = 1; $col <= $excel -> colcount(0); $col++) {
				if ($col == 1 && $sw) {//Primera columna y primera fila de cada partner
					$xml .= "<td rowspan='@" . trim($excel -> val($row, $col)) . "' width='150px'>
										<a href='" . trim($excel -> val($row, $col + 1)) . "'>
											<img src='" . $path_img. trim($excel -> val($row, $col)) . ".jpg' 
											alt='" . $this ->view-> acentuar($excel -> val($row, $col + 2)) . "'
											title='" . $this ->view-> acentuar($excel -> val($row, $col + 2)) . "'>
										</a>
									</td>";
					$sw = FALSE;
					$prev = $excel -> val($row, $col);
				} else if ($col == 1 && !$sw) {//primera coluna cualquier fila
					//$xml .= "<td> </td>";
					$count++;
				} else if ($col == 2 && $count == 1) {//col 2 y 1 fila
					$xml .= "<td><h6><a href='" . $excel -> val($row, $col) . "'>" . $this ->view-> acentuar($excel -> val($row, $col + 1), TRUE) . "</a><h6></td>";
				} else if ($col == 2 && $count != 1) {
					$xml .= "<td><strong>" . $this ->view-> acentuar($excel -> val($row, $col + 1), TRUE) . "<strong></td>";
				} else if ($col == 3 && $count != 1) {
					$xml .= "<td><h6><a href='" . $excel -> val($row, $col + 1) . "'>" . $this ->view-> acentuar($excel -> val($row, $col + 2), TRUE) . "</a><h6></td>";
				} else if ($col == 3 && $count == 1) {
					$xml .= "<td><h6 style='color:black;'>" . $this ->view-> acentuar(($excel -> val($row, $col + 2)), TRUE) . "</h6></td>";
				}
			}
		}
		$xml .= "</tbody>
     				</table>";
		return $xml;
	
	}

}
