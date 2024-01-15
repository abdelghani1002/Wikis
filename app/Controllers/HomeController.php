<?php

namespace app\Controllers;

use app\Models\Category;
use app\Models\Wiki;

class HomeController extends Controller
{
    public function index()
    {
        $wikis = Wiki::select(null, 5);
        if (isset($wikis['id'])) $wikis = [$wikis];
        $this->render('home', ['wikis' => $wikis]);
    }

    public function notFound()
    {
        $this->render('404');
    }

    public function search()
    {
        $categories = Category::select();
        if (isset($categories['id'])) $categories = [$categories];

        $wikis = Wiki::select();
        if (isset($wikis['id'])) $wikis = [$wikis];

        $data = [
            'categories' => $categories,
            'wikis' => $wikis,
        ];

        $this->render("search", $data);
    }

    public function wikis()
    {
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            // $wikis = Wiki::select("title like '%" . $search . "%'");
            // if (count($wikis) != 0) {
            //     if (isset($wikis['id'])) $wikis = [$wikis];
            //     echo json_encode($wikis);
            //     exit;
            // }
            
            $wikis = Wiki::select();
            if (isset($wikis['id'])) $wikis = [$wikis];
            $res = [];
            foreach ($wikis as &$wiki) {
                $add = false;
                foreach ($wiki['tags'] as &$tag) {
                    if (str_contains($tag['name'], $search)) {
                        $add = true;
                        break;
                    }
                }
                if ($add)  $res[] = &$wiki;
            }
            echo json_encode($res);
        }

        if (isset($_GET['category_id'])) {
            $category_id = $_GET['category_id'];
            $wikis = Wiki::select("category_id = '$category_id'");
            if ($wikis !== null) {
                if (isset($wikis['id'])) $wikis = [$wikis];
                echo json_encode($wikis);
            }
        }
    }
}
