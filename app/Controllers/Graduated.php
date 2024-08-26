<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Graduated extends BaseController
{
    protected $filters = [
        'graduated_auth' => [],
    ];

    public function index()
    {
        return view('graduated_main');
    }
}