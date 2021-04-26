<!DOCTYPE html>
<html lang="en">
<?php require_once('service/server/lib/nusoap.php');

$client = new nusoap_client("http://localhost/SOAP/service/server/server.php?wsdl", true);

$value = $client->call('readall', array(''));
 ?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquey/3.5.1/jquery.min.js"></script>
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">
  <title></title>
</head>
<script>
  $(document).ready(function() {
    $('#table').DataTable();
  });
</script>

<body>
  <?php $param = '';
            $temp = $client->call('readall',array($param));
            $json = json_encode($temp);
            $result = json_decode($json); ?>
  <div class="container">
    <table class="table" id="table">
      <thead>
        <tr>
          <th scope="col">nrp</th>
          <th scope="col">nama</th>
          <th scope="col">foto</th>
          <th scope="col">prodi</th>
          <th scope="col">fakultas</th>
          <th scope="col">universitas</th>


        </tr>
      </thead>
      <tbody>
        <?php

        foreach ($result as $row) {

        ?>

            <td><?php echo $row->nrp; ?></td>
            <td><?php echo $row->nama; ?></td>
            <td><?php echo $row->foto; ?></td>
            <td><?php echo $row->prodi; ?></td>
            <td><?php echo $row->fakultas; ?></td>
            <td><?php echo $row->universitas; ?></td>


          </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
