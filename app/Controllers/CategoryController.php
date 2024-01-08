<?php


namespace app\Controllers;

use app\Models\Category;
use app\Controllers\Controller;
use core\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::select();
        $this->render('dashboard/category/index', ['categories' => $categories]);
    }

    public function create()
    {
        $this->render('dashboard/category/create');
    }

    public function store()
    {
        if (isset($_POST) && isset($_FILES)) {
            $name = $_POST['name'];
            $slogan = $_POST['slogan'];
            $photo = $_FILES['photo'];

            // Validation
            $data = [
                'name' => $name,
                'photo' => $photo,
            ];
            
            $rules = [
                'name' => 'required|name',
                'photo' => 'required|file',
            ];
            
            if ($slogan !== ""){
                $data['slogan'] = $slogan;
                $rules['slogan'] = 'required|name';
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
            $photoName = $photo['name'];
            $photoTmpName = $photo['tmp_name'];
            $photoType = strtolower(pathinfo($photoName, PATHINFO_EXTENSION));

            $newPhotoName = uniqid("category_") . '.'  . $photoType;

            $photoUploadFolder = "public/images/categories/";

            $photoDestination = $photoUploadFolder . $newPhotoName;
            $isPhotoSaved = move_uploaded_file($photoTmpName,  $photoDestination);

            $category = new Category($name, $slogan, '/' . $photoDestination);
            if ($isPhotoSaved && $category->save()) {
                session_start();
                $_SESSION['success']  = "Category created successfully.";
                header('location:' . $_SERVER['HTTP_REFERER']);
                return;
            }

            session_start();
            $_SESSION['errors'] = "Error withing creating the category !!";
            header('location:' . $_SERVER['HTTP_REFERER']);
            return;
        }
    }

    public function edit()
    {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $category = Category::select("id = $id");
            $this->render("dashboard/category/edit", ['category' => $category]);
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

            if ($slogan !== ""){
                $data['slogan'] = $slogan;
                $rules['slogan'] = 'required|name';
            }
            
            if ($slogan !== ""){
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

                $newPhotoName = uniqid("category_") . '.' . $photoType;

                $photoUploadFolder = "public/images/categories/";

                $photoDestination = $photoUploadFolder . $newPhotoName;
                move_uploaded_file($photoTmpName,  $photoDestination);
                $newData['photo_src'] = "/" . $photoDestination;
            }

            if (Category::update($newData, $id)) {
                session_start();
                $_SESSION['success_update']  = "Category updated successfully.";
                header('location:' . $_ENV["APP_URL"] . "/dashboard/categories");
                return;
            }
            session_start();
            $_SESSION['errors'] = "Error withing updating the category !!";
            header('location:' . $_ENV["APP_URL"] . "/dashboard/categories");
            return;
        }
    }

    public function delete()
    {
        if (isset($_POST['id']) && Category::delete($_POST['id'])) {
            header("Location:" . $_SERVER['HTTP_REFERER']);
        }
    }
}