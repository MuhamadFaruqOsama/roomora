<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function history() {
        $title = "History";
        return view('user.history.history', compact('title'));
    }
}
