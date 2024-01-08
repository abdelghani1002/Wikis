<?php
namespace app\Controllers;

use app\Models\Category;

class AdminController extends Controller
{
    public function dashboard() {
        $this->render('dashboard/index');
    }
    
    public function categories() {
        $categories = Category::select();
        $this->render('dashboard/category/index', ['categories' => $categories]);
    }
}