<?php

#$subject = "click her <a href=\"ali.com\">";
#$mailHeader = "From:Camagru\r\n";
#$content = "click her <a href=\"al2.com\">";

#if (mail($argv[1], $subject, $content, $mailHeader))
#{
#	echo "done".PHP_EOL;
#}

$file = fopen($argv[1], "r");
if ($file){
	while(($line = fgets($file)) !== false){
		$reg = '/^[a-zA-Z0-9]+([\w-\+\!\#\$\%\&\'\*\=\?\^\`\{\|]+[\.]{0,1})+[a-zA-Z0-9]+@([a-z0-9]{1})+(\.{0,1}[a-z0-9-]+)*(\.[a-z]{2,4})$/';
		if (!preg_match($reg, $line))
			echo "\033[31m".$line;
		else
			echo "\033[32m".$line;
	}



}


?>
