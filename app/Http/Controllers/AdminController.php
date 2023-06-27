<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Surveys;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){

        $surveys = Surveys::all();

        return view('admin.index',['surveys' => $surveys]);
    }
}
