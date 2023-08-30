<?php
global $session;
$the_message="";
if ($session->is_signed_in()) {
    redirect("");
    //redirect("index.php");
}
if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    ///Method to check database user

    $user_found = User::verify_user($username,$password);
    //var_dump($user_found);
    if ($user_found){
        if(!($user_found->islogged)){
            $session->login($user_found);
            redirect("http://localhost/photos/");
            //redirect("index.php");
        }else {
            $the_message = "this account doesn't belong to you";
        }
    }else{
        $the_message = "Your password or username are incorrect";
    }


} else{
    $the_message = "";
    $username = "";
    $password = "";
}
?>

<div class="col-md-4 col-md-offset-3">
    <h4 class="bg-danger"><?php echo $the_message; ?></h4>
    <form action="" method="post">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" value="<?php echo htmlentities($username); ?>">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" value="<?php echo htmlentities($password); ?>">
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="Submit" class="btn btn-primary">
        </div>
    </form>
</div>