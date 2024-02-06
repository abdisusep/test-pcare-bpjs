<?php  

error_reporting(0);

$config = file_get_contents('config.json');
$config = json_decode($config, true);

$id   = $_GET['id'];
$jsonFilePath = 'endpoint.json';
$jsonData = file_get_contents($jsonFilePath);
$data = json_decode($jsonData, true);

foreach ($data as $value) {
	if ($value['id'] == $id) {
		$name = $value['name'];
		$endpoint = $value['endpoint'];
	}
}

if (isset($_POST['simpan'])) {
	$data [] = array(
	    'id'     => uniqid(),
	    'name'   => $_POST['name'],
	    'endpoint' => $_POST['endpoint']
	);

    $updatedJsonData = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents($jsonFilePath, $updatedJsonData);
    header("location:endpoint.php?opsi=add&success=true");
}

if (isset($_POST['update'])) {
	foreach ($data as $key => $value) {
		if ($value['id'] == $id) {
			$data[$key]['name'] 	= $_POST['name_update'];
			$data[$key]['endpoint'] = $_POST['endpoint_update'];
		}
	}

    $updatedJsonData = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents($jsonFilePath, $updatedJsonData);
	header("location:endpoint.php?opsi=edit&id=$id&success=true");
}

?>

<?php if ($_GET['opsi'] == 'add') { ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test Pcare BPJS</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 m-auto">
                <div class="card mt-5 shadow border-0 rounded">
                    <div class="card-header bg-white">
                        <h4 class="my-2">
                            <img src="https://bpjs-kesehatan.go.id/assets/img/favicon.png" width="60">
                            Add Endpoint Pcare BPJS
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <a href="index.php" class="btn btn-success btn-sm"><i class="fas fa-angle-left"></i> Back</a>
                        </div>
                        <?php if($_GET['success']=="true") { ?>
                        <div class="alert alert-success border-0 shadow-sm"><i class="fas fa-check"></i> Berhasil simpan</div>
                        <?php } elseif ($_GET['success'] == "false") { ?>
                        <div class="alert alert-danger border-0 shadow-sm"><i class="fas fa-warning"></i> Gagal simpan</div>
                        <?php } ?>
                        <form method="POST">
				        	<table class="w-100" cellpadding="5">
				        		<tr>
				        			<td width="10%">Name</td>
				        			<td width="3%">:</td>
				        			<td width="50%"><input type="text" name="name" class="form-control"></td>
				        			<td></td>
				        		</tr>
				        		<tr>
				        			<td>Endpoint</td>
				        			<td>:</td>
				        			<td><input type="text" name="endpoint" class="form-control"></td>
				        			<td></td>
				        		</tr>
				        		<tr>
				        			<td></td>
				        			<td></td>
				        			<td><button type="submit" name="simpan" class="btn btn-primary btn-sm mt-3"><i class="fas fa-save"></i> Save</button></td>
				        			<td></td>
				        		</tr>
				        	</table>
				        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
</body>
</html>

<?php } elseif ($_GET['opsi'] == 'edit') { ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test Pcare BPJS</title>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 m-auto">
                <div class="card mt-5 shadow border-0 rounded">
                    <div class="card-header bg-white">
                        <h4 class="my-2">
                            <img src="https://bpjs-kesehatan.go.id/assets/img/favicon.png" width="60">
                            Edit Endpoint Pcare BPJS
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <a href="index.php" class="btn btn-success btn-sm"><i class="fas fa-angle-left"></i> Back</a>
                        </div>
                        <?php if($_GET['success']=="true") { ?>
                        <div class="alert alert-success border-0 shadow-sm"><i class="fas fa-check"></i> Berhasil update</div>
                        <?php } elseif ($_GET['success'] == "false") { ?>
                        <div class="alert alert-danger border-0 shadow-sm"><i class="fas fa-warning"></i> Gagal update</div>
                        <?php } ?>
                        <form method="POST">
				        	<table class="w-100" cellpadding="5">
				        		<tr>
				        			<td width="10%">Name</td>
				        			<td width="3%">:</td>
				        			<td width="50%"><input type="text" name="name_update" class="form-control" value="<?= $name; ?>"></td>
				        			<td></td>
				        		</tr>
				        		<tr>
				        			<td>Endpoint</td>
				        			<td>:</td>
				        			<td><input type="text" name="endpoint_update" class="form-control" value="<?= $endpoint; ?>"></td>
				        			<td></td>
				        		</tr>
				        		<tr>
				        			<td></td>
				        			<td></td>
				        			<td><button type="submit" name="update" class="btn btn-primary btn-sm mt-3"><i class="fas fa-save"></i> Update</button></td>
				        			<td></td>
				        		</tr>
				        	</table>
				        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
</body>
</html>
<?php } elseif ($_GET['opsi'] == 'delete') { ?>
	<?php  
		foreach ($data as $key => $value) {
			if ($value['id'] == $id) {
				array_splice($data, $key, 1);
			}
		}

	    $updatedJsonData = json_encode($data, JSON_PRETTY_PRINT);
	    file_put_contents($jsonFilePath, $updatedJsonData);
		header("location:index.php");
	?>
<?php } ?>