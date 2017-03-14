<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TestRequest;

class TestController extends Controller
{
    public function test(TestRequest $request) {
        
        return redirect('/home')->with('_turbolinks_location', '/home');
    }
}
