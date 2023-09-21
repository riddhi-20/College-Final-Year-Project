<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Session;
use App\Models\category;
use App\Models\courses;
use DataTables;


class JoinCategoryTopicController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = category::join('cat_topic', 'cat_topic.category_id', '=', 'category.id')
                ->orderBy('category.id', 'ASC')
                ->orderBy('cat_topic.topic_name', 'ASC')
                ->whereNull('cat_topic.deleted_at')
                ->get();
                
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="/edittopics/' . $row->id . '"class="btn btn-primary btn-sm">Edit</a>';
                    return $actionBtn;
                })
                ->addColumn('action1', function($row){
                    $actionBtn1 = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" class="btn btn-danger btn-sm delete">Delete</a>';
                    return $actionBtn1;
                })
                ->rawColumns(['action', 'action1'])
                ->make(true);
        }
        return View::make('viewtopics');
    }

    public function edit($id)
    {
        $category_all = category::all();

        $data = category::join('cat_topic', 'cat_topic.category_id', '=', 'category.id')
            ->where('cat_topic.id', $id)
            ->whereNull('cat_topic.deleted_at')
            ->get(['cat_topic.category_id', 'category.category_name', 'cat_topic.topic_name', 'cat_topic.id']);


        return view('edittopics', compact('data', 'category_all'));
    }
}
