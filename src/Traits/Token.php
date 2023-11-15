<?php
namespace Ak\Videostream\Traits;

trait Token
{
    // Time Expired Token (Minutes)
    private $exp_after = "10";
    // Encryption Method
    private $encryptionMethod = "aes-256-cbc";
    // This Default key
    private $encryptionKey = "395f426c0e5bd914375837483b791d80854dd9a19dd86fd189e94ccade60c5b8";
    // This iv
    private $iv = "0000000000000000";
    // Function For Change Key
    public function setKey($encryptionKey)
    {
        $this->encryptionKey = $encryptionKey;
        return $this;
    }
    // Function For Change iv
    public function setIV($iv)
    {
        $this->iv = $iv;
        return $this;
    }
    public function setTime($time)
    {
        $this->exp_after = $time;
        return $this;
    }
    public function Encrypt()
    {

        $json          = [
            "s" => time(),
            "e" => strtotime("+" . $this->exp_after . " minutes"),
        ];
        $encryptedData = openssl_encrypt(json_encode($json), $this->encryptionMethod, $this->encryptionKey, 0, $this->iv);
        return base64_encode("AKVT" . $encryptedData);
    }
    public function Decrypt($code)
    {
        $decode_base64 = base64_decode($code);
        $clear         = str_replace("AKVT", "", $decode_base64);
        $ciphertext    = openssl_decrypt($clear, $this->encryptionMethod, $this->encryptionKey, 0, $this->iv);
        $json_decode   = json_decode($ciphertext, true);
        if ($json_decode["s"] <= time() && $json_decode["e"] >= time()) {
            $this->openVideo();
            $this->setHeader();
            $this->stream();
        } else {
            echo "Token Expired";
        }
    }
}