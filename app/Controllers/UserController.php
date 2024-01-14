<?php

namespace app\Controllers;

use app\Models\User;
use app\Models\Wiki;

class UserController extends Controller
{
    public function profile()
    {
        if (AuthController::user() && AuthController::user()['role'] === "author") {
            $user = User::select("id = " . AuthController::user()["id"]);
            $data = ['user' => $user];
            $wikis = Wiki::select("author_id = " . $user['id']);
            if (isset($wikis['id'])) $wikis = [$wikis];
            if(isset($wikis['id'])){
                $data['wikis'] = [$wikis];
            }else{
                $data['wikis'] = $wikis;
            }
            $this->render('profile', $data);
        } else {
            header('location: ' . $_ENV['APP_URL']);
        }
    }
}
