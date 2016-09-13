<?php

/*
 * Shodan Protocols
 */
echo $colors->getColoredString('PROTOCOLS AVAIABLE:', 'black', 'green');
try {
	var_dump($client->ShodanProtocols());
} catch (Exception $e) {
	echo $e->getMessage()."\n";
}
