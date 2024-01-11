<?php

namespace app\Models;

use PDOException;

class Wiki extends Model
{
    public $title;
    public $content;
    public $photo_src;
    public $author_id;
    public $category_id;

    public function __construct($title, $content, $photo_src, $author_id, $category_id)
    {
        $this->title = $title;
        $this->content = $content;
        $this->photo_src = $photo_src;
        $this->author_id = $author_id;
        $this->category_id = $category_id;
    }

    public function save($tags)
    {
        $data = get_object_vars($this);
        $id = parent::insertRecord('wikis', $data);
        if ($this->saveTags($tags, $id))
            return true;
        return false;
    }

    public function saveTags($tags_ids, $id)
    {
        try{
            foreach($tags_ids as $tag_id){
                $data = [
                    "wiki_id" => (int)$id,
                    "tag_id" => (int)$tag_id,
                ];
                parent::insertRecord("wiki_tags", $data);
            }
            return true;
        }catch(PDOException $e){
            echo $e->getMessage();
            return false; 
        }
    }

    public static function select($where = null)
    {
        $wikis = parent::selectRecords('wikis', '*', $where, "`created_at` desc");
        foreach ($wikis as &$wiki) {
            $author = parent::selectRecords("users", '*', "id = " . $wiki['author_id']);
            $category = Category::select("id = " . $wiki['category_id']);
            $wiki['author'] = $author;
            $wiki['category'] = $category;
        }
        return $wikis;
    }

    public static function update($data, $id)
    {
        return parent::updateRecord('wikis', $data, $id);
    }

    public static function delete($id)
    {
        $category = parent::selectRecords('wikis', '*', "id = $id");
        // remove photo
        unlink("." . $category['photo_src']);
        return parent::deleteRecord('wikis', $id);
    }
}
