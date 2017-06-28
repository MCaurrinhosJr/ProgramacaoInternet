<?php	
	$file = 'pdf/GuiadoMestre-D&D5E.pdf';
	$filename = 'GuiadoMestre-D&D5E.pdf';
	header('content-type: application/pdf');
	header('content-Disposition: inline; filename:"'. $filename .'"');
	header('content-transfer-encoding: binary');
	header('acept-ranges: bytes');
	@readfile($file);
?>