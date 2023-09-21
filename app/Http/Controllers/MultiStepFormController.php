<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\questions;
use App\Models\user_quiz;

class MultiStepFormController extends Controller
{
    public function index()
    {
        $test_id = session()->get('test_id');

        $uid = Auth::user()->id;

        $qids = user_quiz::latest()
            ->where('users_id', $uid)
            ->where('test_id', $test_id)
            ->get()
            ->pluck('question_id');

        $data_new = questions::join('user_quiz', 'user_quiz.question_id', '=', 'questions.id')
            ->join('cat_topic', 'user_quiz.topics_id', '=', 'cat_topic.id')
            ->where('user_quiz.test_id', $test_id)
            ->where('user_quiz.users_id', $uid)
            ->whereIn('user_quiz.question_id', $qids)
            ->get(['user_quiz.id', 'user_quiz.question_id', 'questions.question', 'questions.optionA', 'questions.optionB', 'questions.optionC', 'questions.optionD', 'questions.correctAns']);

        return view('takequiz', compact('data_new'));
    }
}
