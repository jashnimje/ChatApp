<?php
function str_openssl_enc($str, $iv)
{
	$key = '!@#%$Phoenix!@#$Encryption!@#$';
	$chiper = "AES-256-CTR";
	$options = 0;
	$str = openssl_encrypt($str, $chiper, $key, $options, $iv);
	return $str;
}

function str_openssl_dec($str, $iv)
{
	$key = '!@#%$Phoenix!@#$Encryption!@#$';
	$chiper = "AES-256-CTR";
	$options = 0;
	$str = openssl_decrypt($str, $chiper, $key, $options, $iv);
	return $str;
}