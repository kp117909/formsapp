<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Surveys;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){

        $surveys = Surveys::query()
            ->orderByDesc('created_at')
            ->paginate(10);

        if (!Auth::check()) {
            return redirect()->route('auth.index');
        }

        return view('admin.index',['surveys' => $surveys]);
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

}
