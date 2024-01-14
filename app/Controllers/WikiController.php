<?php


namespace app\Controllers;

use app\Models\Wiki;
use app\Controllers\Controller;
use app\Models\Category;
use app\Models\Model;
use app\Models\Tag;
use core\Validator;

class WikiController extends Controller
{
    public function index()
    {
        $wikis = Wiki::select("status = 'published'");
        $archived_wikis = Wiki::select("status = 'archived'");
        $this->render('dashboard/wiki/index', [
            'wikis' => $wikis,
            'archived_wikis' => $archived_wikis,
        ]);
    }

    public function create()
    {
        $categories = Category::select();
        $tags = Tag::select();
        $this->render('dashboard/wiki/create', ['categories' => $categories, 'tags' => $tags]);
    }

    public function store()
    {
        if (isset($_POST)) {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $author_id = 1; // Auth:user()['id'];
            $category_id = $_POST['category_id'];
            $tags = [];
            if (isset($_POST['tags'])) {
                $tags = $_POST['tags'];
            }

            if ($_FILES['photo']['tmp_name'] !== "") {
                $photo = $_FILES['photo'];
            }

            $data = [
                'title' => $title,
                'content' => $content,
            ];

            $rules = [
                'title' => 'required|username',
                'content' => 'required|text',
            ];

            if (isset($photo) && $photo['error'] !== null) {
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
            if (!empty($photo) && $photo['error'] !== null) {
                $photoName = $photo['name'];
                $photoTmpName = $photo['tmp_name'];
                $photoType = strtolower(pathinfo($photoName, PATHINFO_EXTENSION));

                $newPhotoName = uniqid("wiki_") . '.'  . $photoType;

                $photoUploadFolder = "public/images/wikis/";

                $photoDestination = $photoUploadFolder . $newPhotoName;
                $isPhotoSaved = move_uploaded_file($photoTmpName,  $photoDestination);
            }
            $photoDestination = "";
            if ($isPhotoSaved)
                $photoDestination = "/" . $photoDestination;

            $wiki = new Wiki($title, $content, $photoDestination, (int)$author_id, (int)$category_id);

            if ($wiki->save($tags)) {
                session_start();
                $_SESSION['success_create']  = "Wiki posted successfully.";
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
            $wiki = Wiki::select("w.id = $id");
            $tags = Tag::select();
            $categories = Category::select();
            $wiki_tags_ids = Model::selectRecords("wiki_tags", "tag_id", "wiki_id = $id");

            // Remove assosiative array
            if (count($wiki_tags_ids) === 1) {
                // Handle the single-element case differently, if needed
                $wiki_tags_ids = [$wiki_tags_ids['tag_id']];
            } else {
                $wiki_tags_ids = array_column($wiki_tags_ids, 'tag_id');
            }
            // echo "<pre>";
            // var_dump($wiki_tags_ids);
            // echo "</pre>";exit;

            $this->render("dashboard/wiki/edit", [
                'wiki' => $wiki,
                'tags' => $tags,
                'categories' => $categories,
                'wiki_tags_ids' => $wiki_tags_ids,
            ]);
        }
    }

    public function update()
    {
        if (isset($_POST) && isset($_FILES)) {
            $id = $_POST['id'];
            $tags = [];
            if (isset($_POST['tags'])) {
                $tags = $_POST['tags'];
            }
            $title = $_POST['title'];
            $content = $_POST['content'];
            $category_id = $_POST['category_id'];

            $data = [
                'title' => $title,
                'content' => $content,
            ];

            $rules = [
                'title' => 'required|username',
                'content' => 'required|text',
            ];

            if ($_FILES['photo']['tmp_name'] !== "") {
                $photo = $_FILES['photo'];
                $data['photo'] = $photo;
                $rules['photo'] = "file";
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
            // update photo if it's posted
            $photoDestination = "";
            if (isset($photo) && $photo['error'] == null) {
                if ($_POST['photo_src'] !== "" && file_exists(ltrim($_POST['photo_src'], "/"))) {
                    unlink(ltrim($_POST['photo_src'], "/"));
                }

                $photoName = $photo['name'];
                $photoTmpName = $photo['tmp_name'];
                $photoType = strtolower(pathinfo($photoName, PATHINFO_EXTENSION));

                $newPhotoName = uniqid("wiki_") . '.'  . $photoType;

                $photoUploadFolder = "public/images/wikis/";

                $photoDestination = $photoUploadFolder . $newPhotoName;
                move_uploaded_file($photoTmpName,  $photoDestination);
                $photoDestination = "/" . $photoDestination;
            }

            unset($data['photo']);
            $data["photo_src"] = $photoDestination;
            $data["category_id"] = $category_id;

            if (Wiki::update($data, $tags, $id)) {
                session_start();
                $_SESSION['success']  = "Wiki updated successfully.";
                // if (Auth::user()['role'] == admin) {
                header('location: ' . $_ENV['APP_URL'] . '/dashboard/wikis');
                // exit;
                // }
                // header('location: ' . $_ENV['APP_URL'] . '/wikis');                
                return;
            }
            session_start();
            $_SESSION['errors'] = [0 => "Error withing updating the wiki !!"];
            // if (Auth::user()['role'] == admin) {
            header('location: ' . $_SERVER['HTTP_REFERER']);
            // exit;
            // }
            // header('location: ' . $_ENV['APP_URL'] . '/wikis');
            return;
        }
    }

    public function delete()
    {
        if (file_exists(ltrim($_POST['photo_src'], "/")))
            unlink(ltrim($_POST['photo_src'], "/"));
        if (isset($_POST['id']) && Wiki::delete($_POST['id'])) {
            session_start();
            $_SESSION['success']  = "Wiki Removed successfully.";
            if (AuthController::user()['role'] == "admin") {
                header("Location:" . $_SERVER['HTTP_REFERER'] . "/dashboard/wikis");
                exit;
            }
            header('location: ' . $_ENV['APP_URL'] . '/profile');
        }
    }

    public function archive(){
        if (isset($_POST['id']) && AuthController::user()['role'] === "admin") {
            $id = $_POST['id'];
            if(Wiki::archive($id)){
                session_start();
                $_SESSION['success'] = "Wiki archived successfully.";
                header('location: ' . $_ENV['APP_URL'] . "/dashboard/wikis");
                exit;
            }
        }
        echo "error withing archive wiki !";
    }
}
