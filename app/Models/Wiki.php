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
        if (self::saveTags($tags, $id))
            return true;
        return false;
    }

    public static function saveTags($tags_ids, $id)
    {
        try {
            foreach ($tags_ids as $tag_id) {
                $data = [
                    "wiki_id" => (int)$id,
                    "tag_id" => (int)$tag_id,
                ];
                parent::insertRecord("wiki_tags", $data);
            }
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function select($where = null)
    {
        $q =    "select w.id, w.title, w.content, w.photo_src as wiki_photo_src,
                    w.status, w.created_at as wiki_created_at, u.name as author_name,
                    u.photo_src as author_photo_src, c.name as category_name, c.photo_src as category_photo_src
                from wikis w
                left join users u
                    on w.`author_id` = u.`id`
                left JOIN categories c
                    on w.`category_id` = c.`id`
        ";
        if ($where !== null) {
            $q .= " WHERE $where";
        }
        $q .= " order by w.created_at desc";

        $wikis = parent::query($q);
        return $wikis;
    }

    public static function update($data, $tags, $id)
    {
        $res1 = parent::deleteRecord("wiki_tags", "wiki_id = $id");
        $res2 = self::saveTags($tags, $id);
        $res3 = parent::updateRecord('wikis', $data, $id);
        if ($res1 && $res2 && $res3) {
            return true;
        }
        return false;
    }

    public static function delete($id)
    {
        return
            parent::deleteRecord("wiki_tags", "wiki_id = $id")
            &&
            parent::deleteRecord('wikis', "id = $id");
    }
}