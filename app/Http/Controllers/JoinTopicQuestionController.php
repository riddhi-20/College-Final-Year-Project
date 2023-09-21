<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\courses;
use DataTables;

class JoinTopicQuestionController extends Controller
{
    public function index(Request $request)
    {
    	$data = courses::join('questions', 'questions.topics_id', '=', 'cat_topic.id')
                    ->orderBy('cat_topic.topic_name', 'ASC')
                    ->whereNull('questions.deleted_at')
              		->get();

        return view('viewquestions',compact('data'));
    }

    public function edit($id)
    {
        $courses_all=courses::all();

    	$data = courses::join('questions', 'questions.topics_id', '=', 'cat_topic.id')
                    ->where('questions.id',$id)
                    ->whereNull('questions.deleted_at')
                    ->get();

        return view('editquestions', compact('data', 'courses_all'));
    }
}

