<?php

namespace app\Controllers;

use app\Models\Category;
use app\Models\Tag;
use app\Models\User;
use app\Models\Wiki;

class AdminController extends Controller
{
    public function dashboard()
    {
        if (AuthController::user() && AuthController::user()['role'] === "admin") {
            $wikis_count = count(Wiki::select("status = 'published'"));
            $archived_wikis_count = count(Wiki::select("status = 'archived'"));
            $categories_count = count(Category::select());
            $tags_count = count(Tag::select());
            $authors_count = count(User::select("role = 'author'"));
            $data = [
                'wikis_count' => $wikis_count,
                'archived_wikis_count' => $archived_wikis_count,
                'categories_count' => $categories_count,
                'tags_count' => $tags_count,
                'authors_count' => $authors_count,
            ];
            $this->render('dashboard/index', $data);
        } else {
            header('location: ' . $_ENV['APP_URL']);
        }
    }
}
