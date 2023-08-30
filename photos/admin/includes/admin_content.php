<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                ADMIN
                <small>Subheading</small>
            </h1>

            <?php 
            
            /*
            $users = User::find_all_users();
            foreach ($users as $user) {
                echo $user->id . "<br>";
            }
            $found_user = User::find_user_by_id(2);
            echo $found_user->username
            */

            /*
            $usernumber1 = User::find_user_by_id(1);
            $usernumber1->last_name = "wiliams";
            $usernumber1->update();
            */

            /*
            $usernumber2 = User::find_user_by_id(2);
            $usernumber2->delete();
            */

            //$u1 = User::find_user_by_id(15);
            //$u1 = new User();
            //$u1->username = "farzin28";
            //$u1->password = "ffffff";
            //$u1->first_name = "farzin";
            //$u1->last_name = "khamushi";
            //$u1->update();
            //$u1->create();

            //$db_object = new Db_object();
            use includes\Photo;

            $db_objects= Photo::find_all();
            echo "<br><br><br><br><br><br>";
            foreach ($db_objects as $db_object){
                echo $db_object->username . "<br>";
            }

            ?>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i> <a href="index.html">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Blank Page
                </li>
            </ol>
        </div>
    </div>
</div>