<?php

$subject = "click her <a href=\"ali.com\">";
$mailHeader = "From:Admin\r\n";
$content = "click her <a href=\"al2.com\">";

if (mail($argv[1], $subject, $content, $mailHeader))
{
	echo "done".PHP_EOL;
}

?>
