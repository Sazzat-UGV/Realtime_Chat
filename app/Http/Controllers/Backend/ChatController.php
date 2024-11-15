<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class ChatController extends Controller
{
    public function index()
    {
        return view('backend.pages.chat.index');
    }
}
