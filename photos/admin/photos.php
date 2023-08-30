<?php include("includes/header.php"); ?>
<?php  if (!$session->is_signed_in()) { redirect("login.php"); } ?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <?php include("includes/top_nav.php") ?>
    <?php include("includes/side_nav.php") ?>
</nav>
<div class="container" id="page-wrapper" style="margin-top:40px">
    <?php include("includes/photos_content.php") ?>
</div>
<?php include("includes/footer.php"); ?>