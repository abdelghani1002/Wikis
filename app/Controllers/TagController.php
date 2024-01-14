<?php


namespace app\Controllers;

use app\Models\Tag;
use app\Controllers\Controller;
use core\Validator;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::select();
        if (isset($tags['id'])) $tags = [$tags];
        $this->render('dashboard/tag/index', ['tags' => $tags]);
    }

    public function store()
    {
        if (isset($_POST)) {
            $name = $_POST['name'];
            // Check if doesn't exists
            if (Tag::select("name = '$name'")) {
                session_start();
                $_SESSION['errors']['name'] = ["Tag already exists!"];
                header('location:' . $_SERVER['HTTP_REFERER']);
                return;
            }
            // Validation
            $data = [
                'name' => $name,
            ];

            $rules = [
                'name' => 'required|username',
            ];

            $validator = new Validator($data);
            $validator->validate($rules);

            if ($validator->fails()) {
                $errors = $validator->errors();
                session_start();
                $_SESSION['errors'] = $errors;
                header('location:' . $_SERVER['HTTP_REFERER']);
                return;
            }

            $tag = new tag($name);
            if ($tag->save()) {
                session_start();
                $_SESSION['success']  = "Tag created successfully.";
                header('location:' . $_SERVER['HTTP_REFERER']);
                return;
            }

            session_start();
            $_SESSION['errors']['name'] = ["Error withing creating the tag !!"];
            header('location:' . $_SERVER['HTTP_REFERER']);
            return;
        }
    }

    public function update()
    {
        if (isset($_POST)) {
            $id = $_POST['id'];
            $name = $_POST['name'];
            // Validation
            $data = [
                'name' => $name,
            ];

            $rules = [
                'name' => 'required|username',
            ];

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
            ];

            if (Tag::update($newData, $id)) {
                session_start();
                $_SESSION['success']  = "Tag updated successfully.";
                header('location:' . $_ENV["APP_URL"] . "/dashboard/tags");
                return;
            }
            session_start();
            $_SESSION['errors']['name'] = ["Error withing updating the tag !!"];
            header('location:' . $_ENV["APP_URL"] . "/dashboard/tags");
            return;
        }
    }

    public function delete()
    {
        if (isset($_POST['id']) && Tag::delete($_POST['id'])) {
            header("Location:" . $_SERVER['HTTP_REFERER']);
        }
    }
}
