<?php  

error_reporting(0);

$config = file_get_contents('config.json');
$config = json_decode($config, true);

$jsonFilePath = 'config.json';
$jsonData = file_get_contents($jsonFilePath);
$dataArray = json_decode($jsonData, true);

if (isset($_POST['simpan'])) {
	if ($dataArray !== null) {
    	$dataArray['cons_id'] = $_POST['cons_id'];
    	$dataArray['secret_key'] = $_POST['secret_key'];
    	$dataArray['username'] = $_POST['username'];
    	$dataArray['password'] = $_POST['password'];
    	$dataArray['userkey'] = $_POST['userkey'];
    	$dataArray['kode_app'] = $_POST['kode_app'];
    	$dataArray['url_dev'] = $_POST['url_dev'];
    	$dataArray['url_prod'] = $_POST['url_prod'];
    	$dataArray['tipe'] = $_POST['tipe'];

    	$updatedJsonData = json_encode($dataArray, JSON_PRETTY_PRINT);
    	file_put_contents($jsonFilePath, $updatedJsonData);
    	header("location:config.php?success=true");
	} else {
	    header("location:config.php?success=false");
	}
}

?>

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
                            Config Pcare BPJS
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
				        			<td width="10%">Cons ID</td>
				        			<td width="3%">:</td>
				        			<td width="50%"><input type="text" name="cons_id" class="form-control" value="<?= $config['cons_id']; ?>"></td>
				        			<td></td>
				        		</tr>
				        		<tr>
				        			<td>Secret Key</td>
				        			<td>:</td>
				        			<td><input type="text" name="secret_key" class="form-control" value="<?= $config['secret_key']; ?>"></td>
				        			<td></td>
				        		</tr>
				        		<tr>
				        			<td>Username</td>
				        			<td>:</td>
				        			<td><input type="text" name="username" class="form-control" value="<?= $config['username']; ?>"></td>
				        			<td></td>
				        		</tr>
				        		<tr>
				        			<td>Password</td>
				        			<td>:</td>
				        			<td><input type="text" name="password" class="form-control" value="<?= $config['password']; ?>"></td>
				        			<td></td>
				        		</tr>
				        		<tr>
				        			<td>User Key</td>
				        			<td>:</td>
				        			<td><input type="text" name="userkey" class="form-control" value="<?= $config['userkey']; ?>"></td>
				        			<td></td>
				        		</tr>
				        		<tr>
				        			<td>Kode App</td>
				        			<td>:</td>
				        			<td><input type="text" name="kode_app" class="form-control" value="<?= $config['kode_app']; ?>"></td>
				        			<td></td>
				        		</tr>
				        		<tr>
				        			<td>Url Dev</td>
				        			<td>:</td>
				        			<td><input type="text" name="url_dev" class="form-control" value="<?= $config['url_dev']; ?>"></td>
				        			<td></td>
				        		</tr>
				        		<tr>
				        			<td>Url Prod</td>
				        			<td>:</td>
				        			<td><input type="text" name="url_prod" class="form-control" value="<?= $config['url_prod']; ?>"></td>
				        			<td></td>
				        		</tr>
				        		<tr>
				        			<td>Tipe</td>
				        			<td>:</td>
				        			<td><input type="text" name="tipe" class="form-control" value="<?= $config['tipe']; ?>" placeholder="dev / prod"></td>
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