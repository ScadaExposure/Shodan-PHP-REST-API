# Shodan-PHP-REST-API

## Features

- Search Shodan
- Streaming API support for real-time consumption of Shodan data
- Exploit search API fully implemented

## Notes

* Shodan.php is the core of this script: costants, shodan methods and the generation of the HTTP request are instanced here.
* The script uses php magic methods, refer to PHP.net manual (http://php.net/manual/en/language.oop5.magic.php).
* shodan-api.php create the flags for running differents commands from console, it also provide an how-to function.
* It uses 3 different url base, for Shodan API, Streaming API and Exploits API.
* Tests folder provides some examples on how to write your own search query, ```-r``` flag for running them all together or individually callable with ```-t```.
* If you're in search of better and more thorough documentation, please refer to Shodan's REST API documentation (https://developer.shodan.io/api).
* For the functions that require subscriptions (banners(), geo() and ports()), refer to Shodan's STREAM API documentation (https://developer.shodan.io/api/stream)


## Usage:
The first thing we need to do in our code is to initialize the API object in shodan-api.php:

https://github.com/ScadaExposure/Shodan-PHP-REST-API/blob/master/src/shodan-api.php#L7
```php
$key = 'Insert your API key here';
```

Following are the options:

| Short form | Long form | Variables |
| :----------: | :---------: | --- |
| -r | --run-tests |  |
| -t | --run-test | STRING |
| -m | --method | ShodanHost --ip STRING [--history BOOLEAN] [--minify BOOLEAN] |
| -m | --method | ShodanHostCount --query STRING [--facets STRING] |
| -m | --method | ShodanHostSearch --query STRING [--facets STRING] |
| -m | --method | ShodanHostSearchTokens --query STRING  |
| -m | --method | ShodanPorts --ports STRING |
| -m | --method | ShodanProtocols |
| -m | --method | ShodanScan --id STRING |
| -m | --method | ShodanScanInternet --port INTEGER --protocol STRING |
| -m | --method | ShodanServices |
| -m | --method | ShodanQuery [--page INTEGER] [--sort STRING] [--order STRING] |
| -m | --method | ShodanQuerySearch --query STRING [--page INTEGER] |
| -m | --method | ShodanQueryTags [--size INTEGER] |
| -m | --method | LabsHoneyscore --ip STRING |
| -m | --method | Search --query STRING [--facets STRING] [--page INTEGER] |
| -m | --method | Count --query STRING [--facets STRING] |
| -m | --method | ShodanBanners |
| -m | --method | ShodanAsn --asn STRING |
| -m | --method | ShodanCountries --countries STRING |



## Tests class - REST API



##### Shodan Host (```/tests/ip.php```): 
Return all services that have been found on the given host IP.
```php
var_dump($client->ShodanHost(array(
	'ip' => '69.171.230.68', // https://www.facebook.com/
)));
```


##### Shodan Host Count (```/tests/count.php```): 
Returns the total number of results that matched the query and any facet information that was requested.
```php
var_dump($client->ShodanHostCount(array(
  'query' => 'Niagara Web Server',
)));
```


##### Shodan Host Search (```/tests/search.php```): 
Search Shodan using the same query syntax as the website and use facets to get summary information for different properties. - This method may use API query credits depending on usage.
```php
var_dump($client->ShodanHostSearch(array(
	'query' => 'Niagara Web Server',
)));
```


##### Shodan Host Search Tokens (```/tests/search.php```): 
This method lets you determine which filters are being used by the query string and what parameters were provided to the filters.
```php
var_dump($client->ShodanHostSearchTokens(array(
	'query' => 'Niagara Web Server country:"IT"',
)));
```


##### Shodan Ports (```/tests/ports.php```): 
This method returns a list of port numbers that the crawlers are looking for.
```php
var_dump($client->ShodanPorts());
```


##### Shodan Protocols (```/tests/protocols.php```): 
This method returns an object containing all the protocols that can be used when launching an Internet scan.
```php
var_dump($client->ShodanProtocols());
```


##### Shodan Scan (```/tests/crawl.php```): 
Use this method to request Shodan to crawl a network. - POST METHOD REQUIRE PAID API KEY.
```php
var_dump($client->ShodanScan(array(
	'ips' => '69.171.230.0/24',
)));
```

##### Shodan Scan Internet (```/tests/crawl.php```): 
Use this method to request Shodan to crawl the Internet for a specific port. - POST METHOD REQUIRE PAID API KEY AND SHODAN PERMISSION.
```php
var_dump($client->ShodanScanInternet(array(
	'port' => '80',
	'protocol' => 'dns-tcp',
)));
```


##### Shodan Scan Id (```/tests/crawl.php```): 
Check the progress of a previously submitted scan request.
```php
var_dump($client->ShodanScanId(array(
	'id' => 'R2XRT5HH6X67PFAB',
)));
```


##### Shodan Services (```/tests/crawl.php```): 
This method returns an object containing all the services that the Shodan crawlers look at. It can also be used as a quick and practical way to resolve a port number to the name of a service.
```php
var_dump($client->ShodanServices());
```

##### Shodan Query (```/tests/saved_query.php```):
Use this method to obtain a list of search queries that users have saved in Shodan.
```php
var_dump($client->ShodanQuery(array(
	'page' => '1', 
)));
```


##### Shodan Query (```/tests/saved_query.php```): 
Use this method to search the directory of search queries that users have saved in Shodan.
```php
var_dump($client->ShodanQuery(array(
	'query' => 'fax',
)));
```


##### Shodan Query Tags (```/tests/query_tags.php```): 
Use this method to obtain a list of popular tags for the saved search queries in Shodan.
```php
var_dump($client->ShodanQueryTags(array(
	'size' => '30',
)));
```


## Tests class - Esperimental method



##### Labs Honeyscore (```/tests/honeypot.php```): 
Calculates a honeypot probability score ranging from 0 (not a honeypot) to 1.0 (is a honeypot).
```php
var_dump($client->LabsHoneyscore(array(
	'ip' => '54.231.184.227', // http://mushmush.org/
)));
```


## Tests class - Exploits REST API


##### Search Exploits (```/tests/exploits.php```): 
Search across a variety of data sources for exploits and use facets to get summary information.
```php
var_dump($client->Search(array(
	'query' => 'cve',
)));
```


##### Count Exploits (```/tests/exploits.php```): 
This method behaves identical to the "/search" method with the difference that it doesn't return any results.
```php
var_dump($client->Count(array(
	'query' => 'cve',
)));
```
