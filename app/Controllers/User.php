<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class User extends BaseController
{
    protected $filters = [
        'user_auth' => [],
    ];

    public function index()
    {
        return view('accountant_main');
    }

}