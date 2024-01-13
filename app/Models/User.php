<?php

namespace app\Models;

class User extends Model
{
    public $name;
    public $email;
    public $password;

    public function __construct($name, $email, $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }
    
    public static function select($where = null)
    {
        return Model::selectRecords('users', '*', $where, "created_at desc");
    }
    
    public function save()
    {
        $data = get_object_vars($this);
        return parent::insertRecord('users', $data);
    }

    public static function update($data, $id)
    {
        return Model::updateRecord('users', $data, $id);
    }

    public static function delete($id)
    {
        return Model::deleteRecord('users', "id = $id");
    }
}
