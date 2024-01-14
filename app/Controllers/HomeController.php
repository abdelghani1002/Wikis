<?php
namespace app\Controllers;

use app\Models\Wiki;

class HomeController extends Controller
{
    public function index() {
        $wikis = Wiki::select(null, 5);
        if (isset($wikis['id'])) $wikis = [$wikis];
        $this->render('home', ['wikis' => $wikis]);
    }

    public function notFound(){
        $this->render('404');
    }
}