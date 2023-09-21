<?php

namespace App\Http\Controllers;
use App\Models\category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $data['category'] = category::get(["category_name", "id"]);

        return view('adminHome', $data);
    }
}
