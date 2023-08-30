<?php
require_once("../clases/config.php");
require_once("../clases/database.php");
require_once("../clases/obj.php");
require_once("../clases/user.php");
require_once("../clases/functions.php");
require_once("../clases/session.php");
?>
<link rel="stylesheet" href="../html/style.css">
<script src="../html/jq3/jquery-3.2.1.js"></script>
<link href="../bs3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script src="../bs3/js/bootstrap.min.js"></script>

<?php
$uri = $_SERVER['REQUEST_URI'];
if($uri == '/photos/login/'){
    require('../routes/login.php');
}
?>