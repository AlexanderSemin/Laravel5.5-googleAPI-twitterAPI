<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Thujohn\Twitter\Twitter;

class TwitterController extends Controller
{
    //
    public function index(){

        return View('index');
    }
}
