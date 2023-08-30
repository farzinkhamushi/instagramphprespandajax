<?php


class Like extends Obj
{
    protected static $table = "likes";
    protected static $table_fields = array('photo_id','liker_id','isliked');
    public $id;
    public $photo_id;
    public $liker_id;
    public $isliked = false;
}
?>