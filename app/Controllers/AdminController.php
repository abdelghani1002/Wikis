<?php

namespace app\Controllers;

use app\Models\Category;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (AuthController::user() && AuthController::user()['role'] === "admin") {
            $this->render('dashboard/index');
        } else {
            header('location: ' . $_ENV['APP_URL']);
        }
    }
}
