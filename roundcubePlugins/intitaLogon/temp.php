function encrypt()
{
	$key = md5("key", true);
        $input = json_encode(array('test'=>'test'));
        $encrypted_data = urlencode(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $input, MCRYPT_MODE_ECB)));
        $decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_256,$key, base64_decode(urldecode($encrypted_data)),MCRYPT_MODE_ECB);
        $tt = json_decode(rtrim($decrypted),true);
}

function createMailPassword($password)
{
        $salt = substr(sha1(rand()), 0, 16);
        echo "{SSHA}" . base64_encode(hash('sha1', $password . $salt, true) . $salt);
}