<?php

namespace App\Controllers;

use App\Models\User;

class HomeController extends Controller
{
    protected User $model;
    public function __construct()
    {
        $this->model = new User();
    }
    public function index()
    {
        $users = $this->model->all();
        $this->loadView('Home', compact('users'));
    }
}
