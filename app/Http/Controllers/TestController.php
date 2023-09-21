<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\courses;
use App\Models\questions;
use App\Models\user_quiz;
use App\Models\results;
use Illuminate\Http\Request;


class TestController extends Controller
{
    public function index($id)
    {
        $uid = Auth::user()->id;

        $cat_id = courses::with('getcategory')->where('id', $id)->first();
        $category_name = $cat_id['getcategory']['category_name'];
       
        $qids = user_quiz::latest()
            ->where('users_id', $uid)
            ->where('topics_id', $id)
            ->get()
            ->pluck('question_id');

        $data = courses::join('questions', 'questions.topics_id', '=', 'cat_topic.id')
            ->where('cat_topic.id', $id)
            ->whereNotIn('questions.id', $qids)
            ->where('cat_topic.id', $id)
            ->whereNull('questions.deleted_at')
            ->get(['questions.id', 'questions.question', 'questions.topics_id', 'cat_topic.topic_name', 'questions.question', 'questions.optionA', 'questions.optionB', 'questions.optionC', 'questions.optionD', 'questions.correctAns'])
            ->random(10);
        
        $test_id_old = user_quiz::latest('test_id')
            ->where('users_id', $uid)
            ->pluck('test_id')
            ->first();

        $test_id_no = user_quiz::latest('test_id')
            ->where('users_id', $uid)
            ->first();

        if (!is_Null($test_id_old)) {
            $test_id = $test_id_old + 1;
        }
        if (is_Null($test_id_no)) {
            $test_id = 1;
        }

        foreach ($data as $key) {
            user_quiz::create([
                'users_id' => $uid,
                'test_id' => $test_id,
                'topics_id' => $key->topics_id,
                'question_id' => $key->id,
                'correctAns' => $key->correctAns,
            ]);
        }

        session()->put('test_id', $test_id);
        session()->put('topics_id', $id);
        session()->put('category_name', $category_name);

        return redirect()->route('test.show');
    }

    // public function show()
    // {
    //     $test_id = session()->get('test_id');

    //     $uid = Auth::user()->id;

    //     $qids = user_quiz::latest()
    //     ->where('users_id', $uid)
    //     ->where('test_id', $test_id)
    //     ->get()
    //     ->pluck('question_id');

    //     $data_new = questions::join('user_quiz', 'user_quiz.question_id', '=', 'questions.id')
    //         ->join('cat_topic', 'user_quiz.topics_id', '=', 'cat_topic.id')
    //         ->where('user_quiz.test_id', $test_id)
    //         ->where('user_quiz.users_id', $uid)
    //         ->whereIn('user_quiz.question_id', $qids)
    //         ->get(['user_quiz.id', 'user_quiz.question_id', 'questions.question', 'questions.optionA', 'questions.optionB', 'questions.optionC', 'questions.optionD', 'questions.correctAns']);

    //     return view('taketest', compact('data_new'));
    // }

    public function update(Request $request)
    {
        $uid = Auth::user()->id;

        $test_id = session()->get('test_id');
        $topics_id = session()->get('topics_id');
        $category_name = session()->get('category_name');

        foreach ($request->quiz_id as $value) {
            $quiz = user_quiz::find($value);

            if (!empty($request->option[$value]) == true) {
                $quiz->givenAns = $request->option[$value];
                $quiz->update();
            }
        }

        if ($category_name != 'Psychometric') {
            $test_data = DB::table('user_quiz')
                ->select(DB::raw("(select count(`question_id`) from `user_quiz` where test_id=" . $test_id . " and users_id=" . $uid . ") as totalque"), DB::raw('(select count(*) from `user_quiz` where `correctAns`=`givenAns` AND test_id=' . $test_id . ' and users_id=' . $uid . ') as rightans'), DB::raw('(select count(*) from `user_quiz` where `givenAns` IS NULL AND test_id=' . $test_id . ' and users_id=' . $uid . ') as skipped'))
                ->where('test_id', $test_id)
                ->where('users_id', $uid)
                ->get();

            $total_questions = $test_data[0]->totalque;
            $total_rightans = $test_data[0]->rightans;
            $total_skipped = $test_data[0]->skipped;
            $total_opt_count = 0;
        } else {

            $total_questions = user_quiz::select(`question_id`)
                ->where('test_id', $test_id)
                ->where('users_id', $uid)
                ->count();

            $rightans = user_quiz::select(`question_id`)
                ->whereColumn('correctAns', 'givenAns')
                ->where('test_id', $test_id)
                ->where('users_id', $uid)
                ->count();

            $wrongans = user_quiz::select(`question_id`)
                ->whereColumn('correctAns', '!=', 'givenAns')
                ->where('givenAns', '!=', 'C')
                ->where('test_id', $test_id)
                ->where('users_id', $uid)
                ->count();

            $total_skipped = user_quiz::select(`question_id`)
                ->whereNull('givenAns')
                ->where('test_id', $test_id)
                ->where('users_id', $uid)
                ->count();

            $total_rightans = -($wrongans) + $rightans;

            $opt_count = DB::table('user_quiz')
                ->select(DB::raw("(select count(`question_id`) from `user_quiz` where `givenAns` = 'A' and test_id=" . $test_id . " and users_id=" . $uid . ") as agree"), DB::raw("(select count(question_id) from `user_quiz` where `givenAns` = 'B' and test_id=" . $test_id . " and users_id=" . $uid . ") as disagree"), DB::raw("(select count(question_id) from `user_quiz` where `givenAns` = 'C' and test_id=" . $test_id . " and users_id=" . $uid . ") as cant"))
                ->where('test_id', $test_id)
                ->where('users_id', $uid)
                ->get();

            $total_opt_count = "Agree : ". $opt_count[0]->agree ." Disagree : ". $opt_count[0]->disagree ." Can't Say : ". $opt_count[0]->cant ;
        }

        $result = new results;
        $result->users_id = $uid;
        $result->test_id = $test_id;
        $result->topics_id = $topics_id;
        $result->total_ques = $total_questions;
        $result->total_corr_ans = $total_rightans;
        $result->total_skip = $total_skipped;
        $result->total_opt_count = $total_opt_count;
        $result->save();

        session()->forget('test_id');
        session()->forget('topics_id');

        $message = "Times Up!! Test Submitted Successfully!!    Total Question : " . $total_questions . "    Correctly Answered : " . $total_rightans;

        return redirect()->route('userhome')->with('success', $message);
    }

    public function score()
    {
        $uid = Auth::user()->id;

        $topic_all = courses::all();


        $user_test_all = results::select('test_id')
            ->where('users_id', $uid)
            ->get();

        foreach ($user_test_all as $value) {

            $test_new = $value->test_id;

            $test_data[] = results::join('cat_topic', 'results.topics_id', '=', 'cat_topic.id')
                ->where('results.users_id', $uid)
                ->where('results.test_id', $test_new)
                ->get(['results.test_id', 'results.topics_id', 'results.created_at', 'cat_topic.topic_name', 'results.total_ques', 'results.total_corr_ans', 'results.total_skip', 'results.total_opt_count' ]);
        }

        foreach ($topic_all as $titles) {

            $topicid = $titles->id;
            $topic1 = $topics[] = $titles->topic_name;
            $result1 = $result_data[] = results::where('users_id', $uid)
                ->where('topics_id', $topicid)
                ->pluck('total_corr_ans')
                ->first();

            if (!isset($result1)) {
                $result1 = 0;
            }

            $piedata[] = array(
                'language'        =>    $topic1,
                'total'            =>    $result1,
                'color'            =>    '#' . rand(100000, 999999) . ''
            );
        }

        json_encode($piedata);

        return view('checkscore', compact('test_data', 'topics', 'result_data', 'piedata'));
    }
}
