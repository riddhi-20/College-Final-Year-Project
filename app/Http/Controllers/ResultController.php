<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use DataTables;
use App\Models\courses;
use App\Models\results;
use App\Models\User;

class ResultController extends Controller
{
    public function students(Request $request)
    {
        $users_all = User::where('is_admin', '=', 0)->get();
        
        $topic_all = courses::all();

        // DB::statement("SET SQL_MODE=''");
        // $users_test_all = DB::table('users')
        //     ->join('results', 'results.users_id', '=', 'users.id')
        //     ->select('users.*', DB::raw("count(results.test_id) AS total_test"), DB::raw("count(distinct results.topics_id) AS total_topics"))
        //     ->groupBy('results.users_id')
        //     ->get();


        foreach ($users_all as $value) {

            $userid = $value->id;

            $users_test_all[$userid] = DB::table('users')
            ->join('results', 'results.users_id', '=', 'users.id')
            ->select(DB::raw("count(results.test_id) AS total_test"), DB::raw("count(distinct results.topics_id) AS total_topics"))
            ->where('results.users_id',$userid)
            ->groupBy('results.users_id')
            ->get();

            foreach ($topic_all as $titles) {

                $topicid = $titles->id;

                $result_data[$userid][$topicid] = results::where('users_id', $userid)
                    ->where('topics_id', $topicid)
                    ->first();
            }
        }

        
        return view('students', compact('users_test_all', 'topic_all', 'result_data', 'users_all'));
    }
}
