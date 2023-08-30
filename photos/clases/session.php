<?php

require_once ("database.php");
class Session
{
    private $signed_in = false;
    public $user_id;
    function __construct()
    {
        session_start();
        //setcookie('session_name','session_id', time() + $timeout);
        // Session timeout after 6 months (180 days)
        $timeout = 180 * 24 * 60 * 60;
        session_set_cookie_params($timeout);
        $this->check_the_login();
    }
    public function is_signed_in()
    {
        return $this->signed_in;
    }
    public function login($user)
    {
        if ($user) {
            $this->user_id = $_SESSION['user_id'] = $user->id;
            $user->islogged = true;
            $user->update();
            $this->signed_in = true;
        }
    }
    public function logout()
    {
        $user = User::find_by_id($_SESSION['user_id']);
        $user->islogged = false;
        $user->update();
        unset($_SESSION['user_id']);
        unset($this->user_id);
        $this->signed_in = false;
    }
    private function check_the_login()
    {
        if (isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
            $this->signed_in = true;
        } else {
            unset($this->user_id);
            $this->signed_in = false;
        }
    }
}
$session = new Session();
?>