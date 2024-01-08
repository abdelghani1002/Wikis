<?php
namespace app\Controllers;


class AdminController extends Controller
{
    public function dashboard() {
        $this->render('dashboard');
    }
}