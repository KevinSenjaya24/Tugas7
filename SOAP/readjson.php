<?php
header('Content-Type: text/json');
require_once('service/server/lib/nusoap.php');
$client = new nusoap_client('http://localhost/SOAP/service/server/server.php?wsdl', true);
$result = $client->call('readall', '');
$json = json_encode($result);
echo($json);
