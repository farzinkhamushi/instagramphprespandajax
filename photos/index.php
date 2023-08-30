<!-- -------------------------------------------------Initialize --------------------- -->
<?php
defined('DS') ? null : define('DS' , DIRECTORY_SEPARATOR);
define('SITE_ROOT' , 'D:'.DS.'wamp64'.DS.'www'.DS.'photos');
require_once("clases/config.php");
require_once("clases/database.php");
require_once("clases/obj.php");
require_once("clases/user.php");
require_once("clases/photo.php");
require_once("clases/functions.php");
require_once("clases/session.php");
require_once ("clases/like.php");
?>
<!------------------------------------------------------Router----------------------------->
<?php
$uri = $_SERVER['REQUEST_URI'];
if(($uri == '/photos/') || ($uri == '/photos/index.php')){
    //<!--------------------------------------------------------Likes---------------------------->
    if (isset($_POST['photo_liked_id'])){
        function like_count(){
            $likes1 = Like::find_all();
            $count1=0;
            foreach($likes1 as $key=>$value){
                if ($value->photo_id == $_POST['photo_liked_id']){
                    if ($value->isliked){
                        $count1++;
                    }
                }
            }
            $response = array('message' => $count1);
            header('Content-Type: application/json');
            echo json_encode($response);
            exit;
        }

        global $session;
        $likes = Like::find_all();
        $fix=0;
        $fix1=0;
        foreach ($likes as $key=>$value){
            if($value->liker_id == $session->user_id){
                if(($value->photo_id == $_POST['photo_liked_id']) ){
                    $fix++;
                    //echo "Yes photo_id : {$value->photo_id} and get {$_GET['photo_liked_id']} fix : {$fix} fix1 : {$fix1}<br>";
                    if ($value->isliked){
                        $value->isliked = false;
                    }else{
                        $value->isliked = true;
                    }
                    $value->update();
                    like_count();
                    unset($_POST['photo_liked_id']);
                }else{
                    //echo "No photo_id : {$value->photo_id} and get {$_GET['photo_liked_id']}  fix : {$fix} fix1 : {$fix1}<br>";
                }
            }
        }
        if ($fix==0){
            $like1 = new Like();
            $like1->photo_id = $_POST['photo_liked_id'];
            $like1->liker_id = $session->user_id;
            $like1->isliked = true;
            $like1->create();
            like_count();
            unset($_POST['photo_liked_id']);
        }
    }
    require('routes/index.php');
    //require('routes/login.php');
}
if($uri == '/photos/login'){
    require('routes/login.php');
}
if($uri == '/photos/logout'){
    require('routes/logout.php');
}
?>
