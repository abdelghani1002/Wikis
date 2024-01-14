<?php

namespace app\Controllers;

class UserController extends Controller
{
    public function profile()
    {
        if (AuthController::user() && AuthController::user()['role'] === "author") {
            $this->render('profile');
        } else {
            header('location: ' . $_ENV['APP_URL']);
        }
    }
}
