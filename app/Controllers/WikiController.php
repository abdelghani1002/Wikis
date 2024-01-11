<?php


namespace app\Controllers;

use app\Models\Wiki;
use app\Controllers\Controller;
use app\Models\Category;
use app\Models\Tag;
use core\Validator;

class WikiController extends Controller
{
    public function index()
    {
        $wikis = Wiki::select();
        $this->render('dashboard/wiki/index', ['wikis' => $wikis]);
    }

    public function create()
    {
        $categories = Category::select();
        $tags = Tag::select();
        $this->render('dashboard/wiki/create', ['categories' => $categories, 'tags' => $tags]);
    }

    public function store()
    {
        if (isset($_POST) && isset($_FILES)) {
            $tags = $_POST['tags'];
            $title = $_POST['title'];
            $content = $_POST['content'];
            $author_id = 1; // Auth:user()['id'];
            $category_id = $_POST['category_id'];
            $photo = $_FILES['photo'];
            // echo "<pre>";
            // var_dump($_POST['category_id']);
            // echo "</pre>";exit;
            // Validation
            $data = [
                'title' => $title,
                'content' => $content,
            ];

            $rules = [
                'title' => 'required|username',
                'content' => 'required|text',
            ];

            if (isset($photo) && $photo['error'] !== 0) {
                $data['photo'] = $photo;
            }

            $validator = new Validator($data);
            $validator->validate($rules);

            if ($validator->fails()) {
                $errors = $validator->errors();
                session_start();
                $_SESSION['errors'] = $errors;
                header('location:' . $_SERVER['HTTP_REFERER']);
                return;
            }
            // store photo
            $isPhotoSaved = false;
            if (isset($photo) && $photo['error'] == null) {
                $photoName = $photo['name'];
                $photoTmpName = $photo['tmp_name'];
                $photoType = strtolower(pathinfo($photoName, PATHINFO_EXTENSION));

                $newPhotoName = uniqid("wiki_") . '.'  . $photoType;

                $photoUploadFolder = "public/images/wikis/";

                $photoDestination = $photoUploadFolder . $newPhotoName;
                $isPhotoSaved = move_uploaded_file($photoTmpName,  $photoDestination);
            }
            
            $isPhotoSaved ? $photoDestination = "/" . $photoDestination : $photoDestination = "";

            $wiki = new Wiki($title, $content, $photoDestination, (int)$author_id, (int)$category_id);
            
            if ($wiki->save($tags)) {
                session_start();
                $_SESSION['success']  = "Wiki posted successfully.";
                header('location:' . $_SERVER['HTTP_REFERER']);
                return;
            }

            session_start();
            $_SESSION['errors'] = ["Error withing creating the wiki !!"];
            header('location:' . $_SERVER['HTTP_REFERER']);
            return;
        }
    }

    public function edit()
    {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $wiki = Wiki::select("id = $id");
            $this->render("dashboard/wiki/edit", ['wiki' => $wiki]);
        }
    }

    public function update()
    {
        if (isset($_POST)) {
            $id = $_POST['id'];
            $photo_src = $_POST['photo_src'];
            $name = $_POST['name'];
            $slogan = $_POST['slogan'];
            $photo = $_FILES['photo'];

            // Validation
            $data = [
                'name' => $name,
            ];

            $rules = [
                'name' => 'required|name',
            ];

            if ($slogan !== "") {
                $data['slogan'] = $slogan;
                $rules['slogan'] = 'required|name';
            }

            if ($slogan !== "") {
                $data['slogan'] = $slogan;
                $rules['slogan'] = 'required|name';
            }

            if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
                $data['photo'] = $_FILES['photo'];
                $rules['photo'] = 'required|file';
            }

            $validator = new Validator($data);
            $validator->validate($rules);

            if ($validator->fails()) {
                $errors = $validator->errors();
                session_start();
                $_SESSION['errors'] = $errors;
                header('location:' . $_SERVER['HTTP_REFERER']);
                return;
            }

            $newData = [
                'name' => $name,
                'slogan' => $slogan
            ];

            if (isset($photo)) {
                unlink('.' . $photo_src);
                $photoName = $photo['name'];
                $photoTmpName = $photo['tmp_name'];
                $photoType = strtolower(pathinfo($photoName, PATHINFO_EXTENSION));

                $newPhotoName = uniqid("wiki_") . '.' . $photoType;

                $photoUploadFolder = "public/images/wikis/";

                $photoDestination = $photoUploadFolder . $newPhotoName;
                move_uploaded_file($photoTmpName,  $photoDestination);
                $newData['photo_src'] = "/" . $photoDestination;
            }

            if (Wiki::update($newData, $id)) {
                session_start();
                $_SESSION['success_update']  = "Category updated successfully.";
                header('location:' . $_ENV["APP_URL"] . "/dashboard/wikis");
                return;
            }
            session_start();
            $_SESSION['errors'] = "Error withing updating the category !!";
            header('location:' . $_ENV["APP_URL"] . "/dashboard/wikis");
            return;
        }
    }

    public function delete()
    {
        if (isset($_POST['id']) && Wiki::delete($_POST['id'])) {
            header("Location:" . $_SERVER['HTTP_REFERER']);
        }
    }
}
