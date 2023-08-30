<?php

class Obj
{
    protected static $table = "";
    protected static $table_fields = array('','');
    /*
    protected static $table_fields = array('username', 'password', 'first_name', 'last_name');
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    */

    public static function find_all()
    {
        $sql = "select * from " . static::$table . " ";
        return static::find_by_query($sql);
    }

    public static function find_by_id($user_id)
    {
        $sql = "select * from " . static::$table . " where id = " . $user_id . " limit 1 ";
        $object_array = static::find_by_query($sql);
        return !empty($object_array) ? array_shift($object_array) : false;
    }

    public static function find_by_query($sql)
    {
        global $db;
        $associative_array = array();
        $result = $db->query($sql);
        while ($row = mysqli_fetch_array($result)) {
            $associative_array[] = static::instantiation($row);
        }
        return $associative_array;
    }

    public static function verify_user($username, $password)
    {
        global $db;
        $username = $db->escape_string($username);
        $password = $db->escape_string($password);
        $sql = " select * from " . static::$table . " where ";
        $sql .= " username = '{$username}' ";
        $sql .= " and password = '{$password}' ";
        $sql .= " limit 1";
        $the_result_array = static::find_by_query($sql);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }

    public static function instantiation($row)
    {
        $calling_class = get_called_class();
        $object = new $calling_class;
        foreach ($row as $attribute => $value) {
            if ($object->has_attribute($attribute)) {
                $object->$attribute = $value;
            }
        }
        return $object;
    }

    private function has_attribute($attr)
    {
        $prop = get_object_vars($this);
        return array_key_exists($attr, $prop);
    }


    protected function properties()
    {
        $properties = array();
        global $db;
        foreach (static::$table_fields as $db_field) {
            if (property_exists($this, $db_field)) {
                $properties[$db_field] = $db->escape_string($this->$db_field);
            }
        }
        return $properties;
    }

    public function save()
    {
        return isset($this->id) ? $this->update() : $this->create();
    }

    public function create()
    {
        global $db;
        $properties = $this->properties();
        $sql = "INSERT INTO " . static::$table . "(" . implode(",", array_keys($properties)) . ") ";
        $sql .= "VALUES ('" . implode("','", array_values($properties)) . "') ";
        if ($db->query($sql)) {
            $this->id = $db->the_insert_id();
            return true;
        } else {
            return false;
        }
    }

    public function update()
    {
        global $db;
        $prop = $this->properties();
        $prop_pairs = array();
        foreach ($prop as $key => $value) {
            $prop_pairs[] = "{$key}='" . $db->escape_string($this->$key) . "'";
        }
        $sql = "UPDATE " . static::$table . " SET ";
        $sql .= implode(", ", $prop_pairs);
        $sql .= " WHERE id= " . $db->escape_string($this->id);
        $db->query($sql);
        return (mysqli_affected_rows($db->connection) == 1) ? true : false;
    }
    public function delete()
    {
        global $db;
        $sql = "DELETE FROM " . static::$table . " ";
        $sql .= "WHERE id= " . $db->escape_string($this->id);
        $sql .= " LIMIT  1";
        $db->query($sql);
        return (mysqli_affected_rows($db->connection) == 1) ? true : false;
    }
}
?>