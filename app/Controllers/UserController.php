<?php

namespace App\Controllers;

use App\Models\User;

class UserController extends Controller
{
    private User $model;
    public function __construct()
    {
        $this->model = new User();
    }
    public function show(array $params)
    {
        $user = $this->model->find('id', $params['id']);
        $this->loadView('users/show', compact('user'));
    }
}