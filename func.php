<?php  

$config = file_get_contents('config.json');
$config = json_decode($config, true);

$url  = $config['tipe'] == "dev" ? $config['url_dev'] : $config['url_prod'];
$endpoint = $_GET['endpoint'];

$cons_id    = $config['cons_id'];
$secret_key = $config['secret_key'];
$tStamp 	= strval(time() - strtotime('1970-01-01 00:00:00'));
$signature  = hash_hmac('sha256', $cons_id . "&" . $tStamp, $secret_key, true);

$username  = $config['username'];
$password  = $config['password'];
$user_key  = $config['userkey'];
$kode_app  = $config['kode_app'];
$data_hash = "$cons_id&$tStamp";
$hash 		= hash_hmac('sha256', $data_hash, $secret_key, true);
$signature  = base64_encode($hash);
$authdata   = "$username:$password:$kode_app";
$auth 		= base64_encode($authdata);
$key = $cons_id . $secret_key . $tStamp;

$encodedSignature = base64_encode($signature);

function stringDecrypt($key, $string) {
    $encrypt_method = 'AES-256-CBC';

    // Hash
    $key_hash = hex2bin(hash('sha256', $key));

    // IV - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hex2bin(hash('sha256', $key)), 0, 16);

    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key_hash, OPENSSL_RAW_DATA, $iv);

    return $output;
}

function decompress($string) {
    return \LZCompressor\LZString::decompressFromEncodedURIComponent($string);
}

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "$url/$endpoint",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'X-cons-id: ' . $cons_id . '',
        'X-timestamp: ' . $tStamp . '',
        'X-signature: ' . $signature . '',
        'X-Authorization: Basic ' . $auth . '',
        'user_key: ' . $user_key . '',
        'Content-Type: application/json',
        'Cookie: BIGipServerdvlp_https_pool_9081=2181371820.31011.0000'
    ),
));

$response = curl_exec($curl);
curl_close($curl);

$obj_data = json_decode($response, true);
$decrypt  = stringDecrypt($key, $obj_data["response"]);
$result   = decompress($decrypt);

$code = $obj_data['metaData']['code'];

if ($obj_data) {
	if ($code == 200) {
		echo $result;
	}else if ($code == 404) {
		echo $response;
	}else{
		echo $response;
	}
}else{
	echo json_encode(['message'=>$response]);
}


?>