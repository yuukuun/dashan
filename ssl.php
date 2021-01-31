<?php header('Content-type: text/html; charset=UTF8');	?>
<!doctype html>
<html lang="en" >
  <head>
    <meta charset="UTF-8"> <!-- for HTML5 -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      </head>
<body class="bg-light">
<?php
//	https://www.cnblogs.com/CraryPrimitiveMan/p/6242167.html

//data you want to sign
$data = '123213';

//create new private and public key
$new_key_pair = openssl_pkey_new(array(
    "private_key_bits" => 2048,
    "private_key_type" => OPENSSL_KEYTYPE_RSA,
));
openssl_pkey_export($new_key_pair, $private_key_pem);

$details = openssl_pkey_get_details($new_key_pair);
$public_key_pem = $details['key'];

//create signature
openssl_sign($data, $signature, $private_key_pem, OPENSSL_ALGO_SHA256);
 $sign = base64_encode($signature);
//save for later
// file_put_contents('private_key.pem', $private_key_pem);
// file_put_contents('public_key.pem', $public_key_pem);
// file_put_contents('signature.dat', $signature);

//verify signature
// $r = openssl_verify($data, $signature, $public_key_pem, "sha256WithRSAEncryption");
// var_dump($r);
// Check signature
// $ok = openssl_verify($data, $binary_signature, $public_key_pem, OPENSSL_ALGO_SHA1);
// $ok = openssl_verify($data, $signature, $public_key_pem, OPENSSL_ALGO_SHA256);
// echo "check #1: ";
// if ($ok == 1) {
//     echo "signature ok (as it should be)\n".$signature;
// } elseif ($ok == 0) {
//     echo "bad (there's something wrong)\n";
// } else {
//     echo "ugly, error checking signature\n";
// }
$signs = base64_decode($sign);

openssl_public_decrypt($signs, $ss, $public_key_pem);

echo "String decrypt : $ss";
?>

  </body>
</html>
