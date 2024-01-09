<?php

namespace app\Models;

class Tag extends Model
{
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function save()
    {
        $data = get_object_vars($this);
        return parent::insertRecord('tags', $data);
    }

    public static function select($where = null)
    {
        if ($where === null)
            return Model::selectRecords("tags", "*", null, "created_at desc");
        return Model::selectRecords('tags', '*', $where, "created_at desc");
    }

    public static function update($data, $id)
    {
        return Model::updateRecord('tags', $data, $id);
    }

    public static function delete($id)
    {
        return Model::deleteRecord('tags', $id);
    }
}
