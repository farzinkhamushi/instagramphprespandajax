<?php //require_once("includes/header.php") ?>

<?php                
global $session;
if (isset($_POST['logout'])){
    $session->logout();
}
redirect("http://localhost/photos/login");

?>