
<div>
	
	<?php
	if(isset($image))
	{
		echo '<img src="data:image/jpeg;base64,'.base64_encode( $image ).'" width="120" height="120"/>';
	}
	else{
		echo '<img src="imgs\\d20_2.png" width="120" height="120"';
	}
	?>
</div>

<div>
	
</div>