<?php	
	$file = 'pdf/LivrodoJogador-D&D5E.pdf';
	$filename = 'LivrodoJogador-D&D5E.pdf';
	header('content-type: application/pdf');
	header('content-Disposition: inline; filename:"'. $filename .'"');
	header('content-transfer-encoding: binary');
	header('acept-ranges: bytes');
	@readfile($file);
?>