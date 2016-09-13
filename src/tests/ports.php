<?php

/*
 * Shodan Ports
 */
echo $colors->getColoredString('PORTS CRAWLED:', 'black', 'green');
try {
	var_dump($client->ShodanPorts());
} catch (Exception $e) {
	echo $e->getMessage()."\n";
}
