<?php

require_once("database.php");

class Cookie
{
    private $signed_in = false;
    public $user_id;
    
    // Increase the cookie expiration to 6 months (180 days)
    private $cookie_expiration = 180 * 24 * 60 * 60;
    private $encryption_key = bin2hex(random_bytes(32)); // Generates a 32-byte (256-bit) key


    function __construct()
    {
        // Check for existing cookies
        if (isset($_COOKIE['user_id'])) {
            $this->user_id = $_COOKIE['user_id'];
            $this->user_id = $this->decryptCookie($_COOKIE['user_id']);
            $this->signed_in = true;
        } else {
            unset($this->user_id);
            $this->signed_in = false;
        }
    }

    public function is_signed_in()
    {
        return $this->signed_in;
    }

    public function login($user)
    {
        if ($user) {
            $this->user_id = $user->id;
            $user->islogged = true;
            $user->update();

            // Set the user_id cookie with the expiration time
            setcookie('user_id', $this->user_id, time() + $this->cookie_expiration);
            // Set the user_id cookie with the Secure and HttpOnly flags
            setcookie('user_id', $this->encryptCookie($this->user_id), time() + $this->cookie_expiration, '/', '', true, true);

            $this->signed_in = true;
        }
    }

    public function logout(){
        $user = User::find_by_id($this->user_id);
        $user->islogged = false;
        $user->update();

        //this is without secure hhtponly flags
        setcookie('user_id', '', time() - $this->cookie_expiration);
        // Delete the user_id cookie with the Secure and HttpOnly flags
        setcookie('user_id', '', time() - $this->cookie_expiration, '/', '', true, true);

        unset($this->user_id);
        $this->signed_in = false;
    }


    private function encryptCookie($value)
    {
        return openssl_encrypt($value, 'aes-256-cbc', $this->encryption_key, 0, $this->encryption_key);
    }

    private function decryptCookie($value)
    {
        return openssl_decrypt($value, 'aes-256-cbc', $this->encryption_key, 0, $this->encryption_key);
    }



}

$cookie = new Cookie();
?>
