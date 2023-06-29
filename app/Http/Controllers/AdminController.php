<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Surveys;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class AdminController extends Controller
{
    public function index(){

        $surveys = Surveys::query()->paginate(10);

        return view('admin.index',['surveys' => $surveys]);
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

}
