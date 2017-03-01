<?php
//This file include the pre-set $IV and $key
//It will be better to allow the user to set their own key as second step authentication and store $iv
include 'secretInfo.php';
function encryptPass($source, $key){
    $key = substr(sha1($key,true),0,16);
    //$iv = openssl_random_pseudo_bytes(16);
    $ciphertext = openssl_encrypt($source, 'AES-256-CTR', $key, OPENSSL_RAW_DATA, $iv);
    return $ciphertext;
}

function decryptPass($source,$key){
	$key = substr(sha1($key,true),0,16);

	$plaintext = openssl_decrypt($source, 'AES-256-CTR', $key, OPENSSL_RAW_DATA, $iv);
	return $plaintext;
}
?>