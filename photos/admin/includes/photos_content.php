<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <br><br><br><br><br><br><br><br><br>
            <h1 class="page-header">
                PHOTOS
                <small>Subheading</small>
            </h1>

            <div class="col-md-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Id</th>
                            <th>File Name</th>
                            <th>Title</th>
                            <th>size</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php

                    use includes\Photo;

                    $photos = Photo::find_all();
                    foreach ($photos as $photo):
                    ?>
                        <tr>
                            <td><img width="150" height="150" src="<?php echo $photo->picture_path(); ?>" alt="">
                                <div class="pictures_link">
                                    <a href="delete_photo.php/?id=<?php echo $photo->id; ?>">Delete</a>
                                    <a href="edit_photo.php/?id=<?php echo $photo->id; ?>">Edit</a>
                                    <a href="">View</a>
                                </div>
                            </td>
                            <td><?php echo $photo->id; ?></td>
                            <td><?php echo $photo->filename; ?></td>
                            <td><?php echo $photo->title; ?></td>
                            <td><?php echo $photo->size; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>