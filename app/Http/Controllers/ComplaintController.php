<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function complaint() {
        $title = "Complaint";
        return view('user.complaint.complaint', compact('title'));
    }
}
