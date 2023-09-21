<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\courses;
use App\Models\user_quiz;

use App\Models\questions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function index()
    {
        $uid = Auth::user()->id;

        $topic_all = courses::get();
        $category_all = category::get();

        $user_quiz_topic_all = user_quiz::distinct()
            ->where('users_id', $uid)
            ->get('topics_id');

        foreach($topic_all as $topic){
            $tid = $topic->id;

            $count_ques[$tid] = questions :: where('topics_id', $tid)
                ->count();
            }

            // dd($count_ques);
        return view('home', compact('category_all', 'topic_all', 'user_quiz_topic_all', 'count_ques'));
    }
}