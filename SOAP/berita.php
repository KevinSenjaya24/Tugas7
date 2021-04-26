<?php
$server = "localhost"
$username = "root";
$password="";
$database="latihansemantik";

$con = new mysqli($server,$username,$password,$database);
if($con->connect_error){
  die("koneksi gagal".$con->connect_error);
}
$r = $con->query("SELECT * FROM mahasiswa");
while($value = $r->fetch_assot()){
  $return_value[]=array(
    'nrp'=>$value['nrp'],
    'nama'=>$value['nama'],
    'foto'=>$value['foto'],
    'prodi'=>$value['prodi'],
    'fakultas'=>$value['fakultas'],
    'universitas'=>$value['universitas'],

  );
}
return $return_value;

?>
