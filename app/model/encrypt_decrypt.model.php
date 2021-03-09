<?php
function        encrypt_($string){
    $cipher_algo = 'AES-128-CTR';
    $iv_legth = openssl_cipher_iv_length($cipher_algo);
    $key = 'ali-zaynoune';
    $encrypt_iv = '@2021_LEET_1337@';
    $encrypt = openssl_encrypt($string, $cipher_algo, $key, 0, $encrypt_iv);
    return($encrypt);
}

function        decrypt_($string){
    $cipher_algo = 'AES-128-CTR';
    $iv_legth = openssl_cipher_iv_length($cipher_algo);
    $key = 'ali-zaynoune';
    $encrypt_iv = '@2021_LEET_1337@';
    $decrypt = openssl_decrypt($string, $cipher_algo, $key, 0, $encrypt_iv);
    return($decrypt);
}








?>