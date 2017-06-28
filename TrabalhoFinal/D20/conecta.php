<?php    
	function conecta_bd()    
	{   
		$link=mysqli_connect("localhost","root","","d20db");       
		if ($link)
			return($link);
		return(FALSE);    
	} 
?> 