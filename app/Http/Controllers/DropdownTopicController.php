<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Models\courses;
use Illuminate\Support\Facades\DB;

class DropdownTopicController extends Controller
{
    public function index()
    {
        $data['category'] = category::get(["category_name", "id"]);
         return view('addquestions', $data);
    }

    public function fetchTopics(Request $request)
    {
        $data['topics'] = courses::where('category_id', $request->category_id)
                        ->get();
        return response()->json($data);
    }
}
