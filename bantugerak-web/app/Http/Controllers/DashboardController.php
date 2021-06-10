<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'title' => 'Hello World From DashboardController',
        ];

        return view('admin.pages.home', $data)->render();
    }
}
