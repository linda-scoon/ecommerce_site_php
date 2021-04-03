<?php
class encryption
{
    private $cipher;
    private $key;

    function __construct($key, $cipher)
    {
        $this->cipher = $cipher;
        $this->key = $key;
    }

    function generate_key()
    {
        return openssl_random_pseudo_bytes(250);
    }

    function encrypt($plaintext)
    {
        $ivlen = openssl_cipher_iv_length($cipher = "AES-128-CBC");
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw = openssl_encrypt($plaintext, $cipher, $this->key, $options = OPENSSL_RAW_DATA, $iv);
        $hmac = hash_hmac('sha256', $ciphertext_raw, $this->key, $as_binary = true);
        return  base64_encode($iv . $hmac . $ciphertext_raw);
    }

    function decrypt()
    {
        $orig_text = '';
        $c = base64_decode($this->cipher);
        $ivlen = openssl_cipher_iv_length($cipher = "AES-128-CBC");
        $iv = substr($c, 0, $ivlen);
        $hmac = substr($c, $ivlen, $sha2len = 32);
        $ciphertext_raw = substr($c, $ivlen + $sha2len);
        $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $this->key, $options = OPENSSL_RAW_DATA, $iv);
        $calcmac = hash_hmac('sha256', $ciphertext_raw, $this->key, $as_binary = true);
        if (hash_equals($hmac, $calcmac)) //PHP 5.6+ timing attack safe comparison
        {
            $orig_text = $original_plaintext;
        }
        return $orig_text;
    }
}
