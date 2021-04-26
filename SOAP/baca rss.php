<?php
header('Content-Type: text/xml');
require_once('service/server/lib/nusoap.php');
$client = new nusoap_client('http://localhost/SOAP/service/server/server.php?wsdl', true);
$result = $client->call('readrss', '');
echo($result);
