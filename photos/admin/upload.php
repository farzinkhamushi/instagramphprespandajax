<?php

include("includes/header.php"); ?>
<?php  if (!$session->is_signed_in()) { redirect("login.php"); } ?>

<?php
$message="";
if (isset($_POST['submit'])){
    $photo = new Photo();
    $photo->title = $_POST['title'];
    $photo->set_file($_FILES['file_upload']);

    if ($photo->save()){
        $message = "Photo uploaded Successfully";
    }else{
        $message = join("<br>",$photo->errors);
    }
}
?>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <?php include("includes/top_nav.php") ?>
    <?php include("includes/side_nav.php") ?>
</nav>
<div class="container" id="page-wrapper" style="margin-top:40px">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    UPLOAD
                    <small>Subheading</small>
                </h1>
                <br><br><br><br><br><br><br>
                <?php echo $message; ?>
                <form action="upload.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="file" name="file_upload">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    //include("includes/upload_content.php")
    ?>

</div>
<?php include("includes/footer.php"); ?>