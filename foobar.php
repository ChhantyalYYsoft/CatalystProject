<?php
$output = "";
for ($i=1; $i <=100 ; $i++) { 
	# code...
	if ($i%3 == 0 ) {
		# code...
		echo "foo, ";
	}
	elseif ($i%5 == 0) {
		# code...
		echo "bar, ";
	}
	elseif ($i%3==0 && $i%5 == 0) {
		# code...
		echo "foobar, ";
	}
	else
	{
		echo $i.", ";
	}
}

?>