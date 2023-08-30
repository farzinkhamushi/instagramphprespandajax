<script src="html/jq3/jquery-3.2.1.js"></script>
<link rel="stylesheet" type="text/css" href="bs3/css/bootstrap.min.css"/>
<script src="../bs3/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="style/all.css">
<link rel="stylesheet" type="text/css" href="style/body.css">
<link rel="stylesheet" type="text/css" href="style/nav.css">
<link rel="stylesheet" type="text/css" href="style/post.css">
<script src="jq3/jquery-3.2.1.js"></script>
<!-- --------------------------------------------------------- Login ---------------------------------------------- -->
<?php 
global $session; if (!$session->is_signed_in()) { redirect("login"); }
?>
<!------------------------------------------------------------- Router ------------------------------------------------>
<?php
$uri = $_SERVER['REQUEST_URI'];
if($uri == '/photos/index.php'){
    redirect('http://localhost/photos/');
    //require('routes/login.php');
}
?>
<!-- ---------------------------------------------------------- Users -------------------------------------------- -->
<?php
//$u1 = new User();
/*
        $u1 = User::find_by_id(7);
$u1->username = "ahmadi88";
$u1->password = "ah88ah88";
$u1->first_name = "mahmood";
$u1->last_name = "ahmadi nejad";
$u1->update();
*/
//$u1->create();
?>
<!-- ---------------------------------------------------------Upload  --------------------------------------------->
<?php
$message="";
if (isset($_POST['submit'])){
    $photo = new Photo();
    $photo->title = $_POST['title'];
    $photo->caption = $_POST['caption'];
    $photo->author = $session->user_id;
    $photo->set_file($_FILES['file_upload']);
    if ($photo->save()){
        $message = "Photo uploaded Successfully";
        unset($_FILES['file_upload']);
        unset($_POST['submit']);
    }else{
        $message = join("<br>",$photo->errors);
    }
    redirect("http://localhost/photos/");
    unset($_POST['submit']);
    //redirect("index.php");
}
?>
<div class="wrapper">
<!-- ---------------------------------------------------------Nav --------------------------------------- -->
    <nav>
        <ul>
            <li><a href="">Home</a></li>
            <li><a href="">About</a></li>
            <li><a href="">Store</a></li>
            <li><a href="">Contact</a></li>
        </ul>
        <ul class="social">
            <li><a href="" class="fb">Facebook</a></li>
            <li><a href="" class="tw">twitter</a></li>
        </ul>
    </nav>
<!-- -----------------------------------------------------------Logout ----------------------------------------->
<form action="logout" method="post">
    <input type="submit" name="logout" value="Log Out" style="background-color:#f00;color:#fff;border-style:none;padding: 3px;">
</form>
<!--  ------------------------------------------------------------Theme ---------------------------------------- -->
    <div class="them" style="margin: 20px;">
        <div>
            <span>Layout: </span>
            <a class="stack" style="color:#00b7ff;cursor: pointer;"><img width="17px" src="icons/stack.png" alt="" srcset=""></a>
            <a class="grid" style="color:#00b7ff;cursor: pointer;"><img width="17px" src="icons/grid.png" alt="" srcset=""></a>
        </div>
        <div>
            <a class="black_theme" style="color:#00b7ff;cursor: pointer;"><img width="17px" src="icons/moon.png" alt="" srcset=""></a>
            <a class="light_theme" style="color:#00b7ff;cursor: pointer;"><img width="17px" src="icons/sun.png" alt="" srcset=""></a>
        </div>
    </div>
<!--   ------------------------------------------------Posts  --------------------------------------------->
    <section id="blocks">
        <?php
        $photos = Photo::find_all();
        foreach ($photos as $photo):
        ?>
        <article>
            <div class="pictures_link">
                <a style="color: #1b6d85;" href="delete_photo.php/?id=<?php echo $photo->id; ?>">Delete</a>
                <a style="color: #1b6d85;" href="edit_photo.php/?id=<?php echo $photo->id; ?>">Edit</a>
                <a style="color: #1b6d85;" href="">View</a>
            </div>
            <img width="100%" src="<?php echo $photo->picture_path(); ?>" alt="">
            <div style="display: flex;justify-content: flex-start;">
                <a style="color: #1b6d85;padding: 5px;height: 30px" href="">
                    <img width="20px" height="20px" style="border-radius: 10px;" src="
                    <?php
                        $user=User::find_by_id($photo->author);
                        echo $user->profile;
                    ?>
                    ">
                    <?php
                        $user=User::find_by_id($photo->author);
                        echo $user->username;
                    ?>
                </a>
                <a style="transition: all 1s;opacity:1;padding: 5px; padding-left:10px; color: #709586;cursor:pointer; display: flex;flex-direction: row;height: 27px;">
                    <img style="width:17px;height: 17px" src="icons/sun.png" alt="" srcset="">
                    <p style="font-size: 1.2rem;" id="like_c<?php echo $photo->id; ?>" onclick="photo_like('<?php echo $photo->id; ?>','like_c<?php echo $photo->id; ?>',this)">
                        <?php
                            global $session;
                            $likes1 = Like::find_all();
                            $count1=0;
                            foreach($likes1 as $key=>$value){
                                if ($value->photo_id == $photo->id){
                                    if ($value->isliked){
                                        //echo "it is me I liked it : " . $value->liker_id . "<br>";
                                        $count1++;
                                    }
                                }
                            }
                            if($count1>1){
                                echo $count1." likes";
                            }else{
                                if($count1==1){
                                    echo $count1." like";
                                }else{
                                    echo "no like";
                                }
                            }
                        ?>
                    </p>
                </a>
            </div>
            <div style="max-width: 300px;display: flex;justify-content: center;">
                <p style="width: 100%;overflow: auto;"><?php echo $photo->caption; ?></p>
            </div>
        </article>
        <?php endforeach; ?>
    </section>
<br><br><br><br><br><br><br>
<!-- -----------------------------------------------------------------Form Upload ---------------------------------->
<?php echo $message; ?>
<form action="http://localhost/photos/" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <input type="text" name="title" class="form-control" placeholder="Write The Title">
    </div>
    <div class="form-group">
        <input type="text" name="caption" class="form-control" placeholder="Write The Caption">
    </div>
    <div class="form-group">
        <input type="file" name="file_upload">
    </div>
    <div class="form-group">
        <input type="submit" name="submit">
    </div>
</form>

</div><!----wrapper ends -->
<!-- ------------------------------------------------------------JQuery ------------------------------- -->
<script>
    $("a.stack").on("click",function(){
        $("article").addClass("stack");
    });
    $("a.grid").on("click",function(){
        $("article").removeClass("stack");
    });
    $("a.black_theme").on("click",function(){
        $("body").addClass("black_theme");
        $("body").removeClass("light_theme");
        $("article").addClass("black_theme");
        $("article").removeClass("light_theme");
    });
    $("a.light_theme").on("click",function(){
        $("body").addClass("light_theme");
        $("body").removeClass("black_theme");
        $("article").addClass("light_theme");
        $("article").removeClass("black_theme");
    });



    function photo_like(_photo_liked_id,clicked_id,_element){
        let el = document.getElementById(clicked_id);
        //el.style.opacity = 0;
        let post_data = "photo_liked_id="+_photo_liked_id;
        let url = "/photos/index.php";
        let xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function(){
            if(xmlHttp.readyState === 4){
                //alert(xmlHttp.responseURL);
                //alert(xmlHttp.responseText);
                let _text = xmlHttp.responseText;
                HandleResponse(_text,clicked_id,el);
            }
        }
        xmlHttp.open("POST",url,true);
        xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
        xmlHttp.send(post_data);
    }
    function HandleResponse(_text,clicked_id,el){
        let i = 0;
        let json_char="";
        let char = "";
        let _message = "";
        while(i<_text.length){
            char = _text.charAt(i);
            /*
            let x = "i : "+i+ " char : " +char+ " json-char : "+json_char ;
            alert(x);
            */
            if(char === "{"){
                while(char !== "}"){
                    char = _text.charAt(i);
                    json_char += char;
                    i++;
                }
            }
            i++;
        }
        //alert("this: "+json_char);
        let like_counts = JSON.parse(json_char);
        if(like_counts.message>1){
            _message = like_counts.message + " likes";
        }else{
            if(like_counts.message === 1){
                _message = like_counts.message + " like";
            }
            if(like_counts.message === 0){
                _message = "no like";
            }
        }
        el.innerHTML = _message;
        //el.style.opacity = 1;
        //alert(like_counts.message);
    }

       /* 
    function photo_like1(_photo_liked_id,_element){
        let url = "http://localhost/photos/routes/index.php";
        let xhr = getXMLHttp();
        xhr.onreadystatechange = function(res){
            if(xhr.readyState == 4){
                //_element.innerHTML = xhr.responseText;
                console.log(xhr.responseText);
                if (xhr.readyState === 4 && xhr.status === 200) {
                try {
                    const response = JSON.parse(xhr.responseText);
                    _element.innerHTML = response.message; // Assuming your JSON response has a 'message' property
                } catch (error) {
                    console.error("Error parsing JSON:", error);
                }
            }

            }
        }
        xhr.open("GET",url+ "?photo_liked_id="+_photo_liked_id,true);
        xhr.send(null);
    }
    */
</script>