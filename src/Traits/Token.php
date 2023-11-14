<?php
namespace Ak\Videostream\Traits;

trait Token
{
    private $exp_after = "10";
    private $encryptionMethod = "aes-256-cbc";
    private $encryptionKey = "395f426c0e5bd914375837483b791d80854dd9a19dd86fd189e94ccade60c5b8";
    private $iv = "0000000000000000";
    public function Encrypt()
    {
        $json          = [
            "start" => time(),
            "end"   => strtotime("+" . $this->encryptionMethod . " minutes"),
        ];
        $encryptedData = openssl_encrypt(json_encode($json), $this->encryptionMethod, $this->encryptionKey, $this->iv);
        return base64_encode($encryptedData);
    }

}