<?php

error_reporting(0);

require_once 'vendor/autoload.php';
date_default_timezone_set('UTC');

$endpoint = $_GET['endpoint'];

if ($endpoint=="") {
    $json = file_get_contents('endpoint.json');
    $data = json_decode($json, true);

    foreach ($data as $value) {
        $no++;
        $list_endpoint .= "
        <tr>
            <td class='text-center'>".$no.".</td>
            <td>".$value['name']."</td>
            <td>
            <a href='?endpoint=".$value['endpoint']."' target='_blank' class='text-decoration-none text-primary'>".$url."/".$value['endpoint']."</a>
            </td>
            <td class='text-center'>
            <a href='endpoint.php?opsi=edit&id=".$value['id']."' class='btn btn-light bg-white shadow btn-sm'><i class='fas fa-edit text-info'></i></a>
            <a href='endpoint.php?opsi=delete&id=".$value['id']."' onclick='return confirm(`Delete endpoint ?`)' class='btn btn-light bg-white shadow btn-sm'><i class='fas fa-trash text-danger'></i></a>
            </td>
        </tr>
        ";
    }
}else{
    include 'func.php';
}

?>

<?php if ($endpoint=="") { ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test Pcare BPJS</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 m-auto">
                <div class="card mt-5 shadow border-0 rounded">
                    <div class="card-header bg-white">
                        <h4 class="my-2">
                            <img src="https://bpjs-kesehatan.go.id/assets/img/favicon.png" width="60">
                            Test Pcare BPJS
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <a href="config.php" class="btn btn-success btn-sm"><i class="fas fa-cog"></i> Config</a>
                            <a href="endpoint.php?opsi=add" class="btn btn-primary btn-sm"><i class="fas fa-link"></i> Endpoint</a>
                        </div>
                        <table id="table" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class='text-center'>No</th>
                                    <th>Name</th>
                                    <th>Endpoint</th>
                                    <th class='text-center'>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?= $list_endpoint; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
      Launch static backdrop modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            ...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Understood</button>
          </div>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>

    <script type="text/javascript">
        new DataTable('#table');
    </script>
</body>
</html>

<?php } ?>