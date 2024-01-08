<?php

namespace app\Models;

class Category extends Model
{
    public $name;
    public $slogan;
    public $photo_src;

    public function __construct($name, $slogan, $photo_src)
    {
        $this->name = $name;
        $this->slogan = $slogan;
        $this->photo_src = $photo_src;
    }

    public function save()
    {
        $data = get_object_vars($this);
        return parent::insertRecord('categories', $data);
    }

    public static function select($where = null)
    {
        if ($where === null)
            return Model::selectRecords("categories");
        return Model::selectRecords('categories', '*', $where);
    }

    public static function update($data, $id)
    {
        return Model::updateRecord('categories', $data, $id);
    }

    public static function delete($id)
    {
        $category = Model::selectRecords('categories', '*', "id = $id");
        // remove photos
        unlink("." . $category['photo_src']);
        return Model::deleteRecord('categories', $id);
    }
}
