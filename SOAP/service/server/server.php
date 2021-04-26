<?php
require_once('lib/nusoap.php');
$ns = "http://".$_SERVER['HTTP_HOST']."/SOAP/service/server/server.php";
$server = new soap_server();
$server->configureWSDL('WEB SERVICE UKM', 'urn:barangServerWSDL');
$server->wsdl->schemaTargetNamespace = $ns;

 $server->register('readall',
 array('input' => 'xsd:String'),
 array('output' => 'xsd:Array'),
 $ns,
 "urn:".$ns."/readall","rpc","encoded",);


function readall() {
  $server = "localhost";
  $username = "root";
  $password="";
  $database="mahasiswa";

  $link = new PDO("mysql:host=$server; dbname=$database", $username,$password);
          $link->setAttribute(PDO::ATTR_AUTOCOMMIT, false);
          $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $query = "SELECT * from mahasiswa";
          $result = $link->query($query);
          $link=null;
          return $result->fetchAll(\PDO::FETCH_ASSOC);
}

$server->register('readrss',
array('input' => 'xsd:String'),
array('output' => 'xsd:Array'),
$ns,
"urn:".$ns."/readrss","rpc","encoded",);


function readrss() {
 $server = "localhost";
 $username = "root";
 $password="";
 $database="mahasiswa";

 $link = new PDO("mysql:host=$server; dbname=$database", $username,$password);
         $link->setAttribute(PDO::ATTR_AUTOCOMMIT, false);
         $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $query = "SELECT * from mahasiswa";
         $result = $link->query($query);
         $link=null;
         $list_mahasiswa= $result->fetchAll(\PDO::FETCH_ASSOC);

         $xmlDoc = new DOMDocument("1.0", "UTF-8");
         $tabRss = $xmlDoc->appendChild($rssTag = $xmlDoc->createElement("rss"));
         $rssTag->setAttribute('version', '2.0');
         $tabChannel = $tabRss->appendChild($xmlDoc->createElement("channel"));
         $tabTitle = $tabChannel->appendChild($xmlDoc->createElement("title", "Mahasiswa"));
         $tabLink = $tabChannel->appendChild($xmlDoc->createElement("link", "http://www.praktikum.com/maranatha"));
         $tabDescription = $tabChannel->appendChild($xmlDoc->createElement("description", "data mahasiswa"));
         foreach ($list_mahasiswa as $data) {
             if (!empty($data)) {
                 $tabMahasiswa = $tabChannel->appendChild($xmlDoc->createElement("item"));
                 foreach ($data as $key => $val) {
                     $tabMahasiswa->appendChild($xmlDoc->createElement($key, $val));
                 }
             }
         }

         $xmlDoc->formatOutput = true;
         return ($xmlDoc->saveXML());
}







$server->register('readrdf',
array('input' => 'xsd:String'),
array('output' => 'xsd:Array'),
$ns,
"urn:".$ns."/readrdf","rpc","encoded",);


function readrdf() {
 $server = "localhost";
 $username = "root";
 $password="";
 $database="mahasiswa";
 $link = new PDO("mysql:host=$server; dbname=$database", $username,$password);
         $link->setAttribute(PDO::ATTR_AUTOCOMMIT, false);
         $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $query = "SELECT * from mahasiswa";
         $result = $link->query($query);
         $link=null;
         $list_mahasiswa= $result->fetchAll(\PDO::FETCH_ASSOC);

$nTriples = '';

$URI = 'http://www.praktikum.com/maranatha';

foreach ($list_mahasiswa as $data) {
    if (!empty($data)) {
        foreach ($data as $key => $val) {
            if ($key != 'nrp') {
                $nTriples .= '<' . $URI . '/' . $data['nrp'] . '>';
                $nTriples .= ' <' . $URI . '#has' . $key . '>';
                $nTriples .= ' "' . $val . '" .' . "\n";
            }
        }
        $nTriples .= "\n";
    }
}

return $nTriples;

}
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
@$server->service(file_get_contents("php://input"));









?>
