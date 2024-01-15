<?php

namespace app\Controllers;

use app\Controllers\Controller;
use core\Validator;
use app\Models\User;

class AuthController extends Controller
{
    function login_page()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!self::user())
            $this->render('auth/login');

        else if (self::user()['role'] === "admin")
            header("location: " . $_ENV['APP_URL'] . "/dashboard");
        else
            header("location: " . $_ENV['APP_URL']);
    }

    function signup_page()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!self::user())
            $this->render('auth/signup');

        else if (self::user()['role'] === "admin")
            header("location: " . $_ENV['APP_URL'] . "/dashboard");
        else
            header("location: " . $_ENV['APP_URL'] . "/profile?id=" . self::user()['id']);
    }

    function signin()
    {
        $errors = [];
        $email = $_POST['email'];
        $password = $_POST['password'];
        if (empty($email) || empty($password)) {
            $errors['data'] = "insert all your information";
        } else {
            $data = [
                'email' => $email,
                'password' => $password
            ];

            $rules = [
                'email' => "required|email",
                'password' => "required|password"
            ];

            $validator = new Validator($data);
            $validator->validate($rules);
            if ($validator->fails()) {
                $errors = $validator->errors();
            }
        }
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (count($errors) == 0) {
            $userdata = User::select("email = '$email'");
            if (count($userdata) == 0) {
                $errors['data'] = "It's look like you're not yet a member! Click on the bottom link to signup.";
            } else if (password_verify($password, $userdata['password'])) {

                $_SESSION['user'] = $userdata;
                if ($userdata['role'] === "admin") {
                    header("location: " . $_ENV['APP_URL'] . "/dashboard");
                    exit;
                }
                header("location: " . $_ENV['APP_URL'] . "/profile?id=" . $userdata['id']);
                exit;
            } else {
                $errors['data'] = "Incorrect email or password!";
            }
        }
        $_SESSION['errors'] = $errors;
        header("location: " . $_ENV['APP_URL'] . "/login");

    }

    function register()
    {
        $errors = [];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (empty($username) || empty($email) || empty($password)) {
            $errors['data'] = "insert all your information";
        } else {
            $data = [
                'username' => $username,
                'email' => $email,
                'password' => $password
            ];

            $rules = [
                'username' => "required|username",
                'email' => "required|email",
                'password' => "required|password"
            ];

            $validator = new Validator($data);
            $validator->validate($rules);
            if ($validator->fails()) {
                $errors = $validator->errors();
            }

            if (!empty(User::select("email = '$email'"))) {
                $errors['email'] = ["this email already exists"];
            }
        }
        session_start();
        if (count($errors) == 0) {
            $password = password_hash($password, PASSWORD_BCRYPT);
            $user = new User($username, $email, $password);
            $id = $user->save();
            if ($id) {
                $_SESSION['user'] = User::select("id = $id");
                header('location: ' . $_ENV['APP_URL'] . "/profile?id=$id");
                exit;
            }
        }
        $_SESSION['errors'] = $errors;
        header('location: ' . $_ENV['APP_URL'] . '/signup');
    }

    function logout()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        unset($_SESSION['user']);
        session_destroy();
        header('location: ' . $_ENV['APP_URL']);
    }

    public static function user()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user']))
            return null;

        return $_SESSION['user'];
    }
}
