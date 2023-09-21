<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\courses;
use App\Models\user_quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $uid = Auth::user()->id;
        $topic_all = courses::all();


        $user_quiz_topic_all = user_quiz::where('users_id', $uid)
            ->pluck('topics_id')
            ->get()
            ->toArray();

        return view('home', compact('topic_all', 'user_quiz_topic_all'));
    }

    public function adminHome()
    {
        $data['category'] = category::get(["category_name", "id"]);

        return view('adminHome', $data);
    }
}
