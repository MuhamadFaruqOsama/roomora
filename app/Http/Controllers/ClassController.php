<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function class() {
        $title = "Class";
        return view('user.class.class', compact('title'));
    }
}
