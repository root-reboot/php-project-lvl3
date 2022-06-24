<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function main()
    {
        return view('main');
    }
}
