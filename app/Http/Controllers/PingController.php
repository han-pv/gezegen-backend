<?php

namespace App\Http\Controllers;

use App\Models\Hotel\Hotel;
use Illuminate\Http\Request;

class PingController extends Controller
{
    public function hello()
    {
        $message = "Hello Web site";

        $hotels = Hotel::get();

        return view('welcome',compact('message', 'hotels'));
    }
}
