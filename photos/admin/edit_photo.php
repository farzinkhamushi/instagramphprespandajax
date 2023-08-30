<?php use includes\Photo;

require_once("includes/init.php"); ?>

    <link href="../../bs3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <script src="../../bs3/js/bootstrap.min.js"></script>
<?php if (!$session->is_signed_in()){redirect("login.php");} ?>
<?php
if (empty($_GET['id'])){
    redirect("photos.php");
}
else{
    $photo = Photo::find_by_id($_GET['id']);
    if (isset($_POST['update'])){
        if ($photo){
            $photo->title = $_POST['title'];
            $photo->caption =$_POST['caption'];
            $photo->alternate_text =$_POST['alternate_text'];
            $photo->description = $_POST['description'];
        }
    }
}
?>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">



        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="../../index.php" class="navbar-brand">Visit Home Page</a>
        </div>

        <ul class="nav navbar-right top-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-er"></i>one</a>
                <ul class="dropdown-menu message-dropdown">
                    <li class="message-preview">
                        <a href="#">
                            <div class="media">
                                <span class="pull-left">
                                    <img src="http://placehold.it/50*50" alt="" class="media-object">
                                </span>
                                <div class="media-body">
                                    <h5 class="meadia-heading">
                                        <strong>John smith</strong>
                                    </h5>
                                    <p class="small text-muted"><i class="fa fa-clock-o"></i></p>
                                    <p>Lorem ipsum dolor sit amet.</p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="message-preview">
                        <a href="">
                            <div class="media">
                                <span class="pull-left">
                                    <img src="http://placehold.it/50*50" alt="" class="media-object">
                                </span>
                                <div class="media-body">
                                    <h5 class="media-heading">
                                        <strong>John Smith</strong>
                                    </h5>
                                    <p class="small text-muted"><i class="fa fa-clock-o"></i></p>
                                    <p>Lorem ipsum dolor sit amet.</p>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li class="message-footer">
                        <a href="">Read All New Messages</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-be"></i>two</a>
                <ul class="dropdown-menu alert-dropdown">
                    <li>
                        <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                    </li>
                    <li>
                        <a href="">Alert Name <span class="label label-primary">Alert Badge</span></a>
                    </li>
                    <li><a href="">Alert Name <span class="label label-success">Alert Badge</span></a></li>
                    <li><a href="">Alert Name <span class="label label-info">Alert Badge</span></a></li>
                    <li><a href="">Alert Name <span class="label label-warning">Alert Badge</span></a></li>
                    <li><a href="">Alert Name <span class="label label-danger">Alert Badge</span></a></li>
                    <li class="divider"></li>
                    <li>
                        <a href="">View All</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href=""><i class="fa fa-us"></i>three</a>
                <ul class="">  <!-- dropdown-menu -->
                    <li>
                        <a href=""><i class="fa fa-fw fa-user"></i> Profile</a>
                    </li>
                    <li>
                        <a href=""><i class="fa fa-fw fa-envelope"></i> Inbox</a>
                    </li>
                    <li>
                        <a href=""><i class="fa fa-fw fa-gear"></i> Settings</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="../routes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                    </li>
                </ul>
            </li>
        </ul>









        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav navbar-left">
                <li>
                    <a href="../routes/index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                </li>
                <li>
                    <a href="../users.php"><i class="fa fa-fw fa-bar-chart-o"></i>Users</a>
                </li>
                <li>
                    <a href="../upload.php"><i class="fa fa-fw fa-table"></i> Upload</a>
                </li>
                <li>
                    <a href="../photos.php"><i class="fa fa-fw fa-table"></i> Photos</a>
                </li>
                <li>
                    <a href="../comments.php"><i class="fa fa-fw fa-edit"></i> Comments</a>
                </li>
            </ul>
        </div>









    </nav>

    <br><br><br><br><br><br><br><br><br>
    <div class="container" id="page-wrapper" style="margin-top:40px">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Edit Photo
                        <small>Subheading</small>
                    </h1>

                    <div class="col-md-8">
                        <div class="form-group">
                            <input type="text" name="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="caption">Caption</label>
                            <input type="text" name="caption" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="caption">Alternative Text</label>
                            <input type="text" name="alternate_text" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="caption">Description</label>
                            <textarea type="text" name="description" class="form-control" cols="30" rows="30">

                            </textarea>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php include("includes/footer.php"); ?>